<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
    <div class="col-md-5 mx-auto">
        <div class="card shadow">
            <div class="card-body">
                <h3 class="text-center mb-4">Form Login</h3>

                @if(session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                <form action="{{ route('login.process') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label>Username</label>
                        <input type="text" name="username" class="form-control" value="{{ old('username') }}">
                    </div>

                    <div class="mb-3">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control">
                    </div>

                    <button class="btn btn-primary w-100">Login</button>

                    <div class="mt-3 text-center">
                        Belum punya akun? <a href="{{ route('register.form') }}">Daftar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

</body>
</html>
