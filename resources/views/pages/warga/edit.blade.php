@extends('layouts.admin.app')

@section('content')
<div class="container mt-5">
    <h2 class="text-center mb-4">Edit Data Warga</h2>

    <form action="{{ route('warga.update', $warga->warga_id) }}"
          method="POST"
          enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row">
            {{-- FORM DATA --}}
            <div class="col-md-8">

                <div class="mb-3">
                    <label>No KTP</label>
                    <input type="text"
                           name="no_ktp"
                           value="{{ $warga->no_ktp }}"
                           class="form-control"
                           required
                           maxlength="16">
                </div>

                <div class="mb-3">
                    <label>Nama</label>
                    <input type="text"
                           name="nama"
                           value="{{ $warga->nama }}"
                           class="form-control"
                           required>
                </div>

                <div class="mb-3">
                    <label>Jenis Kelamin</label>
                    <select name="jenis_kelamin" class="form-select" required>
                        <option value="L" {{ $warga->jenis_kelamin == 'L' ? 'selected' : '' }}>
                            Laki-Laki
                        </option>
                        <option value="P" {{ $warga->jenis_kelamin == 'P' ? 'selected' : '' }}>
                            Perempuan
                        </option>
                    </select>
                </div>

                <div class="mb-3">
                    <label>Agama</label>
                    <input type="text"
                           name="agama"
                           value="{{ $warga->agama }}"
                           class="form-control"
                           required>
                </div>

                <div class="mb-3">
                    <label>Pekerjaan</label>
                    <input type="text"
                           name="pekerjaan"
                           value="{{ $warga->pekerjaan }}"
                           class="form-control"
                           required>
                </div>

                <div class="mb-3">
                    <label>Telp</label>
                    <input type="text"
                           name="telp"
                           value="{{ $warga->telp }}"
                           class="form-control">
                </div>

                <div class="mb-3">
                    <label>Email</label>
                    <input type="email"
                           name="email"
                           value="{{ $warga->email }}"
                           class="form-control">
                </div>

            </div>

            {{-- FOTO BUKTI --}}
            <div class="col-md-4">
                <label class="mb-2">Foto Bukti</label>

                @if ($warga->foto_bukti)
                    <div class="mb-2 text-center">
                        <img src="{{ asset('storage/' . $warga->foto_bukti) }}"
                             class="img-fluid rounded shadow"
                             style="max-height: 220px;">
                        <p class="text-muted mt-1">Foto saat ini</p>
                    </div>
                @endif

                <input type="file"
                       name="foto_bukti"
                       class="form-control"
                       accept="image/*">

                <small class="text-muted">
                    Kosongkan jika tidak ingin mengganti foto
                </small>
            </div>
        </div>

        <div class="text-end mt-4">
            <a href="{{ route('warga.index') }}" class="btn btn-secondary">
                Batal
            </a>
            <button type="submit" class="btn btn-primary">
                Update
            </button>
        </div>

    </form>
</div>
@endsection
