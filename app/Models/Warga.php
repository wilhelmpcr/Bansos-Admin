<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use App\Models\PeristiwaKelahiran;

class Warga extends Model
{
    use HasFactory;

    protected $table = 'warga';
    protected $primaryKey = 'warga_id';

    protected $fillable = [
        'no_ktp',
        'nama',
        'jenis_kelamin',
        'agama',
        'pekerjaan',
        'telp',
        'email',
    ];

    // FILTER
    public function scopeFilter(Builder $query, Request $request, array $filterableColumns): Builder
    {
        foreach ($filterableColumns as $column) {
            if ($request->filled($column)) {
                $query->where($column, $request->input($column));
            }
        }

        return $query;
    }

    // SEARCH
    public function scopeSearch(Builder $query, Request $request, array $columns): Builder
    {
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search, $columns) {
                foreach ($columns as $column) {
                    $q->orWhere($column, 'LIKE', '%' . $search . '%');
                }
            });
        }

        return $query;
    }

    // ──────────────── RELASI BALIK KELAHIRAN ────────────────

    public function kelahiranSebagaiAnak()
    {
        return $this->hasOne(PeristiwaKelahiran::class, 'warga_id', 'warga_id');
    }

    public function kelahiranSebagaiAyah()
    {
        return $this->hasMany(PeristiwaKelahiran::class, 'ayah_warga_id', 'warga_id');
    }

    public function kelahiranSebagaiIbu()
    {
        return $this->hasMany(PeristiwaKelahiran::class, 'ibu_warga_id', 'warga_id');
    }
}
