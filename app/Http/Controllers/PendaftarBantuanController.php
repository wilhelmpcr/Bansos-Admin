<?php

namespace App\Http\Controllers;

use App\Models\PendaftarBantuan;
use App\Models\Warga;
use App\Models\ProgramBantuan;
use Illuminate\Http\Request;

class PendaftarBantuanController extends Controller
{
    public function index(Request $request)
    {
        // kolom yang boleh difilter (dropdown)
        $filterableColumns = ['status_seleksi'];

        // kolom yang boleh di-search di tabel pendaftar_bantuan
        // kalau mau fokusnya di relasi (nama warga & nama program),
        // boleh juga dikosongin: []
        $searchableColumns = ['status_seleksi'];

        $pendaftar = PendaftarBantuan::with(['warga', 'program'])
            ->filter($request, $filterableColumns)      // scopeFilter di model
            ->search($request, $searchableColumns)      // scopeSearch di model
            ->paginate(10)
            ->withQueryString();

        return view('pages.pendaftar_bantuan.index', compact('pendaftar'));
    }

    public function create()
    {
        $warga = Warga::all();
        $program = ProgramBantuan::all();
        return view('pages.pendaftar_bantuan.create', compact('warga', 'program'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'warga_id'       => 'required|exists:warga,warga_id',
            'program_id'     => 'required|exists:program_bantuan,program_id',
            'status_seleksi' => 'required|in:pending,diterima,ditolak',
        ]);

        PendaftarBantuan::create([
            'warga_id'       => $request->warga_id,
            'program_id'     => $request->program_id,
            'status_seleksi' => $request->status_seleksi,
        ]);

        return redirect()->route('pendaftar_bantuan.index')
                         ->with('success', 'Pendaftar berhasil ditambahkan');
    }

    public function edit(PendaftarBantuan $pendaftar_bantuan)
    {
        $warga = Warga::all();
        $program = ProgramBantuan::all();
        return view('pages.pendaftar_bantuan.edit', compact('pendaftar_bantuan', 'warga', 'program'));
    }

    public function update(Request $request, PendaftarBantuan $pendaftar_bantuan)
    {
        $request->validate([
            'warga_id'       => 'required|exists:warga,warga_id',
            'program_id'     => 'required|exists:program_bantuan,program_id',
            'status_seleksi' => 'required|in:pending,diterima,ditolak',
        ]);

        $pendaftar_bantuan->update($request->only('warga_id','program_id','status_seleksi'));

        return redirect()->route('pendaftar_bantuan.index')
                         ->with('success', 'Pendaftar berhasil diupdate');
    }

    public function destroy(PendaftarBantuan $pendaftar_bantuan)
    {
        $pendaftar_bantuan->delete();

        return redirect()->route('pendaftar_bantuan.index')
                         ->with('success', 'Pendaftar berhasil dihapus');
    }
}
