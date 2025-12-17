{{-- resources/views/pages/auth/register.blade.php --}}
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun - Bansos Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --primary: #1976d2;
            --primary-dark: #0d47a1;
            --gradient: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
        }

        body {
            background: var(--gradient);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            font-family: 'Segoe UI', sans-serif;
        }

        .register-wrapper {
            width: 100%;
            max-width: 450px;
        }

        .register-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
            overflow: hidden;
            animation: slideUp 0.5s ease-out;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .card-header {
            background: var(--gradient);
            color: white;
            text-align: center;
            padding: 30px 20px;
        }

        .card-header h2 {
            font-weight: 700;
            margin: 0;
            font-size: 28px;
        }

        .card-header p {
            opacity: 0.9;
            margin: 10px 0 0 0;
        }

        .card-body {
            padding: 30px;
        }

        .input-group {
            margin-bottom: 20px;
        }

        .input-group-text {
            background: transparent;
            border: none;
            color: var(--primary);
            font-size: 18px;
        }

        .form-control {
            border: 2px solid #e0e0e0;
            border-radius: 12px;
            padding: 12px 15px;
            font-size: 16px;
            transition: all 0.3s;
        }

        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 0.25rem rgba(25, 118, 210, 0.25);
        }

        .password-wrapper {
            position: relative;
        }

        .toggle-password {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #777;
            cursor: pointer;
        }

        .btn-register {
            background: var(--gradient);
            border: none;
            border-radius: 12px;
            padding: 14px;
            font-weight: 600;
            font-size: 16px;
            color: white;
            width: 100%;
            transition: all 0.3s;
            margin-top: 10px;
        }

        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(25, 118, 210, 0.3);
        }

        .login-link {
            text-align: center;
            margin-top: 25px;
            padding-top: 20px;
            border-top: 1px solid #eee;
            color: #666;
        }

        .login-link a {
            color: var(--primary);
            font-weight: 600;
            text-decoration: none;
        }

        .login-link a:hover {
            text-decoration: underline;
        }

        .logo {
            width: 80px;
            height: 80px;
            background: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .logo i {
            font-size: 36px;
            color: var(--primary);
        }
    </style>
</head>

<body>

    <div class="register-wrapper">
        <div class="register-card">
            <div class="card-header">
                <div class="logo">
                    <i class="fas fa-hand-holding-heart"></i>
                </div>
                <h2>Daftar Akun</h2>
                <p>Sistem Bantuan Sosial Terpadu</p>
            </div>

            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        <strong>Perhatian!</strong> Mohon perbaiki kesalahan berikut:
                        <ul class="mb-0 mt-2">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show">
                        <i class="fas fa-check-circle me-2"></i>
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                {{-- PERBAIKAN DI SINI: route('register.post') --}}
                <form action="{{ route('register.process') }}" method="POST" id="registerForm">
                    @csrf

                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="fas fa-user"></i>
                        </span>
                        <input type="text" name="username"
                            class="form-control @error('username') is-invalid @enderror" placeholder="Username"
                            value="{{ old('username') }}" required>
                        @error('username')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="fas fa-envelope"></i>
                        </span>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                            placeholder="Email" value="{{ old('email') }}" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="input-group password-wrapper">
                        <span class="input-group-text">
                            <i class="fas fa-lock"></i>
                        </span>
                        <input type="password" name="password" id="password"
                            class="form-control @error('password') is-invalid @enderror" placeholder="Password"
                            required>
                        <button type="button" class="toggle-password" id="togglePassword">
                            <i class="fas fa-eye"></i>
                        </button>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="input-group password-wrapper">
                        <span class="input-group-text">
                            <i class="fas fa-lock"></i>
                        </span>
                        <input type="password" name="password_confirmation" id="confirmPassword" class="form-control"
                            placeholder="Konfirmasi Password" required>
                        <button type="button" class="toggle-password" id="toggleConfirmPassword">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>

                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" id="terms" required>
                        <label class="form-check-label" for="terms">
                            Saya menyetujui <a href="#" data-bs-toggle="modal" data-bs-target="#termsModal">syarat
                                dan ketentuan</a>
                        </label>
                    </div>

                    <button type="submit" class="btn btn-register" id="submitBtn">
                        <i class="fas fa-user-plus me-2"></i>Daftar Sekarang
                    </button>

                    <div class="login-link">
                        Sudah punya akun? <a href="{{ route('login') }}">Masuk di sini</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Terms Modal -->
    <div class="modal fade" id="termsModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Syarat dan Ketentuan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p>Dengan mendaftar, Anda menyetujui bahwa:</p>
                    <ul>
                        <li>Data yang diisi adalah benar dan akurat</li>
                        <li>Anda akan menggunakan sistem sesuai peraturan</li>
                        <li>Data pribadi akan dilindungi sesuai kebijakan privasi</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Toggle password visibility
            const togglePassword = document.getElementById('togglePassword');
            const password = document.getElementById('password');
            const toggleConfirmPassword = document.getElementById('toggleConfirmPassword');
            const confirmPassword = document.getElementById('confirmPassword');

            if (togglePassword) {
                togglePassword.addEventListener('click', function() {
                    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                    password.setAttribute('type', type);
                    this.innerHTML = type === 'password' ? '<i class="fas fa-eye"></i>' :
                        '<i class="fas fa-eye-slash"></i>';
                });
            }

            if (toggleConfirmPassword) {
                toggleConfirmPassword.addEventListener('click', function() {
                    const type = confirmPassword.getAttribute('type') === 'password' ? 'text' : 'password';
                    confirmPassword.setAttribute('type', type);
                    this.innerHTML = type === 'password' ? '<i class="fas fa-eye"></i>' :
                        '<i class="fas fa-eye-slash"></i>';
                });
            }

            // Form validation
            const form = document.getElementById('registerForm');
            const submitBtn = document.getElementById('submitBtn');

            if (form) {
                form.addEventListener('submit', function(e) {
                    const passwordVal = password.value;
                    const confirmPasswordVal = confirmPassword.value;

                    // Validate password match
                    if (passwordVal !== confirmPasswordVal) {
                        e.preventDefault();
                        alert('Password dan konfirmasi password tidak cocok!');
                        return;
                    }

                    // Validate password strength
                    if (passwordVal.length < 3 || !/[A-Z]/.test(passwordVal)) {
                        e.preventDefault();
                        alert('Password minimal 3 karakter dan mengandung huruf kapital!');
                        return;
                    }

                    // Show loading
                    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Memproses...';
                    submitBtn.disabled = true;
                });
            }
        });
    </script>
</body>

</html>
