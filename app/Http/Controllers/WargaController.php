<?php

namespace App\Http\Controllers;

use App\Models\Warga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WargaController extends Controller
{
    // TAMPIL SEMUA DATA
    public function index(Request $request)
    {
        $filterableColumns = ['jenis_kelamin', 'agama', 'pekerjaan'];
        $searchableColumns = ['no_ktp', 'nama', 'pekerjaan', 'email'];

        $data['dataWarga'] = Warga::query()
            ->filter($request, $filterableColumns)
            ->search($request, $searchableColumns)
            ->paginate(10)
            ->withQueryString();

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
        $data = $request->validate([
            'no_ktp'        => 'required|unique:warga,no_ktp|max:16',
            'nama'          => 'required',
            'jenis_kelamin' => 'required',
            'agama'         => 'required',
            'pekerjaan'     => 'required',
            'telp'          => 'nullable',
            'email'         => 'nullable|email',
            'foto_bukti'    => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // UPLOAD FOTO
        if ($request->hasFile('foto_bukti')) {
            $data['foto_bukti'] = $request->file('foto_bukti')
                ->store('foto_warga', 'public');
        }

        Warga::create($data);

        return redirect()
            ->route('warga.index')
            ->with('success', 'Data warga berhasil ditambahkan');
    }

    // FORM EDIT
    public function edit($id)
    {
        $warga = Warga::findOrFail($id);
        return view('pages.warga.edit', compact('warga'));
    }

    // UPDATE DATA
    public function update(Request $request, $id)
    {
        $warga = Warga::findOrFail($id);

        $data = $request->validate([
            'no_ktp'        => 'required|max:16|unique:warga,no_ktp,' . $warga->warga_id . ',warga_id',
            'nama'          => 'required',
            'jenis_kelamin' => 'required',
            'agama'         => 'required',
            'pekerjaan'     => 'required',
            'telp'          => 'nullable',
            'email'         => 'nullable|email',
            'foto_bukti'    => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // JIKA GANTI FOTO
        if ($request->hasFile('foto_bukti')) {

            // hapus foto lama
            if ($warga->foto_bukti && Storage::disk('public')->exists($warga->foto_bukti)) {
                Storage::disk('public')->delete($warga->foto_bukti);
            }

            $data['foto_bukti'] = $request->file('foto_bukti')
                ->store('foto_warga', 'public');
        }

        $warga->update($data);

        return redirect()
            ->route('warga.index')
            ->with('success', 'Data warga berhasil diperbarui');
    }

    // HAPUS DATA
    public function destroy($id)
    {
        $warga = Warga::findOrFail($id);

        if ($warga->foto_bukti && Storage::disk('public')->exists($warga->foto_bukti)) {
            Storage::disk('public')->delete($warga->foto_bukti);
        }

        $warga->delete();

        return redirect()
            ->route('warga.index')
            ->with('success', 'Data warga berhasil dihapus');
    }

    // DETAIL DATA
    public function show($id)
    {
        $warga = Warga::findOrFail($id);
        return view('pages.warga.show', compact('warga'));
    }
}
