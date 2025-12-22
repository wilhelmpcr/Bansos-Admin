<div class="sidebar pe-4 pb-3">
    <nav class="navbar bg-light navbar-light">
        <a href="{{ url('/') }}" class="navbar-brand mx-4 mb-3">
            <img src="{{ asset('assets-admin/img/polos.png') }}"
                 alt="Logo BANSOS"
                 width="180"
                 height="100"
                 style="background-color:#fffafa;border-radius:8px;padding:10px;">
        </a>

        <div class="d-flex align-items-center ms-4 mb-4">
            <div class="position-relative">
                <img class="rounded-circle"
                     src="{{ asset('assets-admin/img/user.jpg') }}"
                     alt=""
                     style="width:40px;height:40px;">
                <div class="bg-success rounded-circle border border-2 border-white
                            position-absolute end-0 bottom-0 p-1"></div>
            </div>
            <div class="ms-3">
                <h6 class="mb-0">{{ Auth::user()->name ?? 'Guest' }}</h6>
                <span>{{ Auth::user()->role ?? 'Unauthenticated' }}</span>
            </div>
        </div>

        <div class="navbar-nav w-100">

            {{-- MENU UNTUK USER LOGIN --}}
            @auth
                <a href="{{ route('dashboard') }}" class="nav-item nav-link">
                    <i class="fa fa-tachometer-alt me-2"></i> Dashboard
                </a>

                <a href="{{ route('warga.index') }}" class="nav-item nav-link">
                    <i class="fa fa-users me-2"></i> Warga
                </a>

                <a href="{{ route('program_bantuan.index') }}" class="nav-item nav-link">
                    <i class="fa fa-gift me-2"></i> Program Bantuan
                </a>

                {{-- ✅ FIXED ROUTE --}}
                <a href="{{ route('penerima_bantuan.index') }}" class="nav-item nav-link">
                    <i class="fa fa-hand-holding-heart me-2"></i> Penerima Bantuan
                </a>

                <a href="{{ route('pendaftar_bantuan.index') }}" class="nav-item nav-link">
                    <i class="fa fa-file-signature me-2"></i> Pendaftar Bantuan
                </a>

                <a href="{{ route('verifikasi_lapangan.index') }}" class="nav-item nav-link">
                    <i class="fa fa-clipboard-check me-2"></i> Verifikasi Lapangan
                </a>

                <a href="{{ route('riwayat_penyaluran.index') }}" class="nav-item nav-link">
                    <i class="fa fa-history me-2"></i> Riwayat Penyaluran
                </a>

                <a href="{{ route('user.index') }}" class="nav-item nav-link">
                    <i class="fa fa-user-cog me-2"></i> User
                </a>

                <hr class="dropdown-divider">

                <form action="{{ route('logout') }}" method="POST" class="px-3">
                    @csrf
                    <button type="submit" class="btn btn-link nav-link p-0">
                        <i class="fa fa-sign-out-alt me-2"></i> Logout
                    </button>
                </form>
            @endauth

            {{-- MENU UNTUK TAMU --}}
            @guest
                <a href="{{ route('login') }}" class="nav-item nav-link">
                    <i class="fa fa-sign-in-alt me-2"></i> Login
                </a>

                <a href="{{ route('register') }}" class="nav-item nav-link">
                    <i class="fa fa-user-plus me-2"></i> Register
                </a>
            @endguest

        </div>
    </nav>
</div>
