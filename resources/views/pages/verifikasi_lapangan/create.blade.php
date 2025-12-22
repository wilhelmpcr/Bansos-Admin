@extends('layouts.admin.app')

@section('title', 'Tambah Verifikasi Lapangan')

@section('content')
<div class="container">
    <h1 class="mb-4">Tambah Verifikasi Lapangan</h1>

    <form method="POST" action="{{ route('verifikasi_lapangan.store') }}" enctype="multipart/form-data">
        @csrf

        {{-- Pendaftar --}}
        <div class="mb-3">
            <label class="form-label">Pendaftar <span class="text-danger">*</span></label>
            <select name="pendaftar_id" class="form-control" required>
                <option value="">-- Pilih Pendaftar --</option>
                @foreach ($pendaftar as $item)
                    <option value="{{ $item->pendaftar_id }}">
                        {{ $item->warga->nama ?? 'Nama tidak tersedia' }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Petugas --}}
        <div class="mb-3">
            <label class="form-label">Petugas <span class="text-danger">*</span></label>
            <input type="text" name="petugas" class="form-control" required>
        </div>

        {{-- Tanggal --}}
        <div class="mb-3">
            <label class="form-label">Tanggal Verifikasi <span class="text-danger">*</span></label>
            <input type="date" name="tanggal" class="form-control" required>
        </div>

        {{-- Skor --}}
        <div class="mb-3">
            <label class="form-label">Skor (0–100)</label>
            <input type="number" name="skor" class="form-control" min="0" max="100">
        </div>

        {{-- Catatan --}}
        <div class="mb-3">
            <label class="form-label">Catatan</label>
            <textarea name="catatan" class="form-control" rows="3"></textarea>
        </div>

        {{-- Foto --}}
        <div class="mb-3">
            <label class="form-label">Foto Verifikasi (opsional)</label>
            <input type="file" name="foto_verifikasi[]" class="form-control" multiple accept="image/*">
            <small class="text-muted">Bisa upload lebih dari satu foto (JPG / PNG)</small>
        </div>

        <button class="btn btn-success">
            <i class="fas fa-save me-1"></i>Simpan
        </button>

        <a href="{{ route('verifikasi_lapangan.index') }}" class="btn btn-secondary">
            Kembali
        </a>
    </form>
</div>
@endsection
