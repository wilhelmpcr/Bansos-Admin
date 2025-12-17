@extends('layouts.admin.app')

@section('content')
<div class="container mt-4">
    <h3>Tambah Riwayat Penyaluran</h3>

    {{-- Tampilkan pesan sukses/eror --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('riwayat_penyaluran.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- Pilih Pendaftar Bantuan --}}
        <div class="mb-3">
            <label>Pendaftar Bantuan</label>
            <select name="pendaftar_id" class="form-control" required>
                <option value="">-- Pilih Pendaftar --</option>
                @foreach($pendaftars as $d)
                    <option value="{{ $d->pendaftar_id }}">
                        {{ $d->warga->nama ?? 'N/A' }} -
                        {{ $d->program->nama_program ?? 'N/A' }}
                        ({{ $d->status_seleksi ?? 'pending' }})
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Tanggal Penyaluran --}}
        <div class="mb-3">
            <label>Tanggal Penyaluran</label>
            <input type="date" name="tanggal" class="form-control" required>
        </div>

        {{-- Jumlah Bantuan --}}
        <div class="mb-3">
            <label>Jumlah Bantuan</label>
            <input type="number" name="jumlah" class="form-control" step="0.01" required>
        </div>

        {{-- Keterangan --}}
        <div class="mb-3">
            <label>Keterangan</label>
            <textarea name="keterangan" class="form-control" rows="3"></textarea>
        </div>

        {{-- Status Penyaluran --}}
        <div class="mb-3">
            <label>Status</label>
            <select name="status" class="form-control" required>
                <option value="draft">Draft</option>
                <option value="diproses">Diproses</option>
                <option value="selesai" selected>Selesai</option>
                <option value="dibatalkan">Dibatalkan</option>
            </select>
        </div>

        {{-- Upload File --}}
        <div class="mb-3">
            <label>Bukti Penyaluran (opsional)</label>
            <input type="file" name="file" class="form-control" accept=".jpg,.jpeg,.png,.pdf">
            <small class="text-muted">Maksimal 2MB. Format: JPG, PNG, PDF</small>
        </div>

        {{-- Tombol --}}
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('riwayat_penyaluran.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
