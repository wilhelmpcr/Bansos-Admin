<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PenerimaBantuan;
use App\Models\ProgramBantuan;
use App\Models\Warga;

class PenerimaBantuanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['dataPenerima'] = PenerimaBantuan::with(['program', 'warga'])->get();
return view('admin.penerima_bantuan.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['warga'] = Warga::all();
        $data['program'] = ProgramBantuan::all();
        return view('admin.penerima_bantuan.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'program_id' => 'required',
            'warga_id' => 'required',
            'keterangan' => 'nullable|string'
        ]);

        PenerimaBantuan::create($request->all());
        return redirect()->route('penerima_bantuan.index')->with('success', 'Data penerima berhasil ditambahkan!');
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
        $data['penerima'] = PenerimaBantuan::findOrFail($id);
        $data['warga'] = Warga::all();
        $data['program'] = ProgramBantuan::all();
        return view('admin.penerima.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
         $penerima = PenerimaBantuan::findOrFail($id);
        $penerima->update($request->all());
        return redirect()->route('penerima.index')->with('success', 'Data penerima berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        PenerimaBantuan::destroy($id);
        return redirect()->route('penerima.index')->with('success', 'Data penerima berhasil dihapus!');
    }
}
