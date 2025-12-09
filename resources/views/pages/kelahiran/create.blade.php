@extends('layouts.admin.app')

@section('content')
<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Tambah Peristiwa Kelahiran</h4>
        </div>
        <div class="card-body">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $err)
                            <li>{{ $err }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('kelahiran.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row g-3">

                    <div class="col-md-6">
                        <label class="form-label">Nama Bayi</label>
                        <input type="text" name="nama_bayi" class="form-control" placeholder="Masukkan nama bayi" value="{{ old('nama_bayi') }}" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Anak (Warga)</label>
                        <select name="anak_warga_id" class="form-select" required>
                            <option value="">-- Pilih Anak --</option>
                            @foreach($warga as $w)
                                <option value="{{ $w->warga_id }}" {{ old('anak_warga_id') == $w->warga_id ? 'selected' : '' }}>
                                    {{ $w->nama }} ({{ $w->no_ktp }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Ayah</label>
                        <select name="ayah_warga_id" class="form-select" required>
                            <option value="">-- Pilih Ayah --</option>
                            @foreach($warga as $w)
                                @if($w->jenis_kelamin == 'L')
                                    <option value="{{ $w->warga_id }}" {{ old('ayah_warga_id') == $w->warga_id ? 'selected' : '' }}>
                                        {{ $w->nama }}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Ibu</label>
                        <select name="ibu_warga_id" class="form-select" required>
                            <option value="">-- Pilih Ibu --</option>
                            @foreach($warga as $w)
                                @if($w->jenis_kelamin == 'P')
                                    <option value="{{ $w->warga_id }}" {{ old('ibu_warga_id') == $w->warga_id ? 'selected' : '' }}>
                                        {{ $w->nama }}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" class="form-control" value="{{ old('tanggal_lahir') }}" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Tempat Lahir</label>
                        <input type="text" name="tempat_lahir" class="form-control" placeholder="Masukkan tempat lahir" value="{{ old('tempat_lahir') }}" required>
                    </div>

                    <div class="col-md-12">
                        <label class="form-label">Foto Bayi (Opsional)</label>
                        <input type="file" name="foto" class="form-control">
                    </div>

                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-success">Simpan</button>
                    <a href="{{ route('kelahiran.index') }}" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
