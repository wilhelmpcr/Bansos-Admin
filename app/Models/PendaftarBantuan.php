<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class PendaftarBantuan extends Model
{
    protected $table = 'pendaftar_bantuan';
    protected $primaryKey = 'pendaftar_id';

    protected $fillable = [
        'warga_id',
        'program_id',
        'status_seleksi',
        'tanggal_daftar',
    ];

    // ===============================
    // RELASI
    // ===============================

    // Relasi ke Warga
    public function warga()
    {
        return $this->belongsTo(Warga::class, 'warga_id', 'warga_id');
    }

    // Relasi ke Program Bantuan
    public function program()
    {
        return $this->belongsTo(ProgramBantuan::class, 'program_id', 'program_id');
    }

    // ✅ RELASI KE PENERIMA BANTUAN (INI YANG KURANG)
    public function penerima()
    {
        return $this->hasOne(
            PenerimaBantuan::class,
            'warga_id', // FK di tabel penerima_bantuan
            'warga_id'  // PK/kolom di tabel ini
        );
    }

    // ===============================
    // QUERY SCOPE
    // ===============================

    /**
     * Scope filter kolom
     */
    public function scopeFilter(
        Builder $query,
        Request $request,
        array $filterableColumns
    ): Builder {
        foreach ($filterableColumns as $column) {
            if ($request->filled($column)) {
                $query->where($column, $request->input($column));
            }
        }
        return $query;
    }

    /**
     * Scope search keyword
     */
    public function scopeSearch(
        Builder $query,
        Request $request,
        array $columns
    ): Builder {
        if ($request->filled('search')) {
            $search = $request->input('search');

            $query->where(function ($q) use ($search, $columns) {
                foreach ($columns as $column) {
                    $q->orWhere($column, 'LIKE', "%{$search}%");
                }

                $q->orWhereHas('warga', function ($qw) use ($search) {
                    $qw->where('nama', 'LIKE', "%{$search}%");
                });

                $q->orWhereHas('program', function ($qp) use ($search) {
                    $qp->where('nama_program', 'LIKE', "%{$search}%");
                });
            });
        }

        return $query;
    }
}
