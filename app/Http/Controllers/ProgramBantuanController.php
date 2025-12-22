<?php

namespace App\Http\Controllers;

use App\Models\ProgramBantuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProgramBantuanController extends Controller
{
    public function index(Request $request)
    {
        $filterableColumns  = ['nama_program', 'tahun'];
        $searchableColumns = ['kode', 'nama_program', 'tahun', 'deskripsi'];

        $programs = ProgramBantuan::query()
            ->filter($request, $filterableColumns)
            ->search($request, $searchableColumns)
            ->orderBy('program_id', 'desc')
            ->paginate(10)
            ->withQueryString();

        return view('pages.program_bantuan.index', compact('programs'));
    }

    public function create()
    {
        return view('pages.program_bantuan.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode'         => 'required|unique:program_bantuan,kode|max:50',
            'nama_program' => 'required|string|max:255',
            'tahun'        => 'required|digits:4|integer',
            'deskripsi'    => 'nullable|string',
            'anggaran'     => 'required|numeric|min:0',
            'foto'         => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')
                ->store('program_foto', 'public');
        }

        ProgramBantuan::create($validated);

        return redirect()
            ->route('program_bantuan.index')
            ->with('success', 'Program Bantuan berhasil ditambahkan!');
    }

    public function show($id)
    {
        $program = ProgramBantuan::findOrFail($id);
        return view('pages.program_bantuan.show', compact('program'));
    }

    public function edit($id)
    {
        $program = ProgramBantuan::findOrFail($id);
        return view('pages.program_bantuan.edit', compact('program'));
    }

    public function update(Request $request, $id)
    {
        $program = ProgramBantuan::findOrFail($id);

        $validated = $request->validate([
            'kode'         => 'required|max:50|unique:program_bantuan,kode,' . $program->program_id . ',program_id',
            'nama_program' => 'required|string|max:255',
            'tahun'        => 'required|digits:4|integer',
            'deskripsi'    => 'nullable|string',
            'anggaran'     => 'required|numeric|min:0',
            'foto'         => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            if ($program->foto && Storage::disk('public')->exists($program->foto)) {
                Storage::disk('public')->delete($program->foto);
            }

            $validated['foto'] = $request->file('foto')
                ->store('program_foto', 'public');
        }

        $program->update($validated);

        return redirect()
            ->route('program_bantuan.index')
            ->with('success', 'Program Bantuan berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $program = ProgramBantuan::findOrFail($id);

        if ($program->foto && Storage::disk('public')->exists($program->foto)) {
            Storage::disk('public')->delete($program->foto);
        }

        $program->delete();

        return redirect()
            ->route('program_bantuan.index')
            ->with('success', 'Program Bantuan berhasil dihapus!');
    }
}
