@extends('layouts.admin.app')

@section('title', 'Edit Verifikasi Lapangan')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow">
                <div class="card-header py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6 class="m-0 font-weight-bold text-primary">Edit Verifikasi Lapangan</h6>
                        <a href="{{ route('verifikasi_lapangan.show', $verifikasiLapangan->verifikasi_id) }}"
                           class="btn btn-info btn-sm">
                            <i class="fas fa-eye me-1"></i>Detail
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Pendaftar Info -->
                    <div class="alert alert-info mb-4">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-user-circle fa-2x me-3"></i>
                            <div>
                                <h6 class="mb-1">{{ $verifikasiLapangan->pendaftar->nama_lengkap }}</h6>
                                <p class="mb-0 text-muted">NIK: {{ $verifikasiLapangan->pendaftar->nik }} |
                                   Program: {{ $verifikasiLapangan->pendaftar->program_bantuan ?? '-' }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <form action="{{ route('verifikasi_lapangan.update', $verifikasiLapangan->verifikasi_id) }}"
                          method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Petugas <span class="text-danger">*</span></label>
                                <input type="text" name="petugas"
                                       class="form-control @error('petugas') is-invalid @enderror"
                                       value="{{ old('petugas', $verifikasiLapangan->petugas) }}" required>
                                @error('petugas')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Tanggal Verifikasi <span class="text-danger">*</span></label>
                                <input type="date" name="tanggal"
                                       class="form-control @error('tanggal') is-invalid @enderror"
                                       value="{{ old('tanggal', $verifikasiLapangan->tanggal->format('Y-m-d')) }}" required>
                                @error('tanggal')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Skor</label>
                                <div class="input-group">
                                    <input type="number" name="skor"
                                           class="form-control @error('skor') is-invalid @enderror"
                                           value="{{ old('skor', $verifikasiLapangan->skor) }}"
                                           min="0" max="100" step="0.01">
                                    <span class="input-group-text">%</span>
                                </div>
                                <small class="text-muted">Kosongkan jika belum ada penilaian</small>
                                @error('skor')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12 mb-3">
                                <label class="form-label">Catatan Verifikasi</label>
                                <textarea name="catatan" class="form-control @error('catatan') is-invalid @enderror"
                                          rows="4">{{ old('catatan', $verifikasiLapangan->catatan) }}</textarea>
                                @error('catatan')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Foto Verifikasi Existing -->
                            @if($verifikasiLapangan->foto_verifikasi && count($verifikasiLapangan->foto_verifikasi) > 0)
                            <div class="col-12 mb-4">
                                <label class="form-label">Foto Verifikasi Saat Ini</label>
                                <div class="row g-2">
                                    @foreach($verifikasiLapangan->foto_verifikasi as $index => $foto)
                                    <div class="col-md-3">
                                        <div class="card">
                                            <img src="{{ Storage::url($foto) }}"
                                                 class="card-img-top"
                                                 alt="Foto {{ $loop->iteration }}"
                                                 style="height: 120px; object-fit: cover;">
                                            <div class="card-footer p-2">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox"
                                                           name="hapus_foto[]" value="{{ $foto }}"
                                                           id="hapusFoto{{ $index }}">
                                                    <label class="form-check-label text-danger small"
                                                           for="hapusFoto{{ $index }}">
                                                        Hapus Foto
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            @endif

                            <!-- Tambah Foto Baru -->
                            <div class="col-12 mb-3">
                                <label class="form-label">Tambah Foto Baru</label>
                                <div class="file-upload-area border rounded p-3">
                                    <div class="mb-3">
                                        <input type="file" name="foto_verifikasi[]"
                                               class="form-control @error('foto_verifikasi.*') is-invalid @enderror"
                                               accept="image/*" multiple>
                                        <small class="text-muted">Upload foto tambahan (max 2MB per file)</small>
                                        @error('foto_verifikasi.*')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Preview Area -->
                                    <div id="previewContainer" class="row g-2 mt-2">
                                        <!-- Preview akan muncul di sini -->
                                    </div>
                                </div>
                            </div>

                            <!-- Status Info -->
                            <div class="col-12 mb-4">
                                <div class="card border-primary">
                                    <div class="card-header bg-primary text-white">
                                        <h6 class="mb-0"><i class="fas fa-info-circle me-2"></i>Informasi Status</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-md-8">
                                                <p class="mb-2">Skor saat ini:
                                                    <strong class="text-primary">{{ $verifikasiLapangan->skor ?? 'Belum dinilai' }}</strong>
                                                </p>
                                                <p class="mb-2">Status:
                                                    <span class="badge bg-{{ $verifikasiLapangan->status_label['color'] }}">
                                                        {{ $verifikasiLapangan->status_label['label'] }}
                                                    </span>
                                                </p>
                                                <p class="mb-0 text-muted small">
                                                    Status pendaftar akan otomatis diperbarui berdasarkan skor yang diinput.
                                                    Skor ≥ 60 akan mengubah status menjadi "Diverifikasi".
                                                </p>
                                            </div>
                                            <div class="col-md-4 text-center">
                                                <div class="progress-circle"
                                                     data-percent="{{ $verifikasiLapangan->skor ?? 0 }}"
                                                     style="width: 100px; height: 100px;">
                                                    <span class="progress-value">{{ $verifikasiLapangan->skor ?? 0 }}%</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('verifikasi_lapangan.index') }}" class="btn btn-secondary">
                                Batal
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-1"></i>Perbarui Data
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Foto preview
    const fileInput = document.querySelector('input[name="foto_verifikasi[]"]');
    const previewContainer = document.getElementById('previewContainer');

    fileInput.addEventListener('change', function(e) {
        previewContainer.innerHTML = '';

        Array.from(e.target.files).forEach((file, index) => {
            if (file.type.startsWith('image/')) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    const col = document.createElement('div');
                    col.className = 'col-md-3';

                    col.innerHTML = `
                        <div class="card">
                            <img src="${e.target.result}" class="card-img-top" alt="Preview" style="height: 120px; object-fit: cover;">
                            <div class="card-body p-2 text-center">
                                <small class="text-muted d-block">${file.name}</small>
                                <small class="text-muted">${(file.size / 1024 / 1024).toFixed(2)} MB</small>
                            </div>
                        </div>
                    `;

                    previewContainer.appendChild(col);
                };

                reader.readAsDataURL(file);
            }
        });
    });

    // Circular progress
    function drawProgressCircle() {
        const circles = document.querySelectorAll('.progress-circle');
        circles.forEach(circle => {
            const percent = circle.getAttribute('data-percent');
            const radius = 45;
            const circumference = 2 * Math.PI * radius;
            const offset = circumference - (percent / 100) * circumference;

            const svg = document.createElementNS('http://www.w3.org/2000/svg', 'svg');
            svg.setAttribute('width', '100');
            svg.setAttribute('height', '100');
            svg.setAttribute('viewBox', '0 0 100 100');

            const bgCircle = document.createElementNS('http://www.w3.org/2000/svg', 'circle');
            bgCircle.setAttribute('cx', '50');
            bgCircle.setAttribute('cy', '50');
            bgCircle.setAttribute('r', radius.toString());
            bgCircle.setAttribute('stroke', '#e5e7eb');
            bgCircle.setAttribute('stroke-width', '8');
            bgCircle.setAttribute('fill', 'none');

            const progressCircle = document.createElementNS('http://www.w3.org/2000/svg', 'circle');
            progressCircle.setAttribute('cx', '50');
            progressCircle.setAttribute('cy', '50');
            progressCircle.setAttribute('r', radius.toString());
            progressCircle.setAttribute('stroke', '#3b82f6');
            progressCircle.setAttribute('stroke-width', '8');
            progressCircle.setAttribute('fill', 'none');
            progressCircle.setAttribute('stroke-dasharray', circumference.toString());
            progressCircle.setAttribute('stroke-dashoffset', offset.toString());
            progressCircle.setAttribute('stroke-linecap', 'round');
            progressCircle.setAttribute('transform', 'rotate(-90 50 50)');
            progressCircle.style.transition = 'stroke-dashoffset 1.5s ease-in-out';

            svg.appendChild(bgCircle);
            svg.appendChild(progressCircle);
            circle.insertBefore(svg, circle.firstChild);
        });
    }

    drawProgressCircle();
});
</script>
@endpush

@push('styles')
<style>
.progress-circle {
    position: relative;
    display: inline-block;
}

.progress-value {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    font-size: 1.25rem;
    font-weight: bold;
    color: #3b82f6;
}

.form-check-input:checked {
    background-color: #dc3545;
    border-color: #dc3545;
}

.alert {
    border-left: 4px solid #0dcaf0;
}

.card {
    border: 1px solid #e5e7eb;
}

.card-header {
    border-bottom: 1px solid #e5e7eb;
}
</style>
@endpush
