<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;

class RiwayatPenyaluran extends Model
{
    use HasFactory;

    protected $table = 'riwayat_penyaluran';
    protected $primaryKey = 'penyaluran_id';
    protected $keyType = 'int';
    public $incrementing = true;

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
        'jumlah'  => 'float',
        'dokumen' => 'array',
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

    public function pendaftar()
    {
        return $this->belongsTo(
            PendaftarBantuan::class,
            'pendaftar_id',
            'pendaftar_id'
        );
    }

    public function verifikasi()
    {
        return $this->belongsTo(
            VerifikasiLapangan::class,
            'verifikasi_id',
            'verifikasi_id'
        );
    }

    // ===============================
    // ACCESSORS (MODERN)
    // ===============================

    protected function jumlahFormat(): Attribute
    {
        return Attribute::get(
            fn () => 'Rp ' . number_format($this->jumlah ?? 0, 0, ',', '.')
        );
    }

    protected function tanggalFormat(): Attribute
    {
        return Attribute::get(
            fn () => $this->tanggal
                ? $this->tanggal->translatedFormat('d F Y')
                : '-'
        );
    }

    protected function namaWarga(): Attribute
    {
        return Attribute::get(
            fn () => optional(optional($this->pendaftar)->warga)->nama ?? '-'
        );
    }

    protected function nikWarga(): Attribute
    {
        return Attribute::get(
            fn () => optional(optional($this->pendaftar)->warga)->no_ktp ?? '-'
        );
    }

    protected function namaProgram(): Attribute
    {
        return Attribute::get(
            fn () => optional(optional($this->pendaftar)->program)->nama_program ?? '-'
        );
    }

    // ===============================
    // HELPERS
    // ===============================

    public function getDokumenList(): array
    {
        return is_array($this->dokumen) ? $this->dokumen : [];
    }

    // ===============================
    // SCOPES
    // ===============================

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            $query->where(function ($q) use ($search) {
                $q->where('keterangan', 'like', "%{$search}%")
                  ->orWhereHas('pendaftar.warga', function ($qw) use ($search) {
                      $qw->where('nama', 'like', "%{$search}%")
                         ->orWhere('no_ktp', 'like', "%{$search}%");
                  })
                  ->orWhereHas('pendaftar.program', function ($qp) use ($search) {
                      $qp->where('nama_program', 'like', "%{$search}%");
                  });
            });
        });

        $query->when($filters['tanggal'] ?? false,
            fn ($q, $tanggal) => $q->whereDate('tanggal', $tanggal)
        );

        $query->when($filters['program_id'] ?? false,
            fn ($q, $programId) =>
                $q->whereHas('pendaftar',
                    fn ($qp) => $qp->where('program_id', $programId)
                )
        );

        $query->when($filters['status'] ?? false,
            fn ($q, $status) => $q->where('status', $status)
        );

        $query->when($filters['bulan'] ?? false,
            fn ($q, $bulan) => $q->whereMonth('tanggal', $bulan)
        );

        $query->when($filters['tahun'] ?? false,
            fn ($q, $tahun) => $q->whereYear('tanggal', $tahun)
        );

        return $query;
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
