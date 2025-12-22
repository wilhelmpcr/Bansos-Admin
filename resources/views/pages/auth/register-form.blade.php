<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun - Bansos Admin</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <style>
        :root {
            --primary: #1976d2;
            --primary-dark: #0d47a1;
            --gradient: linear-gradient(135deg, var(--primary), var(--primary-dark));
        }

        body {
            background: url("{{ asset('assets-admin/img/Bansos.jpg') }}") no-repeat center center fixed;
            background-size: cover;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', sans-serif;
            position: relative;
        }

        body::before {
            content: "";
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.55);
            z-index: 0;
        }

        .register-wrapper {
            position: relative;
            z-index: 1;
            width: 100%;
            max-width: 420px;
        }

        .register-card {
            background: #fff;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 20px 40px rgba(0, 0, 0, .25);
            animation: fadeUp .5s ease;
        }

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(25px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .card-header {
            background: var(--gradient);
            color: #fff;
            text-align: center;
            padding: 35px 20px;
        }

        .logo {
            width: 90px;
            height: 90px;
            background: #fff;
            border-radius: 50%;
            margin: 0 auto 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 10px 20px rgba(0, 0, 0, .2);
        }

        .logo img { width: 65px; }

        .card-header h2 { font-weight: 700; margin: 0; }
        .card-header p { margin: 6px 0 0; opacity: .9; font-size: 14px; }
        .card-body { padding: 30px; }

        .input-group-text { background: transparent; border: none; color: var(--primary); }
        .form-control { border-radius: 12px; padding: 12px 14px; }
        .password-wrapper { position: relative; }
        .toggle-password { position: absolute; right: 15px; top: 50%; transform: translateY(-50%); border: none; background: none; color: #777; }

        .btn-register {
            background: var(--gradient);
            border: none;
            color: #fff;
            border-radius: 12px;
            padding: 14px;
            width: 100%;
            font-weight: 600;
            transition: .3s;
        }
        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 18px rgba(25, 118, 210, .4);
        }

        .login-link { text-align: center; margin-top: 25px; font-size: 14px; }
        .login-link a { color: var(--primary); font-weight: 600; text-decoration: none; }
    </style>
</head>

<body>

    <div class="register-wrapper">
        <div class="register-card">
            <div class="card-header">
                <div class="logo">
                    <img src="{{ asset('assets-admin/img/polos.png') }}" alt="Logo Bansos">
                </div>
                <h2>Daftar Akun</h2>
                <p>Sistem Bantuan Sosial Terpadu</p>
            </div>

            <div class="card-body">

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('register.process') }}">
                    @csrf

                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="fa fa-user"></i></span>
                        <input type="text" name="username" class="form-control" placeholder="Username" required>
                    </div>

                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                        <input type="email" name="email" class="form-control" placeholder="Email" required>
                    </div>

                    <div class="input-group mb-3 password-wrapper">
                        <span class="input-group-text"><i class="fa fa-lock"></i></span>
                        <input type="password" name="password" class="form-control" placeholder="Password" required>
                    </div>

                    <div class="input-group mb-3 password-wrapper">
                        <span class="input-group-text"><i class="fa fa-lock"></i></span>
                        <input type="password" name="password_confirmation" class="form-control"
                            placeholder="Konfirmasi Password" required>
                    </div>

                    <div class="form-check mb-3">
                        <input type="checkbox" class="form-check-input" required>
                        <label class="form-check-label">
                            Saya menyetujui syarat dan ketentuan
                        </label>
                    </div>

                    <button type="submit" class="btn btn-register">
                        <i class="fa fa-user-plus me-2"></i> Daftar Sekarang
                    </button>

                    <div class="login-link">
                        Sudah punya akun? <a href="{{ route('login') }}">Masuk di sini</a>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
