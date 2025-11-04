<?php

namespace App\Http\Controllers;

use App\Models\Warga;
use Illuminate\Http\Request;

class WargaController extends Controller
{
    // TAMPIL SEMUA DATA
    public function index()
    {
        $data['dataWarga'] = Warga::all();
        return view('pages.warga.index', $data);
    }

    // FORM TAMBAH
    public function create()
    {
        return view('pages.warga.create');
    }

    // SIMPAN DATA BARU
    public function store(Request $request)
    {
        $request->validate([
            'no_ktp' => 'required|unique:warga,no_ktp|max:16',
            'nama' => 'required',
            'jenis_kelamin' => 'required',
            'agama' => 'required',
            'pekerjaan' => 'required',
            'telp' => 'nullable',
            'email' => 'nullable|email',
        ]);

        Warga::create($request->all());
        return redirect()->route('warga.index')->with('success', 'Data warga berhasil ditambahkan');
    }

    // FORM EDIT
    public function edit($id)
    {
        $warga = Warga::findOrFail($id); // Ambil data berdasarkan ID
        return view('pages.warga.edit', compact('warga'));
    }

    // UPDATE DATA
    public function update(Request $request, $id)
    {
        $warga = Warga::findOrFail($id);

        $request->validate([
            'no_ktp' => 'required|max:16|unique:warga,no_ktp,' . $warga->warga_id . ',warga_id',
            'nama' => 'required',
            'jenis_kelamin' => 'required',
            'agama' => 'required',
            'pekerjaan' => 'required',
            'telp' => 'nullable',
            'email' => 'nullable|email',
        ]);

        $warga->update($request->all());
        return redirect()->route('warga.index')->with('success', 'Data warga berhasil diperbarui');
    }

    // HAPUS DATA
    public function destroy($id)
    {
        $warga = Warga::findOrFail($id);
        $warga->delete();

        return redirect()->route('warga.index')->with('success', 'Data warga berhasil dihapus');
    }
}
