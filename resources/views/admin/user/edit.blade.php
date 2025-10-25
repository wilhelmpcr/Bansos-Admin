@extends('layouts.admin.app')

@section('content')
<body class="bg-light">

<div class="container py-4">
    <h2 class="mb-4 text-center">Edit User</h2>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('user.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="name" class="form-label">Nama</label>
                    <input type="text" id="name" name="name" value="{{ $user->name }}" class="form-control" required>
                    @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" id="email" name="email" value="{{ $user->email }}" class="form-control" required>
                    @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password Baru (Opsional)</label>
                    <input type="password" id="password" name="password" class="form-control">
                    @error('password') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" class="form-control">
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-success">Perbarui</button>
                    <a href="{{ route('user.index') }}" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>

</body>
@endsection
