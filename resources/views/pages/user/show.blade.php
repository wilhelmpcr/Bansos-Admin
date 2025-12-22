@extends('layouts.admin.app')

@section('content')
<div class="container py-4">
    <h3 class="mb-4">Detail User</h3>

    <div class="card shadow-sm">
        <div class="card-body">

            {{-- FOTO USER (AMAN, AUTO DEFAULT) --}}
            <div class="text-center mb-4">
                <img
                    src="{{ $user->foto_url }}"
                    alt="Foto {{ $user->name ?? 'User' }}"
                    class="rounded-circle img-thumbnail shadow"
                    width="140"
                    height="140"
                    onerror="this.onerror=null;this.src='{{ asset('assets-admin/img/user.jpg') }}';">
            </div>

            <table class="table table-bordered align-middle mb-4">
                <tr>
                    <th width="30%">Nama</th>
                    <td>{{ $user->name ?: '-' }}</td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>{{ $user->email ?: '-' }}</td>
                </tr>
                <tr>
                    <th>Gender</th>
                    <td>{{ $user->gender ? ucfirst($user->gender) : '-' }}</td>
                </tr>
                <tr>
                    <th>Role</th>
                    <td>
                        <span class="badge bg-primary">
                            {{ $user->role ? ucfirst($user->role) : '-' }}
                        </span>
                    </td>
                </tr>
                <tr>
                    <th>Dibuat</th>
                    <td>{{ $user->created_at?->format('d M Y H:i') ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Terakhir Update</th>
                    <td>{{ $user->updated_at?->format('d M Y H:i') ?? '-' }}</td>
                </tr>
            </table>

            <a href="{{ route('user.index') }}" class="btn btn-secondary">
                ⬅ Kembali
            </a>

        </div>
    </div>
</div>
@endsection
