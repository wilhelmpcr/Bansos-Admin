<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramBantuan extends Model
{
    use HasFactory;

    protected $table = 'program_bantuan';
    protected $primaryKey = 'program_id';
    protected $fillable = [
        'kode',
        'nama_program',
        'tahun',
        'deskripsi',
        'anggaran'
    ];
}

