@extends('layouts.admin.app')

@section('content')
<div class="container">
    <h1>Edit Pendaftar Bantuan</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <strong>Terjadi kesalahan:</strong>
            <ul>
                @foreach($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('pendaftar-bantuan.update', $pendaftar_bantuan->pendaftar_id) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- WARGA --}}
        <div class="mb-3">
            <label for="warga_id" class="form-label">Warga</label>
            <select name="warga_id" id="warga_id" class="form-control" required>
                @foreach($warga as $w)
                    <option value="{{ $w->warga_id }}"
                        {{ (old('warga_id', $pendaftar_bantuan->warga_id) == $w->warga_id) ? 'selected' : '' }}>
                        {{ $w->nama }} ({{ $w->no_ktp }})
                    </option>
                @endforeach
            </select>
        </div>

        {{-- PROGRAM --}}
        <div class="mb-3">
            <label for="program_id" class="form-label">Program Bantuan</label>
            <select name="program_id" id="program_id" class="form-control" required>
                @foreach($program as $p)
                    <option value="{{ $p->program_id }}"
                        {{ (old('program_id', $pendaftar_bantuan->program_id) == $p->program_id) ? 'selected' : '' }}>
                        {{ $p->nama_program }} - {{ $p->tahun }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- STATUS --}}
        <div class="mb-3">
            <label for="status_seleksi" class="form-label">Status Seleksi</label>
            <select name="status_seleksi" id="status_seleksi" class="form-control" required>
                <option value="pending"
                    {{ old('status_seleksi', $pendaftar_bantuan->status_seleksi) == 'pending' ? 'selected' : '' }}>
                    Pending
                </option>
                <option value="diterima"
                    {{ old('status_seleksi', $pendaftar_bantuan->status_seleksi) == 'diterima' ? 'selected' : '' }}>
                    Diterima
                </option>
                <option value="ditolak"
                    {{ old('status_seleksi', $pendaftar_bantuan->status_seleksi) == 'ditolak' ? 'selected' : '' }}>
                    Ditolak
                </option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('pendaftar_bantuan.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
