@extends('layouts.admin.app')

@section('content')
    {{-- Header dengan Logo Horizontal - Versi Mewah --}}
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
                                        <i class="fas fa-user-circle me-2 text-primary"></i>
                                        <span>Profile</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="#">
                                        <i class="fas fa-cog me-2 text-warning"></i>
                                        <span>Settings</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="#">
                                        <i class="fas fa-bell me-2 text-info"></i>
                                        <span>Notifications</span>
                                        <span class="badge bg-danger rounded-pill float-end">3</span>
                                    </a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <form action="{{ route('logout') }}" method="POST" style="display:inline">
                                        @csrf
                                        <button type="submit" style="background:none;border:none;padding:0;color:inherit">
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

    {{-- Dashboard Header dengan Search dan Quick Actions --}}
    <div class="container-fluid pt-4 px-4">
        <div class="row align-items-center mb-4">
            <div class="col-md-6">
                <h1 class="h3 mb-0 text-primary">Dashboard Bantuan Sosial</h1>
                <p class="text-muted mb-0">Selamat datang kembali! Pantau dan kelola data penerima bantuan.</p>
            </div>
            <div class="col-md-6">
                <div class="input-group">
                    <input type="text" class="form-control border-primary" placeholder="Cari penerima bantuan..."
                        id="searchInput">
                    <button class="btn btn-primary" type="button">
                        <i class="fa fa-search"></i>
                    </button>
                    <button class="btn btn-outline-primary" type="button" data-bs-toggle="modal"
                        data-bs-target="#filterModal">
                        <i class="fa fa-filter"></i> Filter
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- Stats Cards dengan tema bantuan sosial --}}
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-sm-6 col-xl-3">
                <div
                    class="bg-white rounded shadow-sm border-start border-4 border-primary d-flex align-items-center justify-content-between p-4 hover-lift">
                    <i class="fa fa-users fa-3x text-primary"></i>
                    <div class="ms-3 text-end">
                        <p class="mb-1 text-muted">Total Penerima</p>
                        <h3 class="mb-0">2,847</h3>
                        <small class="text-success"><i class="fa fa-arrow-up"></i> 12.5% dari bulan lalu</small>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div
                    class="bg-white rounded shadow-sm border-start border-4 border-success d-flex align-items-center justify-content-between p-4 hover-lift">
                    <i class="fa fa-check-circle fa-3x text-success"></i>
                    <div class="ms-3 text-end">
                        <p class="mb-1 text-muted">Diverifikasi</p>
                        <h3 class="mb-0">1,924</h3>
                        <small class="text-success"><i class="fa fa-arrow-up"></i> 8.2% dari bulan lalu</small>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div
                    class="bg-white rounded shadow-sm border-start border-4 border-warning d-flex align-items-center justify-content-between p-4 hover-lift">
                    <i class="fa fa-clock fa-3x text-warning"></i>
                    <div class="ms-3 text-end">
                        <p class="mb-1 text-muted">Menunggu</p>
                        <h3 class="mb-0">523</h3>
                        <small class="text-danger"><i class="fa fa-arrow-down"></i> 3.1% dari bulan lalu</small>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div
                    class="bg-white rounded shadow-sm border-start border-4 border-info d-flex align-items-center justify-content-between p-4 hover-lift">
                    <i class="fa fa-hand-holding-heart fa-3x text-info"></i>
                    <div class="ms-3 text-end">
                        <p class="mb-1 text-muted">Program Aktif</p>
                        <h3 class="mb-0">15</h3>
                        <small class="text-success"><i class="fa fa-arrow-up"></i> 2 program baru</small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Charts dengan tema distribusi bantuan --}}
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-sm-12 col-xl-6">
                <div class="bg-white rounded shadow-sm p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <div>
                            <h5 class="mb-1">Distribusi Bantuan Per Program</h5>
                            <p class="text-muted mb-0">Jumlah penerima per jenis bantuan</p>
                        </div>
                        <a href="#" class="btn btn-sm btn-outline-primary">Detail</a>
                    </div>
                    <canvas id="programDistribution"></canvas>
                </div>
            </div>
            <div class="col-sm-12 col-xl-6">
                <div class="bg-white rounded shadow-sm p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <div>
                            <h5 class="mb-1">Status Penerima Bulan Ini</h5>
                            <p class="text-muted mb-0">Perbandingan status penerima baru</p>
                        </div>
                        <a href="#" class="btn btn-sm btn-outline-primary">Detail</a>
                    </div>
                    <canvas id="statusChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    {{-- Tabel Data Penerima dengan fitur lengkap --}}
    <div class="container-fluid pt-4 px-4">
        <div class="bg-white rounded shadow-sm p-4">
            <div class="d-flex flex-column flex-md-row align-items-center justify-content-between mb-4">
                <div>
                    <h5 class="mb-1">Data Penerima Bantuan</h5>
                    <p class="text-muted mb-0">Kelola data penerima bantuan sosial</p>
                </div>
                <div class="d-flex gap-2 mt-2 mt-md-0">
                    <button class="btn btn-outline-primary" id="exportBtn">
                        <i class="fa fa-download"></i> Export
                    </button>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addRecipientModal">
                        <i class="fa fa-plus"></i> Tambah Penerima
                    </button>
                </div>
            </div>

            {{-- Filter Bar --}}
            <div class="row mb-4">
                <div class="col-md-12">
                    <div class="d-flex flex-wrap gap-2">
                        <select class="form-select form-select-sm" style="width: auto;" id="statusFilter">
                            <option value="">Semua Status</option>
                            <option value="pending">Pending</option>
                            <option value="diterima">Diterima</option>
                            <option value="ditolak">Ditolak</option>
                        </select>
                        <select class="form-select form-select-sm" style="width: auto;" id="programFilter">
                            <option value="">Semua Program</option>
                            <option value="tunai">Bantuan Sosial Tunai</option>
                            <option value="pendidikan">Bantuan Pendidikan</option>
                            <option value="umkm">Bantuan UMKM</option>
                            <option value="kesehatan">Bantuan Kesehatan</option>
                        </select>
                        <button class="btn btn-sm btn-outline-secondary" id="resetFilter">
                            <i class="fa fa-refresh"></i> Reset
                        </button>
                    </div>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle" id="recipientsTable">
                    <thead class="table-light">
                        <tr>
                            <th width="50" class="text-center">
                                <input class="form-check-input" type="checkbox" id="selectAll">
                            </th>
                            <th>Nama Penerima</th>
                            <th>Program Bantuan</th>
                            <th>Tanggal Daftar</th>
                            <th>Status</th>
                            <th>Action</th>
                            <th>Verifikasi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ([['id' => 1, 'name' => 'Wilhelm S Tamba', 'email' => 'wilhelm@example.com', 'program' => 'Bantuan Sosial Tunai', 'date' => '14 Nov 2025', 'status' => 'pending', 'avatar' => 'user.jpg'], ['id' => 2, 'name' => 'Sarah Johnson', 'email' => 'sarah@example.com', 'program' => 'Bantuan Pendidikan', 'date' => '13 Nov 2025', 'status' => 'diterima', 'avatar' => 'user.jpg'], ['id' => 3, 'name' => 'Michael Brown', 'email' => 'michael@example.com', 'program' => 'Bantuan UMKM', 'date' => '12 Nov 2025', 'status' => 'ditolak', 'avatar' => 'user.jpg'], ['id' => 4, 'name' => 'Lisa Anderson', 'email' => 'lisa@example.com', 'program' => 'Bantuan Sosial Tunai', 'date' => '11 Nov 2025', 'status' => 'pending', 'avatar' => 'user.jpg'], ['id' => 5, 'name' => 'David Wilson', 'email' => 'david@example.com', 'program' => 'Bantuan Kesehatan', 'date' => '10 Nov 2025', 'status' => 'diterima', 'avatar' => 'user.jpg']] as $recipient)
                            <tr data-status="{{ $recipient['status'] }}"
                                data-program="{{ strtolower(str_replace(' ', '', $recipient['program'])) }}">
                                <td class="text-center">
                                    <input class="form-check-input row-select" type="checkbox"
                                        value="{{ $recipient['id'] }}">
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-circle">
                                            <img src="{{ asset('assets-admin/img/' . $recipient['avatar']) }}"
                                                alt="{{ $recipient['name'] }}">
                                        </div>
                                        <div class="ms-3">
                                            <h6 class="mb-0">{{ $recipient['name'] }}</h6>
                                            <small class="text-muted">{{ $recipient['email'] }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span
                                        class="badge program-badge {{ strtolower(str_replace(' ', '-', $recipient['program'])) }}">
                                        {{ $recipient['program'] }}
                                    </span>
                                </td>
                                <td>{{ $recipient['date'] }}</td>
                                <td>
                                    @if ($recipient['status'] == 'pending')
                                        <span class="badge bg-warning text-dark"><i class="fa fa-clock"></i>
                                            Pending</span>
                                    @elseif($recipient['status'] == 'diterima')
                                        <span class="badge bg-success"><i class="fa fa-check"></i> Diterima</span>
                                    @else
                                        <span class="badge bg-danger"><i class="fa fa-times"></i> Ditolak</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <button class="btn btn-outline-primary view-btn"
                                            data-id="{{ $recipient['id'] }}">
                                            <i class="fa fa-eye"></i>
                                        </button>
                                        <button class="btn btn-outline-warning edit-btn"
                                            data-id="{{ $recipient['id'] }}">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        <button class="btn btn-outline-danger delete-btn"
                                            data-id="{{ $recipient['id'] }}" data-name="{{ $recipient['name'] }}">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                                <td>
                                    @if ($recipient['status'] == 'pending')
                                        <button class="btn btn-sm btn-success btn-penerima"
                                            data-id="{{ $recipient['id'] }}" data-name="{{ $recipient['name'] }}">
                                            <i class="fa fa-check"></i> Terima
                                        </button>
                                    @elseif($recipient['status'] == 'diterima')
                                        <button class="btn btn-sm btn-outline-success" disabled>
                                            <i class="fa fa-check-circle"></i> Diterima
                                        </button>
                                    @else
                                        <button class="btn btn-sm btn-outline-danger" disabled>
                                            <i class="fa fa-times-circle"></i> Ditolak
                                        </button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="d-flex justify-content-between align-items-center mt-4">
                <div>
                    <select class="form-select form-select-sm" style="width: auto;" id="perPage">
                        <option value="5">5 per halaman</option>
                        <option value="10" selected>10 per halaman</option>
                        <option value="25">25 per halaman</option>
                    </select>
                </div>
                <nav>
                    <ul class="pagination pagination-sm mb-0">
                        <li class="page-item disabled"><a class="page-link" href="#">Sebelumnya</a></li>
                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#">Selanjutnya</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>

    {{-- Widgets Section --}}
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            {{-- Pesan Terbaru --}}
            <div class="col-sm-12 col-md-6 col-xl-4">
                <div class="bg-white rounded shadow-sm p-4 h-100">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h6 class="mb-0">Pesan Terbaru</h6>
                        <a href="#" class="btn btn-sm btn-outline-primary">Lihat Semua</a>
                    </div>
                    <div class="message-list">
                        @foreach ([['name' => 'Budi Santoso', 'time' => '15 menit lalu', 'message' => 'Mohon informasi status pengajuan bantuan pendidikan', 'avatar' => 'user.jpg'], ['name' => 'Siti Aminah', 'time' => '1 jam lalu', 'message' => 'Dokumen sudah saya kirim via email', 'avatar' => 'user.jpg'], ['name' => 'Ahmad Rizki', 'time' => '2 jam lalu', 'message' => 'Kapan jadwal verifikasi lapangan?', 'avatar' => 'user.jpg'], ['name' => 'Dewi Lestari', 'time' => '3 jam lalu', 'message' => 'Terima kasih bantuannya sudah cair', 'avatar' => 'user.jpg']] as $message)
                            <div class="message-item d-flex align-items-start py-3 border-bottom">
                                <div class="avatar-circle-sm">
                                    <img src="{{ asset('assets-admin/img/' . $message['avatar']) }}"
                                        alt="{{ $message['name'] }}">
                                </div>
                                <div class="ms-3 flex-grow-1">
                                    <div class="d-flex justify-content-between">
                                        <h6 class="mb-0">{{ $message['name'] }}</h6>
                                        <small class="text-muted">{{ $message['time'] }}</small>
                                    </div>
                                    <p class="mb-0 text-muted small">{{ $message['message'] }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- Kalender --}}
            <div class="col-sm-12 col-md-6 col-xl-4">
                <div class="bg-white rounded shadow-sm p-4 h-100">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h6 class="mb-0">Kalender Kegiatan</h6>
                        <a href="#" class="btn btn-sm btn-outline-primary">Lihat Semua</a>
                    </div>
                    <div id="calendarWidget" class="calendar-widget">
                        <div class="calendar-header d-flex justify-content-between align-items-center mb-3">
                            <button class="btn btn-sm btn-outline-secondary"><i class="fa fa-chevron-left"></i></button>
                            <h6 class="mb-0">Desember 2025</h6>
                            <button class="btn btn-sm btn-outline-secondary"><i class="fa fa-chevron-right"></i></button>
                        </div>
                        <div class="calendar-body">
                            <div class="calendar-grid">
                                @foreach (['Min', 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab'] as $day)
                                    <div class="calendar-day-header">{{ $day }}</div>
                                @endforeach
                                @for ($i = 1; $i <= 31; $i++)
                                    <div
                                        class="calendar-day {{ $i == 15 ? 'today' : '' }} {{ $i >= 1 && $i <= 5 ? 'has-event' : '' }}">
                                        {{ $i }}
                                        @if ($i == 15)
                                            <div class="event-dot bg-primary"></div>
                                        @endif
                                    </div>
                                @endfor
                            </div>
                        </div>
                        <div class="calendar-events mt-3">
                            <div class="event-item d-flex align-items-center mb-2">
                                <div class="event-dot bg-primary me-2"></div>
                                <div class="flex-grow-1">
                                    <small class="d-block">15 Des - Verifikasi Lapangan</small>
                                    <small class="text-muted">10:00 WIB - 5 penerima</small>
                                </div>
                            </div>
                            <div class="event-item d-flex align-items-center">
                                <div class="event-dot bg-success me-2"></div>
                                <div class="flex-grow-1">
                                    <small class="d-block">20 Des - Distribusi Bantuan</small>
                                    <small class="text-muted">08:00 WIB - 50 penerima</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- To Do List --}}
            <div class="col-sm-12 col-md-6 col-xl-4">
                <div class="bg-white rounded shadow-sm p-4 h-100">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h6 class="mb-0">To Do List</h6>
                        <a href="#" class="btn btn-sm btn-outline-primary">Lihat Semua</a>
                    </div>
                    <div class="todo-form d-flex mb-3">
                        <input type="text" class="form-control" placeholder="Tambah tugas baru..." id="newTask">
                        <button class="btn btn-primary ms-2" id="addTask">
                            <i class="fa fa-plus"></i>
                        </button>
                    </div>
                    <div class="todo-list">
                        @foreach ([['task' => 'Verifikasi data penerima baru', 'completed' => false], ['task' => 'Update status bantuan bulan ini', 'completed' => false], ['task' => 'Buat laporan distribusi bantuan', 'completed' => true], ['task' => 'Review pengajuan bantuan baru', 'completed' => false], ['task' => 'Koordinasi dengan tim lapangan', 'completed' => false]] as $todo)
                            <div class="todo-item d-flex align-items-center py-2 border-bottom">
                                <input type="checkbox" class="form-check-input me-3"
                                    {{ $todo['completed'] ? 'checked' : '' }}>
                                <div class="flex-grow-1">
                                    <span
                                        class="{{ $todo['completed'] ? 'text-muted text-decoration-line-through' : '' }}">
                                        {{ $todo['task'] }}
                                    </span>
                                </div>
                                <button class="btn btn-sm btn-link text-danger delete-task">
                                    <i class="fa fa-times"></i>
                                </button>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Modals --}}

    {{-- Modal Konfirmasi Penerima --}}
    <div class="modal fade" id="modalPenerima" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Konfirmasi Penerimaan</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menerima <strong id="namaPenerima"></strong> sebagai penerima bantuan?</p>
                    <div class="mb-3">
                        <label class="form-label">Catatan (Opsional)</label>
                        <textarea class="form-control" id="catatanPenerima" rows="3"
                            placeholder="Tambahkan catatan jika diperlukan..."></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-success" id="confirmPenerima">Ya, Terima</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Tambah Penerima --}}
    <div class="modal fade" id="addRecipientModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Tambah Penerima Bantuan</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="addRecipientForm">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Nama Lengkap</label>
                                <input type="text" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Program Bantuan</label>
                                <select class="form-select" required>
                                    <option value="">Pilih Program</option>
                                    <option value="tunai">Bantuan Sosial Tunai</option>
                                    <option value="pendidikan">Bantuan Pendidikan</option>
                                    <option value="umkm">Bantuan UMKM</option>
                                    <option value="kesehatan">Bantuan Kesehatan</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Tanggal Daftar</label>
                                <input type="date" class="form-control" required>
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label">Alamat Lengkap</label>
                                <textarea class="form-control" rows="2"></textarea>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary" id="saveRecipient">Simpan</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Hapus --}}
    <div class="modal fade" id="deleteModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title">Konfirmasi Hapus</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menghapus data <strong id="deleteName"></strong>?</p>
                    <p class="text-danger small">Data yang sudah dihapus tidak dapat dikembalikan.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-danger" id="confirmDelete">Ya, Hapus</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Detail --}}
    <div class="modal fade" id="detailModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-info text-white">
                    <h5 class="modal-title">Detail Penerima</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div id="detailContent">
                        <!-- Detail akan dimuat via JavaScript -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Charts
            const programCtx = document.getElementById('programDistribution').getContext('2d');
            const programChart = new Chart(programCtx, {
                type: 'doughnut',
                data: {
                    labels: ['Sosial Tunai', 'Pendidikan', 'UMKM', 'Kesehatan', 'Lainnya'],
                    datasets: [{
                        data: [35, 25, 20, 15, 5],
                        backgroundColor: [
                            '#3b82f6',
                            '#10b981',
                            '#f59e0b',
                            '#8b5cf6',
                            '#6b7280'
                        ],
                        borderWidth: 2,
                        borderColor: '#fff'
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'bottom'
                        }
                    }
                }
            });

            const statusCtx = document.getElementById('statusChart').getContext('2d');
            const statusChart = new Chart(statusCtx, {
                type: 'bar',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun'],
                    datasets: [{
                        label: 'Diterima',
                        data: [65, 59, 80, 81, 56, 55],
                        backgroundColor: '#10b981'
                    }, {
                        label: 'Pending',
                        data: [28, 48, 40, 19, 86, 27],
                        backgroundColor: '#f59e0b'
                    }, {
                        label: 'Ditolak',
                        data: [18, 24, 12, 8, 12, 18],
                        backgroundColor: '#ef4444'
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        x: {
                            grid: {
                                display: false
                            }
                        },
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 20
                            }
                        }
                    }
                }
            });

            // Search Functionality
            const searchInput = document.getElementById('searchInput');
            searchInput.addEventListener('keyup', function() {
                const searchTerm = this.value.toLowerCase();
                const rows = document.querySelectorAll('#recipientsTable tbody tr');

                rows.forEach(row => {
                    const text = row.textContent.toLowerCase();
                    row.style.display = text.includes(searchTerm) ? '' : 'none';
                });
            });

            // Filter Functionality
            const statusFilter = document.getElementById('statusFilter');
            const programFilter = document.getElementById('programFilter');
            const resetFilter = document.getElementById('resetFilter');

            function applyFilters() {
                const status = statusFilter.value;
                const program = programFilter.value;
                const rows = document.querySelectorAll('#recipientsTable tbody tr');

                rows.forEach(row => {
                    const rowStatus = row.getAttribute('data-status');
                    const rowProgram = row.getAttribute('data-program');

                    const statusMatch = !status || rowStatus === status;
                    const programMatch = !program || rowProgram.includes(program);

                    row.style.display = statusMatch && programMatch ? '' : 'none';
                });
            }

            statusFilter.addEventListener('change', applyFilters);
            programFilter.addEventListener('change', applyFilters);
            resetFilter.addEventListener('click', function() {
                statusFilter.value = '';
                programFilter.value = '';
                applyFilters();
            });

            // Row Selection
            const selectAll = document.getElementById('selectAll');
            const rowSelects = document.querySelectorAll('.row-select');

            selectAll.addEventListener('change', function() {
                const isChecked = this.checked;
                rowSelects.forEach(checkbox => {
                    checkbox.checked = isChecked;
                });
            });

            // Export Button
            document.getElementById('exportBtn').addEventListener('click', function() {
                const selected = [];
                document.querySelectorAll('.row-select:checked').forEach(checkbox => {
                    selected.push(checkbox.value);
                });

                if (selected.length === 0) {
                    alert('Pilih data yang akan diexport terlebih dahulu!');
                    return;
                }

                // Simulasi export
                alert(`Mengexport ${selected.length} data penerima...`);
                console.log('Exporting data:', selected);
            });

            // Penerima Button Modal
            let selectedId = null;
            let selectedName = null;

            document.querySelectorAll('.btn-penerima').forEach(button => {
                button.addEventListener('click', function() {
                    selectedId = this.getAttribute('data-id');
                    selectedName = this.getAttribute('data-name');
                    document.getElementById('namaPenerima').textContent = selectedName;
                    document.getElementById('catatanPenerima').value = '';
                });
            });

            document.getElementById('confirmPenerima').addEventListener('click', function() {
                    const catatan = document.getElementById('catatanPenerima').value;

                    // AJAX simulation
                    console.log('Menerima ID:', selectedId);
                    console.log('Nama:', selectedName);
                    console.log('Catatan:', catatan);

                    // Update UI
                    const button = document.querySelector(`.btn-penerima[data-id="${selectedId}"] `);
            if (button) {
                button.disabled = true;
                button.innerHTML = '<i class="fa fa-check-circle"></i> Diterima';
                button.classList.remove('btn-success');
                button.classList.add('btn-outline-success');

                const row = button.closest('tr');
                const statusCell = row.querySelector('td:nth-child(5)');
                if (statusCell) {
                    statusCell.innerHTML = '<span class="badge bg-success"><i class="fa fa-check"></i> Diterima</span>';
                }
            }

            // Show success toast
            showToast('success', `
                Berhasil menerima $ {
                    selectedName
                }
                sebagai penerima bantuan!`);

            // Hide modal
            const modal = bootstrap.Modal.getInstance(document.getElementById('modalPenerima'));
            modal.hide();
        });

        // Delete Functionality
        let deleteId = null;
        let deleteName = null;

        document.querySelectorAll('.delete-btn').forEach(button => {
            button.addEventListener('click', function() {
                deleteId = this.getAttribute('data-id');
                deleteName = this.getAttribute('data-name');
                document.getElementById('deleteName').textContent = deleteName;
            });
        });

        document.getElementById('confirmDelete').addEventListener('click', function() {
            // AJAX simulation
            console.log('Deleting ID:', deleteId);

            // Remove row from table
            const row = document.querySelector(`.delete-btn[data-id="${deleteId}"]`).closest('tr');
            row.style.transition = 'all 0.3s';
            row.style.opacity = '0';
            row.style.transform = 'translateX(100px)';

            setTimeout(() => {
                row.remove();
                showToast('success', `Data ${deleteName} berhasil dihapus!`);
            }, 300);

            const modal = bootstrap.Modal.getInstance(document.getElementById('deleteModal'));
            modal.hide();
        });

        // View Detail
        document.querySelectorAll('.view-btn').forEach(button => {
                    button.addEventListener('click', function() {
                                const id = this.getAttribute('data-id');
                                const modal = new bootstrap.Modal(document.getElementById('detailModal'));

                                // Load detail content
                                document.getElementById('detailContent').innerHTML = `
                    <div class="text-center py-4">
                        <div class="spinner
