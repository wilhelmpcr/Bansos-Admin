<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Bantuan Sosial Kota Sukabumi</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            position: relative;
            overflow: hidden;
        }

        /* Background pattern */
        body::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image:
                radial-gradient(circle at 25% 25%, rgba(255, 255, 255, 0.2) 0%, transparent 55%),
                radial-gradient(circle at 75% 75%, rgba(255, 255, 255, 0.2) 0%, transparent 55%);
            z-index: -1;
        }

        .login-wrapper {
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            display: flex;
            max-width: 900px;
            width: 95%;
            position: relative;
            z-index: 1;
        }

        .login-info-panel {
            background: linear-gradient(135deg, #1e6b30, #2e8b57);
            color: white;
            padding: 30px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            flex: 1;
        }

        .logo-container {
            background: white;
            border-radius: 50%;
            width: 150px;
            height: 150px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .logo-text {
            font-weight: 800;
            font-size: 2.5rem;
            color: #1e6b30;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);
        }

        .login-info-panel h2 {
            font-weight: 700;
            margin-bottom: 15px;
            font-size: 1.8rem;
        }

        .login-info-panel h3 {
            font-weight: 600;
            margin-bottom: 10px;
            font-size: 1.3rem;
            color: #ffeb3b;
        }

        .login-info-panel p {
            font-size: 0.95rem;
            line-height: 1.6;
            opacity: 0.9;
            margin-bottom: 5px;
        }

        .agency-name {
            font-weight: 700;
            font-size: 1.1rem;
            margin-top: 15px;
            color: #ffeb3b;
            border-top: 1px solid rgba(255, 255, 255, 0.3);
            padding-top: 10px;
            width: 100%;
        }

        .login-form-panel {
            padding: 40px;
            flex: 1;
        }

        .login-form-panel h3 {
            color: #343a40;
            font-weight: 600;
            margin-bottom: 30px;
        }

        .form-control {
            border-radius: 8px;
            padding: 12px 15px;
            border: 1px solid #ced4da;
        }

        .form-control:focus {
            box-shadow: 0 0 0 0.25rem rgba(30, 107, 48, 0.25);
            border-color: #1e6b30;
        }

        .btn-login {
            background-color: #1e6b30;
            border-color: #1e6b30;
            border-radius: 8px;
            padding: 12px 0;
            font-size: 1.1rem;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-login:hover {
            background-color: #155724;
            border-color: #155724;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(30, 107, 48, 0.3);
        }

        .input-group-text {
            border-top-left-radius: 8px;
            border-bottom-left-radius: 8px;
            background-color: #e9ecef;
            border-right: none;
            color: #495057;
        }

        .input-group .form-control {
            border-top-left-radius: 0;
            border-bottom-left-radius: 0;
            border-left: none;
        }

        .mt-3 a {
            color: #1e6b30;
            font-weight: 500;
            text-decoration: none;
        }

        .mt-3 a:hover {
            text-decoration: underline;
        }

        .whatsapp-float {
            position: fixed;
            bottom: 25px;
            right: 25px;
            background-color: #25d366;
            color: #FFF;
            border-radius: 50px;
            text-align: center;
            font-size: 30px;
            box-shadow: 2px 2px 3px #999;
            z-index: 100;
            width: 60px;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }

        .whatsapp-float:hover {
            background-color: #128C7E;
            transform: scale(1.1);
        }

        @media (max-width: 768px) {
            .login-wrapper {
                flex-direction: column;
            }

            .login-info-panel {
                padding: 25px;
                border-bottom-left-radius: 0;
                border-top-right-radius: 15px;
            }

            .login-form-panel {
                padding: 30px;
            }
        }
    </style>
</head>

<body>
    <div class="login-wrapper">
        <div class="login-info-panel">
            <div class="logo-container">
                <div class="logo-text">BRKT</div>
            </div>
            <h2>BANTUAN SOSIAL</h2>
            <h3>BANSOS</h3>
            <p>BANTUAN SOSIAL TUNAI/NON TUNAI</p>
            <div class="agency-name">DINAS SOSIAL KOTA SUKABUMI</div>
        </div>

        <div class="login-form-panel">
            <h3 class="text-center">Masuk ke Akun Anda</h3>

            <!-- Jika menggunakan PHP/Laravel, bagian ini akan menampilkan pesan error -->
            <!--
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            -->

            <form action="#" method="POST">
                <!-- Jika menggunakan PHP/Laravel, tambahkan CSRF token -->
                <!-- @csrf -->

                <div class="mb-3">
                    <label for="username" class="form-label visually-hidden">Username</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                        <input type="text" name="username" id="username" class="form-control" placeholder="Username" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label visually-hidden">Password</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                        <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
                    </div>
                </div>

                <button type="submit" class="btn btn-login w-100 mt-3">
                    <i class="fas fa-sign-in-alt me-2"></i>Login
                </button>

                <div class="mt-4 text-center">
                    Belum punya akun? <a href="#">
                        <i class="fas fa-user-plus me-1"></i>Daftar Sekarang
                    </a>
                </div>
            </form>
        </div>
    </div>

    <a href="https://wa.me/6281234567890?text=Halo%20Admin%2C%20saya%20membutuhkan%20bantuan%20mengenai%20Login%20Aplikasi%20BANSOS."
        class="whatsapp-float" target="_blank" rel="noopener noreferrer">
        <i class="fab fa-whatsapp"></i>
    </a>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
