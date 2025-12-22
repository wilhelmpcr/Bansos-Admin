<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Login - Sistem Bansos Terpadu</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    {{-- Font Awesome --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

    <style>
        body {
            min-height: 100vh;
            font-family: 'Segoe UI', sans-serif;
            background: url('{{ asset('assets-admin/img/Bansos.jpg') }}') no-repeat center center fixed;
            background-size: cover;
        }

        /* overlay supaya teks terbaca */
        .overlay {
            min-height: 100vh;
            background: rgba(13, 71, 161, 0.65);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .login-card {
            width: 100%;
            max-width: 1000px;
            background: #ffffff;
            border-radius: 18px;
            overflow: hidden;
            box-shadow: 0 20px 40px rgba(0, 0, 0, .35);
            display: grid;
            grid-template-columns: 1fr 1fr;
        }

        /* LEFT */
        .login-left {
            background: linear-gradient(135deg, #e3f2fd, #ffffff);
            padding: 40px;
        }

        .login-left img {
            width: 80px;
            margin-bottom: 15px;
        }

        .login-left h3 {
            font-weight: 800;
            color: #0d47a1;
        }

        .login-left p {
            color: #555;
            line-height: 1.7;
            margin-top: 15px;
        }

        .feature-box {
            margin-top: 30px;
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
        }

        .feature {
            background: #fff;
            border-radius: 12px;
            padding: 15px;
            box-shadow: 0 8px 15px rgba(0, 0, 0, .08);
            font-size: 14px;
        }

        .feature i {
            color: #1976d2;
            margin-bottom: 6px;
        }

        /* RIGHT */
        .login-right {
            padding: 40px;
            display: flex;
            align-items: center;
        }

        .login-form {
            width: 100%;
        }

        .login-form h2 {
            font-weight: 800;
            color: #0d47a1;
        }

        .form-control {
            padding: 14px;
            border-radius: 10px;
        }

        .btn-login {
            background: linear-gradient(135deg, #1976d2, #0d47a1);
            color: #fff;
            padding: 14px;
            font-weight: 700;
            border-radius: 10px;
            border: none;
        }

        .btn-login:hover {
            opacity: .9;
        }

        /* MOBILE */
        @media (max-width: 768px) {
            .login-card {
                grid-template-columns: 1fr;
            }

            .login-left {
                text-align: center;
            }

            .feature-box {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>

    <div class="overlay">
        <div class="login-card">

            {{-- LEFT --}}
            <div class="login-left">
                <img src="{{ asset('assets-admin/img/polos.png') }}" alt="Logo">
                <h3>SISTEM BANSOS TERPADU</h3>
                <strong class="text-primary">Peduli • Tepat Sasaran • Berkeadilan</strong>

                <p>
                    Platform terintegrasi untuk pengelolaan bantuan sosial secara
                    transparan, akuntabel, dan berkelanjutan.
                </p>

                <div class="feature-box">
                    <div class="feature">
                        <i class="fas fa-hand-holding-heart"></i><br>
                        Bantuan Tepat Sasaran
                    </div>
                    <div class="feature">
                        <i class="fas fa-users"></i><br>
                        Data Penerima Valid
                    </div>
                    <div class="feature">
                        <i class="fas fa-chart-line"></i><br>
                        Monitoring Real-time
                    </div>
                    <div class="feature">
                        <i class="fas fa-shield-alt"></i><br>
                        Keamanan Data
                    </div>
                </div>
            </div>

            {{-- RIGHT --}}
            <div class="login-right">
                <div class="login-form">
                    <h2 class="mb-2">Masuk ke Sistem</h2>
                    <p class="text-muted mb-4">Gunakan akun terdaftar Anda</p>

                    {{-- ALERT FLASH ERROR --}}
                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    {{-- VALIDATION ERRORS --}}
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login.process') }}">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Username</label>
                            <input type="text" name="username" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>

                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" name="remember">
                            <label class="form-check-label">Ingat Saya</label>
                        </div>

                        <button class="btn btn-login w-100">
                            <i class="fas fa-sign-in-alt me-1"></i> Login
                        </button>
                    </form>

                    <div class="text-center mt-4">
                        <small>Belum punya akun?
                            <a href="{{ route('register') }}">Daftar</a>
                        </small>
                    </div>
                </div>
            </div>

        </div>
    </div>

</body>

</html>
