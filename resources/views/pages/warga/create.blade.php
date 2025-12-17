@extends('layouts.admin.app')

@section('content')
<div class="container mt-5">
    <h2 class="text-center mb-4">Tambah Data Warga</h2>

    <div class="card shadow-sm">
        <div class="card-body">

            {{-- Tampilkan error validasi --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('warga.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label">No KTP</label>
                    <input type="text"
                           name="no_ktp"
                           class="form-control"
                           value="{{ old('no_ktp') }}"
                           required
                           maxlength="16">
                </div>

                <div class="mb-3">
                    <label class="form-label">Nama</label>
                    <input type="text"
                           name="nama"
                           class="form-control"
                           value="{{ old('nama') }}"
                           required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Jenis Kelamin</label>
                    <select name="jenis_kelamin" class="form-select" required>
                        <option value="">-- Pilih --</option>
                        <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>
                            Laki-Laki
                        </option>
                        <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>
                            Perempuan
                        </option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Agama</label>
                    <input type="text"
                           name="agama"
                           class="form-control"
                           value="{{ old('agama') }}"
                           required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Pekerjaan</label>
                    <input type="text"
                           name="pekerjaan"
                           class="form-control"
                           value="{{ old('pekerjaan') }}"
                           required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Telp</label>
                    <input type="text"
                           name="telp"
                           class="form-control"
                           value="{{ old('telp') }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email"
                           name="email"
                           class="form-control"
                           value="{{ old('email') }}">
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('warga.index') }}" class="btn btn-secondary">
                        Batal
                    </a>
                    <button type="submit" class="btn btn-primary">
                        Simpan
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection
