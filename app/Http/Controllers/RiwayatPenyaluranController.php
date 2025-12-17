<?php

namespace App\Http\Controllers;

use App\Models\PendaftarBantuan;
use App\Models\RiwayatPenyaluran;
use Illuminate\Http\Request;

class RiwayatPenyaluranController extends Controller
{
    /**
     * Daftar Riwayat Penyaluran
     */
    public function index()
    {
        $riwayats = RiwayatPenyaluran::with('pendaftar.warga', 'pendaftar.program')
            ->orderBy('tanggal', 'desc')
            ->get();

        return view('pages.riwayat_penyaluran.index', compact('riwayats'));
    }

    /**
     * Form tambah Riwayat Penyaluran
     */
    public function create()
    {
        $pendaftars = PendaftarBantuan::where('status_seleksi', 'diterima')->get();

        return view('pages.riwayat_penyaluran.create', compact('pendaftars'));
    }

    /**
     * Simpan Riwayat Penyaluran baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'pendaftar_id' => 'required|exists:pendaftar_bantuan,pendaftar_id',
            'tanggal'      => 'required|date',
            'jumlah'       => 'required|numeric|min:0',
            'keterangan'   => 'nullable|string',
            'status'       => 'required|in:draft,diproses,selesai,dibatalkan',
            'file'         => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $files = [];
        if ($request->hasFile('file')) {
            $files[] = $request->file('file')->store('bukti_penyaluran', 'public');
        }

        RiwayatPenyaluran::create([
            'pendaftar_id'  => $request->pendaftar_id,
            'verifikasi_id' => null,
            'tanggal'       => $request->tanggal,
            'jumlah'        => $request->jumlah,
            'keterangan'    => $request->keterangan,
            'status'        => $request->status,
            'dokumen'       => $files,
        ]);

        return redirect()->route('riwayat_penyaluran.index')
            ->with('success', 'Riwayat penyaluran berhasil disimpan.');
    }

    /**
     * Detail Riwayat Penyaluran
     */
    public function show(RiwayatPenyaluran $riwayat)
    {
        $riwayat->load('pendaftar.warga', 'pendaftar.program');

        return view('pages.riwayat_penyaluran.show', compact('riwayat'));
    }

    /**
     * Form edit Riwayat Penyaluran
     */
    public function edit(RiwayatPenyaluran $riwayat)
    {
        $pendaftars = PendaftarBantuan::where('status_seleksi', 'diterima')->get();

        return view('pages.riwayat_penyaluran.edit', compact('riwayat', 'pendaftars'));
    }

    /**
     * Update Riwayat Penyaluran
     */
    public function update(Request $request, RiwayatPenyaluran $riwayat)
    {
        $request->validate([
            'pendaftar_id' => 'required|exists:pendaftar_bantuan,pendaftar_id',
            'tanggal'      => 'required|date',
            'jumlah'       => 'required|numeric|min:0',
            'keterangan'   => 'nullable|string',
            'status'       => 'required|in:draft,diproses,selesai,dibatalkan',
            'file'         => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $files = $riwayat->dokumen ?? [];

        if ($request->hasFile('file')) {
            $files[] = $request->file('file')->store('bukti_penyaluran', 'public');
        }

        $riwayat->update([
            'pendaftar_id' => $request->pendaftar_id,
            'tanggal'      => $request->tanggal,
            'jumlah'       => $request->jumlah,
            'keterangan'   => $request->keterangan,
            'status'       => $request->status,
            'dokumen'      => $files,
        ]);

        return redirect()->route('riwayat_penyaluran.index')
            ->with('success', 'Riwayat penyaluran berhasil diperbarui.');
    }

    /**
     * Hapus Riwayat Penyaluran
     */
    public function destroy(RiwayatPenyaluran $riwayat)
    {
        $riwayat->delete();

        return redirect()->route('riwayat_penyaluran.index')
            ->with('success', 'Riwayat penyaluran berhasil dihapus.');
    }
}
