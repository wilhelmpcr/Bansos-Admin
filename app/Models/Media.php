<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasFactory;

    protected $table = 'media';
    protected $primaryKey = 'media_id';

    // Sesuaikan dengan struktur tabel yang benar
    protected $fillable = [
        'ref_table',
        'ref_id',
        'file_url',      // tetap file_url (sesuai struktur)
        'file_name',     // tambahkan jika ada
        'caption',       // tambahkan
        'mime_type',     // tambahkan
        'sort_order'     // tambahkan
    ];
}
