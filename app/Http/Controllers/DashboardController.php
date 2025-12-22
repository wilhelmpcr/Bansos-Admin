<?php

namespace App\Http\Controllers;

use App\Models\VerifikasiLapangan;
use App\Models\RiwayatPenyaluran;
use App\Models\ProgramBantuan;
use App\Models\PendaftarBantuan;

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil total data untuk widget
        $totalVerifikasi = VerifikasiLapangan::count();
        $totalRiwayat = RiwayatPenyaluran::count();
        $totalProgram = ProgramBantuan::count();
        $totalPendaftar = PendaftarBantuan::count();

        // Ambil 5 pendaftar terbaru untuk tabel recent sales
        $latestPendaftar = PendaftarBantuan::latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalVerifikasi',
            'totalRiwayat',
            'totalProgram',
            'totalPendaftar',
            'latestPendaftar'
        ));
    }
}
