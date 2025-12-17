@extends('layouts.admin.app')

@section('title', 'Detail Verifikasi Lapangan')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-clipboard-check me-2"></i>Detail Verifikasi Lapangan
                    </h6>
                    <div class="btn-group">
                        <a href="{{ route('verifikasi_lapangan.edit', $verifikasiLapangan->verifikasi_id) }}"
                           class="btn btn-warning btn-sm">
                            <i class="fas fa-edit me-1"></i>Edit
                        </a>
                        <a href="{{ route('verifikasi_lapangan.index') }}" class="btn btn-secondary btn-sm">
                            <i class="fas fa-list me-1"></i>Daftar
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    <!-- Header Info -->
                    <div class="row mb-4">
                        <div class="col-md-8">
                            <div class="d-flex align-items-center">
                                <div class="avatar-circle-lg me-3">
                                    <img src="{{ asset('assets-admin/img/user.jpg') }}"
                                         alt="{{ $verifikasiLapangan->pendaftar->nama_lengkap }}">
                                </div>
                                <div>
                                    <h4 class="mb-1">{{ $verifikasiLapangan->pendaftar->nama_lengkap }}</h4>
                                    <p class="text-muted mb-2">
                                        NIK: {{ $verifikasiLapangan->pendaftar->nik }} |
                                        Program: {{ $verifikasiLapangan->pendaftar->program_bantuan ?? '-' }}
                                    </p>
                                    <span class="badge bg-{{ $verifikasiLapangan->status_label['color'] }} fs-6">
                                        <i class="fas {{ $verifikasiLapangan->status_label['icon'] }} me-1"></i>
                                        {{ $verifikasiLapangan->status_label['label'] }}
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 text-md-end">
                            <div class="card bg-light">
                                <div class="card-body p-3">
                                    <h2 class="text-primary mb-0">
                                        {{ $verifikasiLapangan->skor ?? '0' }}
                                        <small class="fs-6 text-muted">/100</small>
                                    </h2>
                                    <p class="text-muted mb-0">Total Skor</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Detail Information -->
                    <div class="row">
                        <!-- Data Verifikasi -->
                        <div class="col-md-6 mb-4">
                            <div class="card">
                                <div class="card-header bg-light">
                                    <h6 class="mb-0"><i class="fas fa-info-circle me-2"></i>Informasi Verifikasi</h6>
                                </div>
                                <div class="card-body">
                                    <table class="table table-borderless">
                                        <tr>
                                            <th width="40%">Petugas</th>
                                            <td>: {{ $verifikasiLapangan->petugas }}</td>
                                        </tr>
                                        <tr>
                                            <th>Tanggal Verifikasi</th>
                                            <td>: {{ $verifikasiLapangan->formatted_tanggal }}</td>
                                        </tr>
                                        <tr>
                                            <th>Waktu Input</th>
                                            <td>: {{ $verifikasiLapangan->created_at->translatedFormat('d F Y H:i') }}</td>
                                        </tr>
                                        <tr>
                                            <th>Terakhir Diperbarui</th>
                                            <td>: {{ $verifikasiLapangan->updated_at->translatedFormat('d F Y H:i') }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- Data Pendaftar -->
                        <div class="col-md-6 mb-4">
                            <div class="card">
                                <div class="card-header bg-light">
                                    <h6 class="mb-0"><i class="fas fa-user me-2"></i>Data Pendaftar</h6>
                                </div>
                                <div class="card-body">
                                    <table class="table table-borderless">
                                        <tr>
                                            <th width="40%">Nama Lengkap</th>
                                            <td>: {{ $verifikasiLapangan->pendaftar->nama_lengkap }}</td>
                                        </tr>
                                        <tr>
                                            <th>Alamat</th>
                                            <td>: {{ $verifikasiLapangan->pendaftar->alamat ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <th>No. HP</th>
                                            <td>: {{ $verifikasiLapangan->pendaftar->no_hp ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Email</th>
                                            <td>: {{ $verifikasiLapangan->pendaftar->email ?? '-' }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- Catatan -->
                        <div class="col-12 mb-4">
                            <div class="card">
                                <div class="card-header bg-light d-flex justify-content-between align-items-center">
                                    <h6 class="mb-0"><i class="fas fa-sticky-note me-2"></i>Catatan Verifikasi</h6>
                                </div>
                                <div class="card-body">
                                    @if($verifikasiLapangan->catatan)
                                    <div class="p-3 bg-light rounded">
                                        {{ $verifikasiLapangan->catatan }}
                                    </div>
                                    @else
                                    <div class="text-center text-muted py-4">
                                        <i class="fas fa-sticky-note fa-2x mb-3"></i>
                                        <p>Tidak ada catatan verifikasi</p>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Foto Verifikasi -->
                        @if($verifikasiLapangan->foto_verifikasi && count($verifikasiLapangan->foto_verifikasi) > 0)
                        <div class="col-12 mb-4">
                            <div class="card">
                                <div class="card-header bg-light">
                                    <h6 class="mb-0"><i class="fas fa-camera me-2"></i>Foto Verifikasi Lapangan</h6>
                                </div>
                                <div class="card-body">
                                    <div class="row g-3">
                                        @foreach($verifikasiLapangan->foto_verifikasi as $foto)
                                        <div class="col-md-3">
                                            <div class="card">
                                                <a href="{{ Storage::url($foto) }}" data-lightbox="verifikasi-foto">
                                                    <img src="{{ Storage::url($foto) }}"
                                                         class="card-img-top"
                                                         alt="Foto Verifikasi"
                                                         style="height: 180px; object-fit: cover;">
                                                </a>
                                                <div class="card-footer p-2 text-center">
                                                    <small class="text-muted">Foto {{ $loop->iteration }}</small>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif

                        <!-- Progress Bar Skor -->
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header bg-light">
                                    <h6 class="mb-0"><i class="fas fa-chart-line me-2"></i>Visualisasi Skor</h6>
                                </div>
                                <div class="card-body">
                                    <div class="progress" style="height: 30px;">
                                        <div class="progress-bar bg-{{ $verifikasiLapangan->status_label['color'] }}"
                                             role="progressbar"
                                             style="width: {{ $verifikasiLapangan->skor ?? 0 }}%;"
                                             aria-valuenow="{{ $verifikasiLapangan->skor ?? 0 }}"
                                             aria-valuemin="0"
                                             aria-valuemax="100">
                                            <span class="fw-bold">{{ $verifikasiLapangan->skor ?? 0 }}%</span>
                                        </div>
                                    </div>
                                    <div class="row mt-3 text-center">
                                        <div class="col">
                                            <div class="{{ $verifikasiLapangan->skor <= 59 ? 'text-danger fw-bold' : 'text-muted' }}">
                                                0-59%<br>
                                                <small>Perlu Perbaikan</small>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="{{ $verifikasiLapangan->skor >= 60 && $verifikasiLapangan->skor <= 69 ? 'text-warning fw-bold' : 'text-muted' }}">
                                                60-69%<br>
                                                <small>Cukup</small>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="{{ $verifikasiLapangan->skor >= 70 && $verifikasiLapangan->skor <= 84 ? 'text-primary fw-bold' : 'text-muted' }}">
                                                70-84%<br>
                                                <small>Baik</small>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="{{ $verifikasiLapangan->skor >= 85 ? 'text-success fw-bold' : 'text-muted' }}">
                                                85-100%<br>
                                                <small>Sangat Baik</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <div class="d-flex justify-content-between">
                        <div>
                            <small class="text-muted">
                                <i class="fas fa-clock me-1"></i>
                                Terakhir diperbarui: {{ $verifikasiLapangan->updated_at->diffForHumans() }}
                            </small>
                        </div>
                        <div class="btn-group">
                            <a href="{{ route('verifikasi-lapangan.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-1"></i>Kembali
                            </a>
                            <a href="#" class="btn btn-primary print-btn">
                                <i class="fas fa-print me-1"></i>Cetak
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css">

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Print functionality
    document.querySelector('.print-btn').addEventListener('click', function(e) {
        e.preventDefault();
        window.print();
    });

    // Animate progress bar
    const progressBar = document.querySelector('.progress-bar');
    if (progressBar) {
        const width = progressBar.style.width;
        progressBar.style.width = '0%';
        setTimeout(() => {
            progressBar.style.width = width;
            progressBar.style.transition = 'width 1.5s ease-in-out';
        }, 300);
    }
});
</script>
@endpush

@push('styles')
<style>
.avatar-circle-lg {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    overflow: hidden;
    background: #f3f4f6;
    display: flex;
    align-items: center;
    justify-content: center;
    border: 3px solid #3b82f6;
}

.avatar-circle-lg img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.table-borderless th {
    color: #6b7280;
    font-weight: 500;
}

.progress {
    border-radius: 15px;
    overflow: hidden;
    background-color: #f3f4f6;
}

.progress-bar {
    border-radius: 15px;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: width 1.5s ease-in-out;
}

.card {
    border: 1px solid #e5e7eb;
}

.card-header {
    border-bottom: 1px solid #e5e7eb;
}

@media print {
    .btn-group, .card-footer, .print-btn {
        display: none !important;
    }

    .card {
        border: none;
        box-shadow: none;
    }
}
</style>
@endpush
