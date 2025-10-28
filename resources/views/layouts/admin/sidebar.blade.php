<div class="sidebar pe-4 pb-3">
    <nav class="navbar bg-light navbar-light">
        <!-- LOGO BANSOS YANG MENARIK -->
        <a href="{{ url('/') }}" class="navbar-brand mx-4 mb-3">
            <svg width="180" height="100" viewBox="0 0 200 100" xmlns="http://www.w3.org/2000/svg" style="fill: #fff; background-color: #3a7d44; border-radius: 8px; padding: 10px;">
                <!-- Gambar 3 siluet orang -->
                <path d="M80,40 C90,30 110,30 120,40 C125,45 125,60 120,65 C110,70 90,70 80,65 C75,60 75,45 80,40 Z" stroke="#000" stroke-width="2" fill="#fff"/>
                <path d="M60,45 C70,35 90,35 100,45 C105,50 105,65 100,70 C90,75 70,75 60,70 C55,65 55,50 60,45 Z" stroke="#000" stroke-width="2" fill="#fff"/>
                <path d="M100,45 C110,35 130,35 140,45 C145,50 145,65 140,70 C130,75 110,75 100,70 C95,65 95,50 100,45 Z" stroke="#000" stroke-width="2" fill="#fff"/>
                <!-- Teks BANSOS -->
                <text x="100" y="90" font-family="Arial, sans-serif" font-size="24" font-weight="bold" text-anchor="middle" fill="#fff">BANSOS</text>
            </svg>
        </a>

        <div class="d-flex align-items-center ms-4 mb-4">
            <div class="position-relative">
                <img class="rounded-circle" src="{{ asset('assets-admin/img/user.jpg') }}" alt=""
                    style="width: 40px; height: 40px;">
                <div
                    class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1">
                </div>
            </div>
            <div class="ms-3">
                <h6 class="mb-0">Wilhelm S Tamba</h6>
                <span>Admin</span>
            </div>
        </div>

        <div class="navbar-nav w-100">
            <a href="{{ url('/dashboard') }}" class="nav-item nav-link active"><i
                    class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
            <a href="{{ url('/warga') }}" class="nav-item nav-link active">
                <i class="fa fa-user"></i> Warga
            </a>
            <a href="{{ url('/user') }}" class="nav-item nav-link active">
                <i class="fa fa-user"></i> User
            </a>
            <a href="{{ url('/program_bantuan') }}" class="nav-item nav-link active">
                <i class="fa fa-gift"></i>Bantuan
            </a>

            <hr class="dropdown-divider">
            <a href="{{ route('login.form') }}" class="nav-item nav-link active">
                <i class="fa fa-sign-in-alt me-2"></i> Login
            </a>
            <a href="{{ route('register.form') }}" class="nav-item nav-link active">
                <i class="fa fa-user-plus me-2"></i> Register
            </a>
        </div>
    </nav>
</div>
