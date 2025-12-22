<?php

namespace App\Http\Controllers;

use App\Models\PendaftarBantuan;
use App\Models\ProgramBantuan;
use App\Models\RiwayatPenyaluran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RiwayatPenyaluranController extends Controller
{
    /**
     * Daftar Riwayat Penyaluran
     */
    public function index(Request $request)
    {
        $riwayats = RiwayatPenyaluran::with([
                'pendaftar.warga',
                'pendaftar.program',
            ])
            ->when($request->program_id, function ($q) use ($request) {
                $q->whereHas('pendaftar', function ($qp) use ($request) {
                    $qp->where('program_id', $request->program_id);
                });
            })
            ->when($request->search, function ($q) use ($request) {
                $q->whereHas('pendaftar.warga', function ($qw) use ($request) {
                    $qw->where('nama', 'like', "%{$request->search}%");
                });
            })
            ->orderBy('tanggal', 'desc')
            ->paginate(10)
            ->withQueryString();

        $programs = ProgramBantuan::orderBy('nama_program')->get();

        return view('pages.riwayat_penyaluran.index', compact('riwayats', 'programs'));
    }

    /**
     * Detail Riwayat Penyaluran
     */
    public function show(RiwayatPenyaluran $riwayat)
    {
        $riwayat->load([
            'pendaftar.warga',
            'pendaftar.program',
        ]);

        return view('pages.riwayat_penyaluran.show', compact('riwayat'));
    }

    /**
     * Form tambah
     */
    public function create()
    {
        $pendaftars = PendaftarBantuan::where('status_seleksi', 'diterima')
            ->with(['warga', 'program'])
            ->get();

        return view('pages.riwayat_penyaluran.create', compact('pendaftars'));
    }

    /**
     * Simpan data baru
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'pendaftar_id' => 'required|exists:pendaftar_bantuan,pendaftar_id',
            'tanggal'      => 'required|date',
            'jumlah'       => 'required|numeric|min:0',
            'keterangan'   => 'nullable|string',
            'status'       => 'required|in:draft,diproses,selesai,dibatalkan',
            'file'         => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $validated['dokumen'] = [];

        if ($request->hasFile('file')) {
            $validated['dokumen'][] = $request->file('file')
                ->store('bukti_penyaluran', 'public');
        }

        RiwayatPenyaluran::create($validated);

        return redirect()
            ->route('riwayat_penyaluran.index')
            ->with('success', 'Riwayat penyaluran berhasil disimpan.');
    }

    /**
     * Form edit
     */
    public function edit(RiwayatPenyaluran $riwayat)
    {
        $riwayat->load([
            'pendaftar.warga',
            'pendaftar.program',
        ]);

        $pendaftars = PendaftarBantuan::where('status_seleksi', 'diterima')
            ->with(['warga', 'program'])
            ->get();

        return view('pages.riwayat_penyaluran.edit', compact('riwayat', 'pendaftars'));
    }

    /**
     * Update data
     */
    public function update(Request $request, RiwayatPenyaluran $riwayat)
    {
        $validated = $request->validate([
            'pendaftar_id' => 'required|exists:pendaftar_bantuan,pendaftar_id',
            'tanggal'      => 'required|date',
            'jumlah'       => 'required|numeric|min:0',
            'keterangan'   => 'nullable|string',
            'status'       => 'required|in:draft,diproses,selesai,dibatalkan',
            'file'         => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        // pastikan dokumen array
        $dokumen = is_array($riwayat->dokumen) ? $riwayat->dokumen : [];

        if ($request->hasFile('file')) {
            $dokumen[] = $request->file('file')
                ->store('bukti_penyaluran', 'public');
        }

        $validated['dokumen'] = $dokumen;

        $riwayat->update($validated);

        return redirect()
            ->route('riwayat_penyaluran.index')
            ->with('success', 'Riwayat penyaluran berhasil diperbarui.');
    }

    /**
     * Hapus data
     */
    public function destroy(RiwayatPenyaluran $riwayat)
    {
        // hapus file fisik
        if (is_array($riwayat->dokumen)) {
            foreach ($riwayat->dokumen as $file) {
                if (Storage::disk('public')->exists($file)) {
                    Storage::disk('public')->delete($file);
                }
            }
        }

        $riwayat->delete();

        return redirect()
            ->route('riwayat_penyaluran.index')
            ->with('success', 'Riwayat penyaluran berhasil dihapus.');
    }
}
