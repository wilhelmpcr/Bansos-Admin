@extends('layouts.admin.app')

@section('content')
<body class="bg-light">

<div class="container py-4">
    <h2 class="mb-4 text-center">Tambah User</h2>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('user.store') }}"
                  method="POST"
                  enctype="multipart/form-data">
                @csrf

                {{-- NAMA --}}
                <div class="mb-3">
                    <label class="form-label">Nama</label>
                    <input type="text" name="name"
                           class="form-control"
                           value="{{ old('name') }}"
                           required>
                    @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                {{-- EMAIL --}}
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email"
                           class="form-control"
                           value="{{ old('email') }}"
                           required>
                    @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                {{-- PASSWORD --}}
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" name="password"
                           class="form-control"
                           required>
                    @error('password') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                {{-- KONFIRMASI PASSWORD --}}
                <div class="mb-3">
                    <label class="form-label">Konfirmasi Password</label>
                    <input type="password"
                           name="password_confirmation"
                           class="form-control"
                           required>
                </div>

                {{-- GENDER --}}
                <div class="mb-3">
                    <label class="form-label">Jenis Kelamin</label>
                    <select name="gender" class="form-select" required>
                        <option value="">-- Pilih Jenis Kelamin --</option>
                        <option value="male" {{ old('gender')=='male'?'selected':'' }}>Laki-laki</option>
                        <option value="female" {{ old('gender')=='female'?'selected':'' }}>Perempuan</option>
                    </select>
                    @error('gender') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                {{-- FOTO --}}
                <div class="mb-3">
                    <label class="form-label">Foto</label>
                    <input type="file"
                           name="foto"
                           class="form-control"
                           accept="image/*">
                    <small class="text-muted">
                        JPG / PNG, max 2MB
                    </small>
                    @error('foto') <small class="text-danger d-block">{{ $message }}</small> @enderror
                </div>

                {{-- BUTTON --}}
                <div class="text-end">
                    <button type="submit" class="btn btn-success">Simpan</button>
                    <a href="{{ route('user.index') }}" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>

</body>
@endsection
