@extends('layouts.admin.app')

@section('content')
    {{-- Header dengan Logo Horizontal --}}
    <div class="container-fluid bg-gradient-primary text-white">
        <div class="row align-items-center">
            <div class="col-12">
                <div class="d-flex align-items-center justify-content-between px-4 py-3">
                    {{-- Logo --}}
                    <div class="d-flex align-items-center">
                        <div class="logo-premium me-3">
                            <div class="logo-icon-premium">
                                <i class="fas fa-hands-helping"></i>
                            </div>
                        </div>
                        <div class="logo-text">
                            <h3 class="mb-0 fw-bold">Sosial<span class="text-warning">Care</span></h3>
                            <small class="opacity-75">Sistem Manajemen Bantuan Sosial</small>
                        </div>
                    </div>

                    {{-- User Menu --}}
                    <div class="d-flex align-items-center gap-4">
                        <div class="d-none d-md-block text-end">
                            <div class="user-info">
                                <p class="mb-0 fw-semibold">Administrator</p>
                                <p class="mb-0 small opacity-75">Dashboard Bantuan Sosial</p>
                            </div>
                        </div>

                        <div class="dropdown user-dropdown">
                            <a href="#"
                                class="d-flex align-items-center text-white text-decoration-none dropdown-toggle"
                                id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="user-avatar position-relative">
                                    <div class="avatar-circle-premium">
                                        <i class="fas fa-user"></i>
                                    </div>
                                    <span class="status-indicator bg-success"></span>
                                </div>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end shadow-lg border-0" aria-labelledby="userDropdown">
                                <li>
                                    <a class="dropdown-item" href="#">
                                        <i class="fas fa-user-circle me-2 text-primary"></i> Profile
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="#">
                                        <i class="fas fa-cog me-2 text-warning"></i> Settings
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="#">
                                        <i class="fas fa-bell me-2 text-info"></i> Notifications
                                        <span class="badge bg-danger rounded-pill float-end">3</span>
                                    </a>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form action="{{ route('logout') }}" method="POST" style="display:inline">
                                        @csrf
                                        <button type="submit" class="btn btn-link p-0 m-0 text-decoration-none text-dark">
                                            Logout
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    {{-- Konten Dashboard --}}
    <div class="container-fluid pt-4 px-4">
        {{-- Tambahkan seluruh konten dashboard di sini --}}
        {{-- Stats Cards, Charts, Tabel, Widgets, Modals --}}
        {{-- Pastikan semua modal memiliki id unik dan tidak bertabrakan --}}
    </div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Inisialisasi Chart
    const programCtx = document.getElementById('programDistribution')?.getContext('2d');
    if (programCtx) {
        new Chart(programCtx, {
            type: 'doughnut',
            data: {
                labels: ['Sosial Tunai', 'Pendidikan', 'UMKM', 'Kesehatan', 'Lainnya'],
                datasets: [{
                    data: [35, 25, 20, 15, 5],
                    backgroundColor: ['#3b82f6','#10b981','#f59e0b','#8b5cf6','#6b7280'],
                    borderWidth: 2,
                    borderColor: '#fff'
                }]
            },
            options: { responsive: true, plugins: { legend: { position: 'bottom' } } }
        });
    }

    const statusCtx = document.getElementById('statusChart')?.getContext('2d');
    if (statusCtx) {
        new Chart(statusCtx, {
            type: 'bar',
            data: {
                labels: ['Jan','Feb','Mar','Apr','Mei','Jun'],
                datasets: [
                    {label:'Diterima',data:[65,59,80,81,56,55],backgroundColor:'#10b981'},
                    {label:'Pending',data:[28,48,40,19,86,27],backgroundColor:'#f59e0b'},
                    {label:'Ditolak',data:[18,24,12,8,12,18],backgroundColor:'#ef4444'}
                ]
            },
            options: { responsive:true, scales:{ x:{grid:{display:false}}, y:{beginAtZero:true,ticks:{stepSize:20}}} }
        });
    }

    // Fungsi Search & Filter
    const searchInput = document.getElementById('searchInput');
    const statusFilter = document.getElementById('statusFilter');
    const programFilter = document.getElementById('programFilter');
    const resetFilter = document.getElementById('resetFilter');

    function applyFilters() {
        const rows = document.querySelectorAll('#recipientsTable tbody tr');
        rows.forEach(row => {
            const status = row.getAttribute('data-status');
            const program = row.getAttribute('data-program');
            const statusMatch = !statusFilter.value || statusFilter.value === status;
            const programMatch = !programFilter.value || program.includes(programFilter.value);
            row.style.display = (statusMatch && programMatch) ? '' : 'none';
        });
    }

    searchInput?.addEventListener('keyup', () => {
        const term = searchInput.value.toLowerCase();
        document.querySelectorAll('#recipientsTable tbody tr').forEach(row => {
            row.style.display = row.textContent.toLowerCase().includes(term) ? '' : 'none';
        });
    });

    statusFilter?.addEventListener('change', applyFilters);
    programFilter?.addEventListener('change', applyFilters);
    resetFilter?.addEventListener('click', () => {
        statusFilter.value = '';
        programFilter.value = '';
        applyFilters();
    });

    // Tambahan: fungsi export, modal, delete, dll bisa dipisahkan ke file JS sendiri agar rapi
});
</script>
@endpush
