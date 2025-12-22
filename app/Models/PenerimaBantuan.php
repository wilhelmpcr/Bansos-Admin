<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenerimaBantuan extends Model
{
    use HasFactory;

    protected $table      = 'penerima_bantuan';
    protected $primaryKey = 'penerima_id';

    /**
     * Kolom yang boleh diisi (harus sesuai migration)
     */
    protected $fillable = [
        'nama',
        'nik',
        'alamat',
        'tanggal_daftar',
        'warga_id',
        'program_id',
        'keterangan',
        'status',
        'foto',
    ];

    /**
     * =====================
     * RELASI
     * =====================
     */

    public function warga()
    {
        return $this->belongsTo(Warga::class, 'warga_id', 'warga_id');
    }

    public function program()
    {
        return $this->belongsTo(ProgramBantuan::class, 'program_id', 'program_id');
    }

    /**
     * =====================
     * QUERY SCOPE
     * =====================
     */

    // Scope filter (warga_id, program_id, status, dll)
    public function scopeFilter($query, $request, array $columns)
    {
        foreach ($columns as $column) {
            if ($request->filled($column)) {
                $query->where($column, $request->input($column));
            }
        }

        return $query;
    }

    // Scope search (keterangan + nama warga)
    public function scopeSearch($query, $request, array $columns)
    {
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search, $columns) {

                foreach ($columns as $column) {
                    $q->orWhere($column, 'like', "%{$search}%");
                }

                // search ke tabel warga
                $q->orWhereHas('warga', function ($w) use ($search) {
                    $w->where('nama', 'like', "%{$search}%");
                });
            });
        }

        return $query;
    }
}
