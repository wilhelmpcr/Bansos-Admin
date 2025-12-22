@extends('layouts.admin.app')

@section('content')

<div class="container py-4">
    <h2 class="mb-4 text-center">Edit Program Bantuan</h2>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('program_bantuan.update', $program->program_id) }}"
                  method="POST"
                  enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="kode" class="form-label">Kode Program</label>
                    <input
                        type="text"
                        name="kode"
                        id="kode"
                        class="form-control @error('kode') is-invalid @enderror"
                        value="{{ old('kode', $program->kode) }}"
                        required
                    >
                    @error('kode')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="nama_program" class="form-label">Nama Program</label>
                    <input
                        type="text"
                        name="nama_program"
                        id="nama_program"
                        class="form-control @error('nama_program') is-invalid @enderror"
                        value="{{ old('nama_program', $program->nama_program) }}"
                        required
                    >
                    @error('nama_program')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="tahun" class="form-label">Tahun</label>
                    <input
                        type="number"
                        name="tahun"
                        id="tahun"
                        class="form-control @error('tahun') is-invalid @enderror"
                        min="2000"
                        max="2100"
                        value="{{ old('tahun', $program->tahun) }}"
                        required
                    >
                    @error('tahun')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi</label>
                    <textarea
                        name="deskripsi"
                        id="deskripsi"
                        class="form-control @error('deskripsi') is-invalid @enderror"
                        rows="3"
                    >{{ old('deskripsi', $program->deskripsi) }}</textarea>
                    @error('deskripsi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="anggaran" class="form-label">Anggaran (Rp)</label>
                    <input
                        type="number"
                        name="anggaran"
                        id="anggaran"
                        class="form-control @error('anggaran') is-invalid @enderror"
                        min="0"
                        step="0.01"
                        value="{{ old('anggaran', $program->anggaran) }}"
                        required
                    >
                    @error('anggaran')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- ✅ TAMBAH FOTO PROGRAM --}}
                <div class="mb-3">
                    <label for="foto" class="form-label">Foto Program (Opsional)</label>
                    <input
                        type="file"
                        name="foto"
                        id="foto"
                        class="form-control @error('foto') is-invalid @enderror"
                        accept="image/*"
                    >
                    @error('foto')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                    @if(!empty($program->foto))
                        <div class="mt-2">
                            <small class="text-muted d-block mb-1">Foto saat ini:</small>
                            <img src="{{ asset('storage/'.$program->foto) }}"
                                 class="img-thumbnail"
                                 style="max-width:200px">
                        </div>
                    @endif
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('program_bantuan.index') }}" class="btn btn-secondary">
                        Batal
                    </a>
                    <button type="submit" class="btn btn-success">
                        Perbarui
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>

@endsection
