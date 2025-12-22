@extends('layouts.admin.app')

@section('content')
<div class="container py-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h3 class="mb-0">Edit User</h3>
            <small class="text-muted">Form edit user</small>
        </div>
        <div class="text-muted">
            Dashboard › Data User › Edit
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">

            <form action="{{ route('user.update', $user->id) }}"
                  method="POST"
                  enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row g-4">

                    {{-- KOLOM KIRI --}}
                    <div class="col-md-8">

                        <div class="mb-3">
                            <label class="form-label">Nama</label>
                            <input type="text"
                                   name="name"
                                   class="form-control"
                                   value="{{ old('name', $user->name) }}"
                                   required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email"
                                   name="email"
                                   class="form-control"
                                   value="{{ old('email', $user->email) }}"
                                   required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password"
                                   name="password"
                                   class="form-control"
                                   placeholder="Kosongkan jika tidak ingin mengubah">
                            <small class="text-muted">
                                Kosongkan password jika tidak ingin mengubah
                            </small>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Konfirmasi Password</label>
                            <input type="password"
                                   name="password_confirmation"
                                   class="form-control"
                                   placeholder="Kosongkan jika tidak ingin mengubah">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Role (Hak Akses)</label>
                            <select name="role" class="form-select">
                                <option value="user" {{ $user->role=='user'?'selected':'' }}>User</option>
                                <option value="admin" {{ $user->role=='admin'?'selected':'' }}>Admin</option>
                                <option value="superadmin" {{ $user->role=='superadmin'?'selected':'' }}>
                                    Super Admin
                                </option>
                            </select>
                        </div>

                    </div>

                    {{-- KOLOM KANAN --}}
                    <div class="col-md-4 text-center">

                        <label class="form-label d-block">Foto Profil</label>

                        <img src="{{ $user->foto_url }}"
                             class="rounded-circle img-thumbnail mb-3"
                             width="160"
                             height="160"
                             alt="Foto User"
                             onerror="this.onerror=null;this.src='{{ asset('assets-admin/img/aku.jpg') }}';">

                        <input type="file"
                               name="foto"
                               class="form-control mt-2">

                        <small class="text-muted d-block mt-1">
                            Biarkan kosong jika tidak ingin mengubah foto.
                        </small>

                    </div>

                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-primary">
                        Update
                    </button>
                    <a href="{{ route('user.index') }}" class="btn btn-secondary">
                        Batal
                    </a>
                </div>

            </form>

        </div>
    </div>

</div>
@endsection
