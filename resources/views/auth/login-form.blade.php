<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Sistem Bansos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #e3f2fd 0%, #bbdefb 50%, #90caf9 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .login-container {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(33, 150, 243, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }
        .card {
            border: none;
            border-radius: 20px;
        }
        .card-body {
            padding: 2.5rem;
        }
        .form-control {
            border: 2px solid #e3f2fd;
            border-radius: 10px;
            padding: 12px 15px;
            transition: all 0.3s ease;
        }
        .form-control:focus {
            border-color: #2196f3;
            box-shadow: 0 0 0 0.2rem rgba(33, 150, 243, 0.25);
        }
        .btn-primary {
            background: linear-gradient(135deg, #2196f3 0%, #1976d2 100%);
            border: none;
            border-radius: 10px;
            padding: 12px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(33, 150, 243, 0.4);
        }
        h3 {
            color: #1976d2;
            font-weight: 700;
        }
        label {
            color: #424242;
            font-weight: 600;
            margin-bottom: 8px;
        }
        a {
            color: #1976d2;
            text-decoration: none;
            font-weight: 600;
        }
        a:hover {
            color: #0d47a1;
            text-decoration: underline;
        }
        .alert {
            border-radius: 10px;
            border: none;
        }

        /* Header Logo */
        .logo-section {
            text-align: center;
            margin-bottom: 25px;
        }
        .logo-section img {
            width: 70px;
            margin-bottom: 10px;
        }
        .logo-section h4 {
            font-weight: 700;
            color: #1565c0;
        }
        .logo-section p {
            font-size: 14px;
            color: #555;
            margin-top: -5px;
        }

        /* Floating WhatsApp Button */
        .whatsapp-float {
            position: fixed;
            width: 60px;
            height: 60px;
            bottom: 25px;
            right: 25px;
            background-color: #25d366;
            color: #FFF;
            border-radius: 50px;
            text-align: center;
            font-size: 30px;
            box-shadow: 0 5px 15px rgba(37, 211, 102, 0.4);
            z-index: 1000;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            animation: pulse 2s infinite;
            text-decoration: none;
        }
        .whatsapp-float:hover {
            background-color: #128C7E;
            color: #FFF;
            transform: scale(1.1);
            box-shadow: 0 8px 20px rgba(37, 211, 102, 0.6);
        }
        .whatsapp-tooltip {
            position: fixed;
            bottom: 90px;
            right: 25px;
            background: #333;
            color: white;
            padding: 8px 12px;
            border-radius: 6px;
            font-size: 14px;
            opacity: 0;
            transform: translateY(10px);
            transition: all 0.3s ease;
            pointer-events: none;
            z-index: 1000;
        }
        .whatsapp-float:hover + .whatsapp-tooltip {
            opacity: 1;
            transform: translateY(0);
        }
        @keyframes pulse {
            0% { box-shadow: 0 0 0 0 rgba(37, 211, 102, 0.7); }
            70% { box-shadow: 0 0 0 10px rgba(37, 211, 102, 0); }
            100% { box-shadow: 0 0 0 0 rgba(37, 211, 102, 0); }
        }
        @media (max-width: 768px) {
            .whatsapp-float {
                width: 50px;
                height: 50px;
                bottom: 20px;
                right: 20px;
                font-size: 25px;
            }
            .card-body {
                padding: 2rem;
            }
        }
    </style>
</head>
<body>
@include('layouts.admin.wa')

<div class="container py-5">
    <div class="col-md-5 mx-auto">
        <div class="card shadow login-container">
            <div class="card-body">

                <!-- Bagian Logo dan Judul -->
                <div class="logo-section">
                    <img src="https://cdn-icons-png.flaticon.com/512/3448/3448632.png" alt="Logo Bansos">
                    <h4>Sistem Bantuan Sosial</h4>
                    <p>Login untuk mengakses dashboard penerima dan pengelola bansos</p>
                </div>

                @if(session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                <form action="{{ route('login.process') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label class="form-label">Username</label>
                        <input type="text" name="username" class="form-control" value="{{ old('username') }}" placeholder="Masukkan username">
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Masukkan password">
                    </div>
                    <button class="btn btn-primary w-100 mb-3">Login</button>
                    <div class="mt-3 text-center">
                        <span class="text-muted">Belum punya akun?</span>
                        <a href="{{ route('register.form') }}">Daftar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

</body>
</html>
