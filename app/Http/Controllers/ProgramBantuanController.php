<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProgramBantuan;

class ProgramBantuanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $programs = ProgramBantuan::all();
        return view('pages.admin.program_bantuan.index', compact('programs'));
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
            'kode' => 'required|unique:program_bantuan,kode|max:50',
            'nama_program' => 'required|string|max:255',
            'tahun' => 'required|digits:4|integer',
            'deskripsi' => 'nullable|string',
            'anggaran' => 'required|numeric|min:0',
        ]);

        ProgramBantuan::create($validated);

        return redirect()->route('program_bantuan.index')
                         ->with('success', 'Program Bantuan berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
         $program = ProgramBantuan::findOrFail($id);
        return view('pages.program_bantuan.edit', compact('program'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
                $program = ProgramBantuan::findOrFail($id);

        $validated = $request->validate([
            'kode' => 'required|max:50|unique:program_bantuan,kode,' . $program->program_id . ',program_id',
            'nama_program' => 'required|string|max:255',
            'tahun' => 'required|digits:4|integer',
            'deskripsi' => 'nullable|string',
            'anggaran' => 'required|numeric|min:0',
        ]);

        $program->update($validated);

        return redirect()->route('program_bantuan.index')
                         ->with('success', 'Program Bantuan berhasil diperbarui!');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $program = ProgramBantuan::findOrFail($id);
        $program->delete();

        return redirect()->route('program_bantuan.index')
                         ->with('success', 'Program Bantuan berhasil dihapus!');
    }
}
