<?php

namespace App\Http\Controllers;

use App\Models\PeristiwaKelahiran;
use App\Models\Warga;
use App\Models\Media;
use Illuminate\Http\Request;

class PeristiwaKelahiranController extends Controller
{
    public function index()
    {
        $kelahiran = PeristiwaKelahiran::with(['anak', 'ayah', 'ibu', 'media'])
            ->orderBy('kelahiran_id', 'DESC')
            ->get();

        return view('pages.kelahiran.index', compact('kelahiran'));
    }

    public function create()
    {
        $warga = Warga::orderBy('nama')->get();
        return view('pages.kelahiran.create', compact('warga'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_bayi'      => 'required|string|max:255',
            'anak_warga_id'  => 'required|exists:warga,warga_id',
            'ayah_warga_id'  => 'required|exists:warga,warga_id',
            'ibu_warga_id'   => 'required|exists:warga,warga_id',
            'tanggal_lahir'  => 'required|date',
            'tempat_lahir'   => 'required|string|max:255',
            'foto'           => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $kelahiran = PeristiwaKelahiran::create($request->only([
            'nama_bayi',
            'anak_warga_id',
            'ayah_warga_id',
            'ibu_warga_id',
            'tanggal_lahir',
            'tempat_lahir'
        ]));

        $this->handleFileUpload($request, $kelahiran->kelahiran_id);

        return redirect()->route('kelahiran.index')
                         ->with('success', 'Data kelahiran berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $kelahiran = PeristiwaKelahiran::with('media')->findOrFail($id);
        $warga = Warga::orderBy('nama')->get();

        return view('pages.kelahiran.edit', compact('kelahiran', 'warga'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_bayi'      => 'required|string|max:255',
            'anak_warga_id'  => 'required|exists:warga,warga_id',
            'ayah_warga_id'  => 'required|exists:warga,warga_id',
            'ibu_warga_id'   => 'required|exists:warga,warga_id',
            'tanggal_lahir'  => 'required|date',
            'tempat_lahir'   => 'required|string|max:255',
        ]);

        $kelahiran = PeristiwaKelahiran::findOrFail($id);
        $kelahiran->update($request->only([
            'nama_bayi',
            'anak_warga_id',
            'ayah_warga_id',
            'ibu_warga_id',
            'tanggal_lahir',
            'tempat_lahir'
        ]));

        $this->handleFileUpload($request, $kelahiran->kelahiran_id);

        return redirect()->route('kelahiran.index')
                         ->with('success', 'Data kelahiran berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $kelahiran = PeristiwaKelahiran::findOrFail($id);
        $kelahiran->delete();

        return redirect()->route('kelahiran.index')
                         ->with('success', 'Data kelahiran berhasil dihapus.');
    }

    /**
     * Handle file upload untuk store dan update
     */
    private function handleFileUpload(Request $request, $kelahiranId)
    {
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $path = $file->store('kelahiran', 'public');

            // Hapus file lama jika ada (untuk update)
            Media::where('ref_table', 'peristiwa_kelahiran')
                 ->where('ref_id', $kelahiranId)
                 ->delete();

            // Buat record media baru
            Media::create([
                'ref_table'  => 'peristiwa_kelahiran',
                'ref_id'     => $kelahiranId,
                'file_url'   => $path,
                'file_name'  => $file->getClientOriginalName(),
                'mime_type'  => $file->getMimeType(),
                'caption'    => 'Foto kelahiran ' . ($request->nama_bayi ?? ''),
                'sort_order' => 1
            ]);
        }
    }
}
