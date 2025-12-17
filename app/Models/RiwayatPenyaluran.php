<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RiwayatPenyaluran extends Model
{
    use HasFactory;

    protected $table = 'riwayat_penyaluran';
    protected $primaryKey = 'penyaluran_id';

    protected $fillable = [
        'pendaftar_id',
        'verifikasi_id',
        'tanggal',
        'jumlah',
        'keterangan',
        'status',
        'dokumen',
    ];

    protected $casts = [
        'tanggal' => 'date',
        'jumlah' => 'float',
        'dokumen' => 'array',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    protected $appends = [
        'jumlah_format',
        'tanggal_format',
        'nama_warga',
        'nik_warga',
        'nama_program',
    ];

    // ===============================
    // RELATIONS
    // ===============================

    // Riwayat → Pendaftar
    public function pendaftar()
    {
        return $this->belongsTo(PendaftarBantuan::class, 'pendaftar_id', 'pendaftar_id');
    }

    // Riwayat → VerifikasiLapangan
    public function verifikasi()
    {
        return $this->belongsTo(VerifikasiLapangan::class, 'verifikasi_id', 'verifikasi_id');
    }

    // ===============================
    // ACCESSORS
    // ===============================

    public function getJumlahFormatAttribute()
    {
        return 'Rp ' . number_format($this->jumlah, 0, ',', '.');
    }

    public function getTanggalFormatAttribute()
    {
        return $this->tanggal ? $this->tanggal->translatedFormat('d F Y') : null;
    }

    public function getNamaWargaAttribute()
    {
        return $this->pendaftar->warga->nama ?? null;
    }

    public function getNikWargaAttribute()
    {
        return $this->pendaftar->warga->no_ktp ?? null;
    }

    public function getNamaProgramAttribute()
    {
        return $this->pendaftar->program->nama_program ?? null;
    }

    // ===============================
    // SCOPES
    // ===============================

    public function scopeFilter($query, array $filters)
    {
        return $query
            ->when($filters['search'] ?? false, function ($query, $search) {
                $query->where('keterangan', 'like', "%$search%")
                    ->orWhereHas('pendaftar.warga', fn($q) =>
                        $q->where('nama', 'like', "%$search%")
                          ->orWhere('no_ktp', 'like', "%$search%")
                    )
                    ->orWhereHas('pendaftar.program', fn($q) =>
                        $q->where('nama_program', 'like', "%$search%")
                    );
            })
            ->when($filters['tanggal'] ?? false, fn($q, $tanggal) => $q->whereDate('tanggal', $tanggal))
            ->when($filters['program_id'] ?? false, fn($q, $programId) =>
                $q->whereHas('pendaftar', fn($q2) => $q2->where('program_id', $programId))
            )
            ->when($filters['status'] ?? false, fn($q, $status) => $q->where('status', $status))
            ->when($filters['bulan'] ?? false, fn($q, $bulan) => $q->whereMonth('tanggal', $bulan))
            ->when($filters['tahun'] ?? false, fn($q, $tahun) => $q->whereYear('tanggal', $tahun));
    }

    public function scopeSelesai($query)
    {
        return $query->where('status', 'selesai');
    }

    public function scopeDiproses($query)
    {
        return $query->where('status', 'diproses');
    }

    public function scopeDraft($query)
    {
        return $query->where('status', 'draft');
    }
}
