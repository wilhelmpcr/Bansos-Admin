<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeristiwaKelahiran extends Model
{
    use HasFactory;

    // Nama tabel di database
    protected $table = 'peristiwa_kelahiran';

    // Primary key
    protected $primaryKey = 'kelahiran_id';

    // Timestamps
    public $timestamps = true;

    // Field yang bisa diisi (fillable)
    protected $fillable = [
        'kelahiran_id', // jika auto-increment, biasanya tidak perlu dimasukkan
        'nama_bayi',
        'anak_warga_id',
        'ayah_warga_id',
        'ibu_warga_id',
        'tanggal_lahir',
        'tempat_lahir'
    ];

    // Casting tipe data
    protected $casts = [
        'tanggal_lahir' => 'date',
    ];

    // Relasi ke model Warga untuk data anak
    public function anak()
    {
        return $this->belongsTo(Warga::class, 'anak_warga_id', 'warga_id');
    }

    // Relasi ke model Warga untuk data ayah
    public function ayah()
    {
        return $this->belongsTo(Warga::class, 'ayah_warga_id', 'warga_id');
    }

    // Relasi ke model Warga untuk data ibu
    public function ibu()
    {
        return $this->belongsTo(Warga::class, 'ibu_warga_id', 'warga_id');
    }

    // Relasi ke media (foto)
    public function media()
    {
        return $this->hasOne(Media::class, 'ref_id', 'kelahiran_id')
                    ->where('ref_table', 'peristiwa_kelahiran');
    }

    // Atau jika bisa multiple media
    public function medias()
    {
        return $this->hasMany(Media::class, 'ref_id', 'kelahiran_id')
                    ->where('ref_table', 'peristiwa_kelahiran');
    }
} 
