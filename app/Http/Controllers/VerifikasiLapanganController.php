<?php

namespace App\Http\Controllers;

use App\Models\VerifikasiLapangan;
use Illuminate\Http\Request;

class VerifikasiLapanganController extends Controller
{
    public function index()
    {
        $verifikasi = VerifikasiLapangan::latest()->paginate(10);
        return view('verifikasi_lapangan.index', compact('verifikasi'));
    }

    public function create()
    {
        return view('verifikasi_lapangan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'petugas' => 'required',
            'tanggal' => 'required|date',
        ]);

        VerifikasiLapangan::create($request->all());

        return redirect()->route('verifikasi_lapangan.index');
    }
}
