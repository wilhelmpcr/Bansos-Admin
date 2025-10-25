<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
    <div class="col-md-5 mx-auto">
        <div class="card shadow">
            <div class="card-body">
                <h3 class="text-center mb-4">Form Register</h3>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('register.process') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label>Username</label>
                        <input type="text" name="username" class="form-control" value="{{ old('username') }}">
                    </div>

                    <div class="mb-3">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email') }}">
                    </div>

                    <div class="mb-3">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control">
                    </div>

                    <button class="btn btn-success w-100">Daftar</button>

                    <div class="mt-3 text-center">
                        Sudah punya akun? <a href="{{ route('login.form') }}">Login</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

</body>
</html>
