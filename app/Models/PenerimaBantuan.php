<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PenerimaBantuan extends Model
{
    use HasFactory;

    protected $table = 'penerima_bantuan'; // ← SESUAIKAN DENGAN NAMA TABEL YANG ADA

    protected $primaryKey = 'penerima_id';

    protected $fillable = [
        'program_id',
        'nama',
        'nik',
        'alamat',
        'status'
    ];
}
