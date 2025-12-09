<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap');

        body {
            font-family: 'Poppins', sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(-45deg, #74ABE2, #5563DE, #23A6D5, #23D5AB);
            background-size: 400% 400%;
            animation: gradientShift 10s ease infinite;
        }

        @keyframes gradientShift {
            0% {background-position: 0% 50%;}
            50% {background-position: 100% 50%;}
            100% {background-position: 0% 50%;}
        }

        .card {
            border: none;
            border-radius: 20px;
            backdrop-filter: blur(15px);
            background: rgba(255, 255, 255, 0.15);
            box-shadow: 0 15px 30px rgba(0,0,0,0.2);
            color: #fff;
            transition: all 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.25);
        }

        .card-body {
            padding: 2rem;
        }

        .card h3 {
            font-weight: 700;
            text-align: center;
            color: #fff;
            letter-spacing: 0.5px;
        }

        .form-control {
            border-radius: 12px;
            background-color: rgba(255, 255, 255, 0.15);
            border: none;
            color: #fff;
            padding: 10px 40px 10px 45px;
        }

        .form-control:focus {
            background-color: rgba(255, 255, 255, 0.25);
            box-shadow: none;
            border: 1px solid #9fe0ff;
        }

        .form-label {
            color: #e3e3e3;
            font-weight: 500;
        }

        .input-group-text {
            background: transparent;
            border: none;
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #cce6ff;
        }

        .btn-success {
            background: linear-gradient(90deg, #00c6ff, #0072ff);
            border: none;
            border-radius: 12px;
            font-weight: 600;
            transition: 0.3s;
        }

        .btn-success:hover {
            background: linear-gradient(90deg, #0097e6, #0059ff);
            transform: scale(1.03);
        }

        .text-center a {
            text-decoration: none;
            color: #fff;
            font-weight: 500;
        }

        .text-center a:hover {
            text-decoration: underline;
        }

        .alert {
            background-color: rgba(255, 0, 0, 0.2);
            border: 1px solid rgba(255, 0, 0, 0.3);
            border-radius: 10px;
            color: #fff;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="col-md-5 mx-auto">
        <div class="card shadow">
            <div class="card-body">
                <h3 class="mb-4">Form Register</h3>

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
                    <div class="mb-3 position-relative">
                        <i class="bi bi-person input-group-text"></i>
                        <input type="text" name="username" class="form-control" placeholder="Username" value="{{ old('username') }}">
                    </div>

                    <div class="mb-3 position-relative">
                        <i class="bi bi-envelope input-group-text"></i>
                        <input type="email" name="email" class="form-control" placeholder="Email" value="{{ old('email') }}">
                    </div>

                    <div class="mb-3 position-relative">
                        <i class="bi bi-lock input-group-text"></i>
                        <input type="password" name="password" class="form-control" placeholder="Password">
                    </div>

                    <button class="btn btn-success w-100 py-2">Daftar</button>

                    <div class="mt-4 text-center">
                        Sudah punya akun? <a href="{{ route('login') }}">Login</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

</body>
</html>
