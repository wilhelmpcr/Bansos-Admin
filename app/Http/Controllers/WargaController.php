<?php
namespace App\Http\Controllers;

use App\Models\Warga;
use Illuminate\Http\Request;

class WargaController extends Controller
{
    // TAMPIL SEMUA DATA
    public function index(Request $request)
    {
        // Kolom yang boleh difilter lewat dropdown (scopeFilter)
        $filterableColumns = ['jenis_kelamin', 'agama', 'pekerjaan'];

        // Kolom yang akan dicari saat searching (scopeSearch)
        $searchableColumns = ['no_ktp', 'nama', 'pekerjaan', 'email'];

        $data['dataWarga'] = Warga::query()
            ->filter($request, $filterableColumns) // scopeFilter di model Warga
            ->search($request, $searchableColumns) // scopeSearch di model Warga
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
        $request->validate([
            'no_ktp'        => 'required|unique:warga,no_ktp|max:16',
            'nama'          => 'required',
            'jenis_kelamin' => 'required',
            'agama'         => 'required',
            'pekerjaan'     => 'required',
            'telp'          => 'nullable',
            'email'         => 'nullable|email',
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
            'no_ktp'        => 'required|max:16|unique:warga,no_ktp,' . $warga->warga_id . ',warga_id',
            'nama'          => 'required',
            'jenis_kelamin' => 'required',
            'agama'         => 'required',
            'pekerjaan'     => 'required',
            'telp'          => 'nullable',
            'email'         => 'nullable|email',
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

    // DETAIL DATA
    public function show($id)
    {
        $warga = Warga::findOrFail($id);

        return view('pages.warga.show', compact('warga'));
    }

}
