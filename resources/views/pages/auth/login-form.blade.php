<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gambar Bansos | Sistem Bantuan Sosial</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Gaya CSS yang Dipertahankan dari Kode Asli */
        body {
            background: linear-gradient(135deg, #e3f2fd 0%, #bbdefb 50%, #90caf9 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding: 15px;
        }

        .login-container {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(33, 150, 243, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            max-width: 1000px;
            /* Diperbesar untuk layout dua kolom */
            width: 90%;
        }

        .card {
            border: none;
            border-radius: 20px;
        }

        .card-body {
            padding: 0;
            /* Diubah untuk layout grid */
        }

        h3 {
            color: #1976d2;
            font-weight: 700;
        }

        /* Layout Grid untuk Gambar dan Form */
        .content-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            min-height: 600px;
        }

        /* Kolom Gambar */
        .image-column {
            background: linear-gradient(135deg, #1976d2 0%, #1565c0 100%);
            border-radius: 20px 0 0 20px;
            padding: 0;
            display: flex;
            flex-direction: column;
            color: white;
            position: relative;
            overflow: hidden;
        }

        .image-column::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.3);
            z-index: 1;
        }

        .image-content {
            position: relative;
            z-index: 2;
            display: flex;
            flex-direction: column;
            height: 100%;
            padding: 30px;
            justify-content: center;
        }

        .bansos-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            position: absolute;
            top: 0;
            left: 0;
            z-index: 0;
        }

        .image-text-content {
            position: relative;
            z-index: 3;
            text-align: center;
            background: rgba(25, 118, 210, 0.8);
            padding: 20px;
            border-radius: 15px;
            margin-top: auto;
        }

        .image-caption {
            font-style: italic;
            margin-top: 15px;
            font-size: 14px;
            color: rgba(255, 255, 255, 0.9);
        }

        /* Kolom Form Login */
        .form-column {
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
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
            color: white;
        }

        .logo-section p {
            font-size: 14px;
            color: rgba(255, 255, 255, 0.9);
            margin-top: -5px;
        }

        /* Gaya untuk Form Login */
        .login-form {
            background-color: #f8f9fa;
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }

        .form-control {
            border-radius: 10px;
            padding: 12px 15px;
            border: 1px solid #ced4da;
            transition: all 0.3s;
        }

        .form-control:focus {
            border-color: #1976d2;
            box-shadow: 0 0 0 0.2rem rgba(25, 118, 210, 0.25);
        }

        .btn-login {
            background: linear-gradient(135deg, #1976d2 0%, #1565c0 100%);
            border: none;
            border-radius: 10px;
            padding: 12px;
            font-weight: 600;
            color: white;
            width: 100%;
            transition: all 0.3s;
        }

        .btn-login:hover {
            background: linear-gradient(135deg, #1565c0 0%, #0d47a1 100%);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(25, 118, 210, 0.4);
        }

        .form-label {
            font-weight: 600;
            color: #495057;
            margin-bottom: 8px;
        }

        .forgot-password {
            text-align: right;
            margin-top: 10px;
        }

        .forgot-password a {
            color: #1976d2;
            text-decoration: none;
            font-size: 14px;
        }

        .forgot-password a:hover {
            text-decoration: underline;
        }

        /* Gaya untuk WhatsApp Float - Dipertahankan */
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

        @keyframes pulse {
            0% {
                box-shadow: 0 0 0 0 rgba(37, 211, 102, 0.7);
            }

            70% {
                box-shadow: 0 0 0 10px rgba(37, 211, 102, 0);
            }

            100% {
                box-shadow: 0 0 0 0 rgba(37, 211, 102, 0);
            }
        }

        /* Responsif untuk tablet dan mobile */
        @media (max-width: 992px) {
            .content-grid {
                grid-template-columns: 1fr;
                min-height: auto;
            }

            .image-column {
                border-radius: 20px 20px 0 0;
                min-height: 300px;
            }

            .form-column {
                padding: 30px;
            }

            .image-content {
                padding: 20px;
            }
        }

        @media (max-width: 768px) {
            .whatsapp-float {
                width: 50px;
                height: 50px;
                bottom: 20px;
                right: 20px;
                font-size: 25px;
            }

            .login-container {
                width: 95%;
            }

            .form-column {
                padding: 20px;
            }
        }
    </style>
</head>

<body>

    <a href="https://wa.me/6281234567890" class="whatsapp-float" target="_blank" rel="noopener noreferrer">
        <i class="fab fa-whatsapp"></i>
    </a>

    <div class="container py-4">
        <div class="login-container mx-auto">
            <div class="card shadow">
                <div class="card-body">
                    <div class="content-grid">
                        <!-- Kolom Gambar di Kiri -->
                        <div class="image-column">

                            <img src="{{ asset('assets-admin/img/Bansos.jpg') }}" alt="Gambar Pembagian Bantuan Sosial"
                                class="bansos-image">


                        </div>

                        <!-- Kolom Form Login di Kanan -->
                        <div class="form-column">
                            <!-- Form Login -->
                            <div class="login-form">
                                <h5 class="text-center mb-4" style="color: #1976d2;">Masuk ke Sistem</h5>
                                <form action="{{ route('login.process') }}" method="POST">
                                    @csrf
                                    <div class="mb-4">
                                        <label class="form-label">Username</label>
                                        <input type="text" name="username" class="form-control"
                                            value="{{ old('username') }}" placeholder="Masukkan username">
                                    </div>
                                    <div class="mb-4">
                                        <label class="form-label">Password</label>
                                        <input type="password" name="password" class="form-control"
                                            placeholder="Masukkan password">
                                    </div>
                                    <button class="btn btn-primary w-100 mb-3">Login</button>
                                    <div class="mt-3 text-center">
                                        <span class="text-muted">Belum punya akun?</span>
                                        <a href="{{ route('register.form') }}">Daftar</a>
                                    </div>
                                </form>
                            </div>

                            <div class="mt-4 text-center">
                                <a href="#" class="btn btn-sm btn-outline-primary">Lihat Galeri Lainnya</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
