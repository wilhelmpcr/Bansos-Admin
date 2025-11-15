<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Berhasil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-info bg-opacity-10">

<div class="container py-5 text-center">
    <div class="card shadow-sm p-4">
        <h2>Selamat datang, {{ $username }} 🎉</h2>
        <p class="text-info fw-bold">Pendaftaran berhasil! Silakan login sekarang.</p>
        <a href="{{ route('login.form') }}" class="btn btn-primary mt-3">Ke Halaman Login</a>
    </div>
</div>

</body>
</html>
