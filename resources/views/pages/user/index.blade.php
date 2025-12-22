@extends('layouts.admin.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4 text-center">Data User</h2>

    <div class="mb-3 text-end">
        <a href="{{ route('user.create') }}" class="btn btn-primary">+ Tambah User</a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- FILTER & SEARCH --}}
    <form method="GET" action="{{ route('user.index') }}" class="mb-3">
        <div class="row g-2 align-items-center">
            <div class="col-md-3 col-lg-2">
                <select name="email_domain" class="form-select" onchange="this.form.submit()">
                    <option value="">All Domains</option>
                    <option value="gmail" {{ request('email_domain') == 'gmail' ? 'selected' : '' }}>Gmail</option>
                    <option value="example" {{ request('email_domain') == 'example' ? 'selected' : '' }}>example.com</option>
                </select>
            </div>

            <div class="col-md-3 col-lg-2">
                <select name="role" class="form-select" onchange="this.form.submit()">
                    <option value="">All Roles</option>
                    <option value="user" {{ request('role') == 'user' ? 'selected' : '' }}>User</option>
                    <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                </select>
            </div>

            <div class="col-md-6 col-lg-4">
                <div class="input-group">
                    <input type="text"
                           name="search"
                           class="form-control"
                           placeholder="Search name or email"
                           value="{{ request('search') }}">
                    <button type="submit" class="btn btn-primary">Search</button>
                    <a href="{{ route('user.index') }}" class="btn btn-secondary">Clear</a>
                </div>
            </div>
        </div>
    </form>

    {{-- TABLE --}}
    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped align-middle">
                    <thead class="table-dark text-center">
                        <tr>
                            <th>No</th>
                            <th>Foto</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Password (Hashed)</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($users as $index => $user)
                            <tr>
                                <td class="text-center">
                                    {{ $users->firstItem() + $index }}
                                </td>

                                {{-- FOTO USER --}}
                                <td class="text-center">
                                    <img
                                        src="{{ $user->foto && file_exists(public_path('storage/' . $user->foto))
                                            ? asset('storage/' . $user->foto)
                                            : asset('assets-admin/img/default-user.png') }}"
                                        width="50"
                                        height="50"
                                        class="rounded-circle img-thumbnail"
                                        alt="Foto User">
                                </td>

                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>

                                <td class="text-center">
                                    {{ ucfirst($user->role) }}
                                </td>

                                <td class="text-muted">
                                    {{ Str::limit($user->password, 20, '...') }}
                                </td>

                                <td class="text-center">
                                    <a href="{{ route('user.show', $user->id) }}" class="btn btn-info btn-sm">
                                        Detail
                                    </a>

                                    <a href="{{ route('user.edit', $user->id) }}" class="btn btn-warning btn-sm">
                                        Edit
                                    </a>

                                    <form action="{{ route('user.destroy', $user->id) }}"
                                          method="POST"
                                          class="d-inline"
                                          onsubmit="return confirm('Yakin ingin menghapus user ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted">
                                    Belum ada data user
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="mt-3">
                    {{ $users->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>

    <div class="text-center mt-4">
        <a href="{{ url('/dashboard') }}" class="btn btn-secondary">
            Kembali ke Dashboard
        </a>
    </div>
</div>
@endsection
