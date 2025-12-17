<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VerifikasiLapangan extends Model
{
    use HasFactory;

    protected $table = 'verifikasi_lapangan';
    protected $primaryKey = 'verifikasi_id';

    protected $fillable = [
        'petugas',
        'tanggal',
        'catatan',
        'skor',
    ];
}
