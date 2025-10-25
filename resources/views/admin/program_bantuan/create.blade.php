@extends('layouts.admin.app')

@section('content')
<body class="bg-light">

<div class="container py-4">
    <h2 class="mb-4 text-center">Tambah Program Bantuan</h2>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('program_bantuan.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="kode" class="form-label">Kode Program</label>
                    <input type="text" name="kode" id="kode" class="form-control" value="{{ old('kode') }}" required>
                    @error('kode') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="mb-3">
                    <label for="nama_program" class="form-label">Nama Program</label>
                    <input type="text" name="nama_program" id="nama_program" class="form-control" value="{{ old('nama_program') }}" required>
                    @error('nama_program') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="mb-3">
                    <label for="tahun" class="form-label">Tahun</label>
                    <input type="number" name="tahun" id="tahun" class="form-control" min="2000" max="2100" value="{{ old('tahun') }}" required>
                    @error('tahun') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi</label>
                    <textarea name="deskripsi" id="deskripsi" class="form-control" rows="3">{{ old('deskripsi') }}</textarea>
                    @error('deskripsi') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="mb-3">
                    <label for="anggaran" class="form-label">Anggaran (Rp)</label>
                    <input type="number" name="anggaran" id="anggaran" class="form-control" step="0.01" min="0" value="{{ old('anggaran') }}" required>
                    @error('anggaran') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="text-end">
                    <a href="{{ route('program_bantuan.index') }}" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

</body>
@endsection
