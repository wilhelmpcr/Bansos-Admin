<div class="sidebar pe-4 pb-3">
    <nav class="navbar bg-light navbar-light">
        <!-- LOGO BANSOS YANG MENARIK -->
        <a href="{{ url('/') }}" class="navbar-brand mx-4 mb-3">
            <img src="{{ asset('assets-admin/img/polos.png') }}" alt="Logo BANSOS" width="180" height="100"
                style="background-color: #fffafa; border-radius: 8px; padding: 10px;">
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
