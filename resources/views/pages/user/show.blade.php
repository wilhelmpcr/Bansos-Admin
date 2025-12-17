@extends('layouts.admin.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Detail User</h2>

    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th width="30%">Nama</th>
                    <td>{{ $user->name }}</td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>{{ $user->email }}</td>
                </tr>
                <tr>
                    <th>Gender</th>
                    <td>{{ ucfirst($user->gender) }}</td>
                </tr>
                <tr>
                    <th>Role</th>
                    <td>{{ ucfirst($user->role) }}</td>
                </tr>
                <tr>
                    <th>Dibuat</th>
                    <td>{{ $user->created_at->format('d M Y H:i') }}</td>
                </tr>
                <tr>
                    <th>Terakhir Update</th>
                    <td>{{ $user->updated_at->format('d M Y H:i') }}</td>
                </tr>
            </table>

            <a href="{{ route('user.index') }}" class="btn btn-secondary">
                ⬅ Kembali
            </a>
        </div>
    </div>
</div>
@endsection
