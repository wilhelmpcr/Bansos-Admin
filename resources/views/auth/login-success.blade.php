<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Berhasil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-success bg-opacity-10">

<div class="container text-center py-5">
    <h2>Login Berhasil 🎉</h2>
    <p>Selamat datang, <strong>{{ session('username') }}</strong>!</p>

    <div class="mt-4">
        <a href="{{ route('admin.dashboard') }}" class="btn btn-primary">Masuk ke Dashboard</a>
    </div>
</div>

</body>
</html>
