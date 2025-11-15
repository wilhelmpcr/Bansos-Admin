<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PendaftarBantuan extends Model
{
    protected $table = 'pendaftar_bantuan';
    protected $primaryKey = 'pendaftar_id';

    protected $fillable = [
        'warga_id',
        'program_id',
        'status_seleksi',
    ];

    public function warga()
    {
        return $this->belongsTo(Warga::class, 'warga_id', 'warga_id');
    }

    public function program()
    {
        return $this->belongsTo(ProgramBantuan::class, 'program_id', 'program_id');
    }
}
