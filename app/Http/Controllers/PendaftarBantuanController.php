<?php
namespace App\Http\Controllers;

use App\Models\PendaftarBantuan;
use App\Models\ProgramBantuan;
use App\Models\Warga;
use Illuminate\Http\Request;

class PendaftarBantuanController extends Controller
{
    public function index(Request $request)
    {
        $filterableColumns = ['status_seleksi'];
        $searchableColumns = ['status_seleksi'];

        $pendaftar = PendaftarBantuan::with(['warga', 'program'])
            ->filter($request, $filterableColumns)
            ->search($request, $searchableColumns)
            ->paginate(10)
            ->withQueryString();

        return view('pages.pendaftar_bantuan.index', compact('pendaftar'));
    }

    public function create()
    {
        $warga   = Warga::all();
        $program = ProgramBantuan::all();
        return view('pages.pendaftar_bantuan.create', compact('warga', 'program'));
    }

    public function store(Request $request)
    {
        $request->validate([~
            'warga_id'       => 'required|exists:warga,warga_id',
            'program_id'     => 'required|exists:program_bantuan,program_id',
            'status_seleksi' => 'required|in:pending,diterima,ditolak',
        ]);

        PendaftarBantuan::create($request->only('warga_id', 'program_id', 'status_seleksi'));

        return redirect()->route('pendaftar_bantuan.index')
            ->with('success', 'Pendaftar berhasil ditambahkan');
    }

    public function edit(PendaftarBantuan $pendaftar_bantuan)
    {
        $warga   = Warga::all();
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

        $pendaftar_bantuan->update($request->only('warga_id', 'program_id', 'status_seleksi'));

        return redirect()->route('pendaftar_bantuan.index')
            ->with('success', 'Pendaftar berhasil diupdate');
    }

    public function destroy(PendaftarBantuan $pendaftar_bantuan)
    {
        $pendaftar_bantuan->delete();

        return redirect()->route('pendaftar_bantuan.index')
            ->with('success', 'Pendaftar berhasil dihapus');
    }

    public function show(PendaftarBantuan $pendaftar_bantuan)
    {
        $pendaftar_bantuan->load(['warga', 'program']);

        return view('pages.pendaftar_bantuan.show', compact('pendaftar_bantuan'));
    }
}
