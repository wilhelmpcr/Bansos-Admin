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
    ];

    public function warga()
    {
        return $this->belongsTo(Warga::class, 'warga_id', 'warga_id');
    }

    public function program()
    {
        return $this->belongsTo(ProgramBantuan::class, 'program_id', 'program_id');
    }

    /**
     * Scope filter untuk kolom tertentu (dropdown/status, dll).
     */
    public function scopeFilter(Builder $query, Request $request, array $filterableColumns): Builder
    {
        foreach ($filterableColumns as $column) {
            if ($request->filled($column)) {
                $query->where($column, $request->input($column));
            }
        }

        return $query;
    }

    /**
     * Scope search untuk pencarian bebas dengan keyword.
     */
    public function scopeSearch(Builder $query, Request $request, array $columns): Builder
    {
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search, $columns) {
                // search pada kolom langsung di tabel pendaftar_bantuan
                foreach ($columns as $column) {
                    $q->orWhere($column, 'LIKE', '%' . $search . '%');
                }

                // search ke relasi warga (nama)
                $q->orWhereHas('warga', function ($qw) use ($search) {
                    $qw->where('nama', 'LIKE', '%' . $search . '%');
                });

                // search ke relasi program (nama_program)
                $q->orWhereHas('program', function ($qp) use ($search) {
                    $qp->where('nama_program', 'LIKE', '%' . $search . '%');
                });
            });
        }

        return $query;
    }
}
