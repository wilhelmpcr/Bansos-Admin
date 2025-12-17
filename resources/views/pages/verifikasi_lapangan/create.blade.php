@extends('layouts.admin.app')

@section('title', 'Tambah Verifikasi')

@section('content')
<div class="container">
    <h1>Tambah Verifikasi Lapangan</h1>

    <form method="POST" action="{{ route('verifikasi_lapangan.store') }}">
        @csrf

        <div class="mb-3">
            <label>Petugas</label>
            <input type="text" name="petugas" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Tanggal</label>
            <input type="date" name="tanggal" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Catatan</label>
            <textarea name="catatan" class="form-control"></textarea>
        </div>

        <div class="mb-3">
            <label>Skor</label>
            <input type="number" step="0.01" name="skor" class="form-control">
        </div>

        <button class="btn btn-success">Simpan</button>
        <a href="{{ route('verifikasi_lapangan.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
