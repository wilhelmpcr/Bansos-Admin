<div class="sidebar pe-4 pb-3">
    <nav class="navbar bg-light navbar-light">
        <a href="{{ url('/') }}" class="navbar-brand mx-4 mb-3">
            <img src="{{ asset('assets-admin/img/polos.png') }}" alt="Logo BANSOS" width="180" height="100"
                style="background-color: #fffafa; border-radius: 8px; padding: 10px;">
        </a>

        <div class="d-flex align-items-center ms-4 mb-4">
            <div class="position-relative">
                <img class="rounded-circle" src="{{ asset('assets-admin/img/user.jpg') }}" alt=""
                    style="width: 40px; height: 40px;">
                <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
            </div>
            <div class="ms-3">
                <h6 class="mb-0">{{ Auth::user()->name ?? 'Guest' }}</h6>
                <span>{{ Auth::user()->role ?? 'Unauthenticated' }}</span>
            </div>
        </div>

        <div class="navbar-nav w-100">
            {{-- MENU HANYA UNTUK USER LOGIN --}}
            @auth
                <a href="{{ url('/dashboard') }}" class="nav-item nav-link">
                    <i class="fa fa-tachometer-alt me-2"></i> Dashboard
                </a>

                <a href="{{ url('/warga') }}" class="nav-item nav-link">
                    <i class="fa fa-user"></i> Warga
                </a>

                <a href="{{ url('/kelahiran') }}" class="nav-item nav-link">
                    <i class="fa fa-baby me-2"></i> Kelahiran
                </a>

                <a href="{{ url('/user') }}" class="nav-item nav-link">
                    <i class="fa fa-user"></i> User
                </a>

                <a href="{{ url('/program_bantuan') }}" class="nav-item nav-link">
                    <i class="fa fa-gift"></i> Bantuan
                </a>

                <a href="{{ url('/pendaftar_bantuan') }}" class="nav-item nav-link">
                    <i class="fa fa-gift"></i> Pendaftar
                </a>

                <hr class="dropdown-divider">

                {{-- LOGOUT FORM (BENAR & TIDAK 419) --}}
                <form action="{{ route('logout') }}" method="POST" class="nav-item nav-link p-0 m-0">
                    @csrf
                    <button type="submit" class="btn w-100 text-start">
                        <i class="fa fa-sign-out-alt me-2"></i> Logout
                    </button>
                </form>
            @endauth



            {{-- MENU UNTUK TAMU (BELUM LOGIN) --}}
            @guest
                <a href="{{ route('login.form') }}" class="nav-item nav-link">
                    <i class="fa fa-sign-in-alt me-2"></i> Login
                </a>

                <a href="{{ route('register.form') }}" class="nav-item nav-link">
                    <i class="fa fa-user-plus me-2"></i> Register
                </a>
            @endguest
        </div>
    </nav>
</div>
