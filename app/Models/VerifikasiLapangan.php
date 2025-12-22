<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class VerifikasiLapangan extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'verifikasi_lapangan';
    protected $primaryKey = 'verifikasi_id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'pendaftar_id',
        'petugas',
        'tanggal',
        'catatan',
        'skor',
        'foto_verifikasi',
    ];

    protected $casts = [
        'foto_verifikasi' => 'array',
        'tanggal' => 'date',
        'deleted_at' => 'datetime',
    ];

    /* ================= RELASI ================= */

    /**
     * Relasi ke pendaftar bantuan
     */
    public function pendaftar()
    {
        return $this->belongsTo(PendaftarBantuan::class, 'pendaftar_id', 'pendaftar_id');
    }

    /**
     * Relasi ke warga melalui pendaftar
     */
    public function warga()
    {
        return $this->hasOneThrough(
            Warga::class,
            PendaftarBantuan::class,
            'pendaftar_id', // FK PendaftarBantuan di VerifikasiLapangan
            'warga_id',     // FK Warga di PendaftarBantuan
            'verifikasi_id', // PK di VerifikasiLapangan
            'warga_id'       // PK di PendaftarBantuan
        );
    }

    /* ================= ACCESSOR ================= */

    /**
     * Format tanggal menjadi dd-mm-yyyy
     */
    public function getFormattedTanggalAttribute(): string
    {
        return $this->tanggal
            ? Carbon::parse($this->tanggal)->format('d-m-Y')
            : '-';
    }

    /**
     * Label status berdasarkan skor
     */
    public function getStatusLabelAttribute(): array
    {
        if ($this->skor === null) {
            return [
                'label' => 'Belum Dinilai',
                'color' => 'secondary',
                'icon'  => 'fa-clock',
            ];
        }

        if ($this->skor >= 85) {
            return [
                'label' => 'Sangat Baik',
                'color' => 'success',
                'icon'  => 'fa-star',
            ];
        }

        if ($this->skor >= 70) {
            return [
                'label' => 'Baik',
                'color' => 'primary',
                'icon'  => 'fa-thumbs-up',
            ];
        }

        if ($this->skor >= 60) {
            return [
                'label' => 'Cukup',
                'color' => 'warning',
                'icon'  => 'fa-check',
            ];
        }

        return [
            'label' => 'Perlu Perbaikan',
            'color' => 'danger',
            'icon'  => 'fa-exclamation-triangle',
        ];
    }
}
