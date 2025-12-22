<?php
namespace App\Http\Controllers;

use App\Models\PendaftarBantuan;
use App\Models\VerifikasiLapangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VerifikasiLapanganController extends Controller
{
    /**
     * INDEX
     */
    public function index(Request $request)
    {
        $query = VerifikasiLapangan::with('pendaftar.warga')->orderByDesc('tanggal');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->whereHas('pendaftar.warga', function ($q2) use ($search) {
                    $q2->where('nama', 'like', "%{$search}%");
                })
                    ->orWhere('petugas', 'like', "%{$search}%");
            });
        }

        $verifikasi = $query->paginate(10)->appends($request->query());

        return view('pages.verifikasi_lapangan.index', compact('verifikasi'));
    }

    /**
     * CREATE
     */
    public function create()
    {
        $pendaftar = PendaftarBantuan::with('warga')->get();
        return view('pages.verifikasi_lapangan.create', compact('pendaftar'));
    }

    /**
     * STORE
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'pendaftar_id'      => 'required|exists:pendaftar_bantuan,pendaftar_id',
            'petugas'           => 'required|string|max:255',
            'tanggal'           => 'required|date',
            'catatan'           => 'nullable|string',
            'skor'              => 'nullable|numeric|min:0|max:100',
            'foto_verifikasi'   => 'nullable|array',
            'foto_verifikasi.*' => 'image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data['skor'] = $request->filled('skor') ? (int) round($request->skor) : null;

        // Upload foto
        $foto = [];
        if ($request->hasFile('foto_verifikasi')) {
            foreach ($request->file('foto_verifikasi') as $file) {
                $foto[] = $file->store('verifikasi', 'public');
            }
        }
        $data['foto_verifikasi'] = $foto ?: null;

        VerifikasiLapangan::create($data);

        return redirect()
            ->route('verifikasi_lapangan.index')
            ->with('success', 'Data verifikasi berhasil ditambahkan');
    }

    /**
     * SHOW
     */
    public function show($id)
    {
        $verifikasiLapangan = VerifikasiLapangan::with('pendaftar.warga')->findOrFail($id);
        return view('pages.verifikasi_lapangan.show', compact('verifikasiLapangan'));
    }

    /**
     * EDIT
     */
    public function edit($id)
    {
        $verifikasiLapangan = VerifikasiLapangan::with('pendaftar.warga')->findOrFail($id);
        return view('pages.verifikasi_lapangan.edit', compact('verifikasiLapangan'));
    }

    /**
     * UPDATE
     */
    public function update(Request $request, $id)
    {
        $verifikasi = VerifikasiLapangan::findOrFail($id);

        $data = $request->validate([
            'pendaftar_id'      => 'required|exists:pendaftar_bantuan,pendaftar_id',
            'petugas'           => 'required|string|max:255',
            'tanggal'           => 'required|date',
            'catatan'           => 'nullable|string',
            'skor'              => 'nullable|numeric|min:0|max:100',
            'foto_verifikasi'   => 'nullable|array',
            'foto_verifikasi.*' => 'image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data['skor'] = $request->filled('skor') ? (int) round($request->skor) : null;

        // Foto lama
        $fotoLama = is_array($verifikasi->foto_verifikasi) ? $verifikasi->foto_verifikasi : [];

        // Hapus foto terpilih
        if ($request->filled('hapus_foto')) {
            foreach ($request->hapus_foto as $hapus) {
                if (in_array($hapus, $fotoLama)) {
                    Storage::disk('public')->delete($hapus);
                    $fotoLama = array_diff($fotoLama, [$hapus]);
                }
            }
        }

        // Upload foto baru
        if ($request->hasFile('foto_verifikasi')) {
            foreach ($request->file('foto_verifikasi') as $file) {
                $fotoLama[] = $file->store('verifikasi', 'public');
            }
        }

        $data['foto_verifikasi'] = count($fotoLama) ? array_values($fotoLama) : null;

        $verifikasi->update($data);

        return redirect()
            ->route('verifikasi_lapangan.index')
            ->with('success', 'Data verifikasi berhasil diperbarui');
    }

    /**
     * DESTROY
     */
    public function destroy($id)
    {
        $verifikasi = VerifikasiLapangan::findOrFail($id);

        if (is_array($verifikasi->foto_verifikasi)) {
            foreach ($verifikasi->foto_verifikasi as $foto) {
                Storage::disk('public')->delete($foto);
            }
        }

        $verifikasi->delete();

        return redirect()
            ->route('verifikasi_lapangan.index')
            ->with('success', 'Data verifikasi berhasil dihapus');
    }
}
