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

    {{-- PENTING: multipart untuk upload --}}
    <form action="{{ route('pendaftar_bantuan.update', $pendaftar_bantuan->pendaftar_id) }}"
          method="POST"
          enctype="multipart/form-data">

        @csrf
        @method('PUT')

        {{-- FOTO WARGA --}}
        <div class="mb-3">
            <label class="form-label">Foto Warga</label>

            @if(!empty($pendaftar_bantuan->warga->foto))
                <div class="mb-2">
                    <img src="{{ asset('storage/'.$pendaftar_bantuan->warga->foto) }}"
                         width="120"
                         class="img-thumbnail">
                </div>
            @endif

            <input type="file" name="foto" class="form-control" accept="image/*">
            <small class="text-muted">Kosongkan jika tidak ingin mengganti foto</small>
        </div>

        {{-- WARGA --}}
        <div class="mb-3">
            <label for="warga_id" class="form-label">Warga</label>
            <select name="warga_id" class="form-control" required>
                @foreach($warga as $w)
                    <option value="{{ $w->warga_id }}"
                        {{ old('warga_id', $pendaftar_bantuan->warga_id) == $w->warga_id ? 'selected' : '' }}>
                        {{ $w->nama }} ({{ $w->no_ktp }})
                    </option>
                @endforeach
            </select>
        </div>

        {{-- PROGRAM --}}
        <div class="mb-3">
            <label class="form-label">Program Bantuan</label>
            <select name="program_id" class="form-control" required>
                @foreach($program as $p)
                    <option value="{{ $p->program_id }}"
                        {{ old('program_id', $pendaftar_bantuan->program_id) == $p->program_id ? 'selected' : '' }}>
                        {{ $p->nama_program }} - {{ $p->tahun }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- STATUS --}}
        <div class="mb-3">
            <label class="form-label">Status Seleksi</label>
            <select name="status_seleksi" class="form-control" required>
                <option value="pending" {{ old('status_seleksi', $pendaftar_bantuan->status_seleksi) == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="diterima" {{ old('status_seleksi', $pendaftar_bantuan->status_seleksi) == 'diterima' ? 'selected' : '' }}>Diterima</option>
                <option value="ditolak" {{ old('status_seleksi', $pendaftar_bantuan->status_seleksi) == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
            </select>
        </div>

        <button class="btn btn-primary">Update</button>
        <a href="{{ route('pendaftar_bantuan.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
