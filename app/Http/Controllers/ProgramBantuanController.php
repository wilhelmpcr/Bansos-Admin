<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProgramBantuan;

class ProgramBantuanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Kolom yang boleh difilter (sesuaikan dengan kebutuhanmu)
        // Misal: filter berdasarkan nama_program dan tahun
        $filterableColumns = ['nama_program', 'tahun'];

        // 2️⃣ Kolom yang boleh difilter (dropdown)
    $filterableColumns = ['nama_program', 'tahun'];

    // 2️⃣ Kolom yang ikut di-search (mirip contoh first_name,last_name,email)
    // Sesuai tabel program_bantuan: kode, nama_program, tahun, deskripsi, anggaran
    $searchableColumns = ['kode', 'nama_program', 'tahun', 'deskripsi'];

        // Mirip dengan: $data['dataWarga'] = ... tapi untuk ProgramBantuan
        $programs = ProgramBantuan::query()
            ->filter($request, $filterableColumns)
            ->paginate(10)
            ->withQueryString();

        return view('pages.program_bantuan.index', compact('programs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.program_bantuan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode'         => 'required|unique:program_bantuan,kode|max:50',
            'nama_program' => 'required|string|max:255',
            'tahun'        => 'required|digits:4|integer',
            'deskripsi'    => 'nullable|string',
            'anggaran'     => 'required|numeric|min:0',
        ]);

        ProgramBantuan::create($validated);

        return redirect()->route('program_bantuan.index')
                         ->with('success', 'Program Bantuan berhasil ditambahkan!');
    }

    public function show(string $id)
    {
        // Optional: implement jika butuh menampilkan detail
    }

    public function edit(string $id)
    {
        $program = ProgramBantuan::findOrFail($id);
        return view('pages.program_bantuan.edit', compact('program'));
    }

    public function update(Request $request, string $id)
    {
        $program = ProgramBantuan::findOrFail($id);

        $validated = $request->validate([
            'kode'         => 'required|max:50|unique:program_bantuan,kode,' . $program->program_id . ',program_id',
            'nama_program' => 'required|string|max:255',
            'tahun'        => 'required|digits:4|integer',
            'deskripsi'    => 'nullable|string',
            'anggaran'     => 'required|numeric|min:0',
        ]);

        $program->update($validated);

        return redirect()->route('program_bantuan.index')
                         ->with('success', 'Program Bantuan berhasil diperbarui!');
    }

    public function destroy(string $id)
    {
        $program = ProgramBantuan::findOrFail($id);
        $program->delete();

        return redirect()->route('program_bantuan.index')
                         ->with('success', 'Program Bantuan berhasil dihapus!');
    }
}
