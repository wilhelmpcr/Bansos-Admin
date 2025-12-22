@extends('layouts.admin.app')

@section('title', 'Edit Verifikasi Lapangan')

@section('content')
@php
    $status = $verifikasiLapangan->status_label ?? [
        'label' => 'Belum Dinilai',
        'color' => 'secondary'
    ];
@endphp

<div class="container-fluid">
    <div class="card shadow">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Edit Verifikasi Lapangan</h5>
            <a href="{{ route('verifikasi_lapangan.show', $verifikasiLapangan->verifikasi_id) }}"
               class="btn btn-info btn-sm">
                <i class="fas fa-eye"></i> Detail
            </a>
        </div>

        <div class="card-body">

            {{-- ERROR VALIDASI --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('verifikasi_lapangan.update', $verifikasiLapangan->verifikasi_id) }}"
                  method="POST"
                  enctype="multipart/form-data">

                @csrf
                @method('PUT')

                {{-- PENTING --}}
                <input type="hidden"
                       name="pendaftar_id"
                       value="{{ old('pendaftar_id', $verifikasiLapangan->pendaftar_id) }}">

                {{-- Petugas --}}
                <div class="mb-3">
                    <label class="form-label">Petugas</label>
                    <input type="text"
                           name="petugas"
                           class="form-control"
                           value="{{ old('petugas', $verifikasiLapangan->petugas) }}"
                           required>
                </div>

                {{-- Tanggal --}}
                <div class="mb-3">
                    <label class="form-label">Tanggal</label>
                    <input type="date"
                           name="tanggal"
                           class="form-control"
                           value="{{ old('tanggal', optional($verifikasiLapangan->tanggal)->format('Y-m-d')) }}"
                           required>
                </div>

                {{-- Skor --}}
                <div class="mb-3">
                    <label class="form-label">Skor</label>
                    <input type="number"
                           name="skor"
                           class="form-control"
                           min="0"
                           max="100"
                           value="{{ old('skor', $verifikasiLapangan->skor) }}">
                </div>

                {{-- Catatan --}}
                <div class="mb-3">
                    <label class="form-label">Catatan</label>
                    <textarea name="catatan"
                              class="form-control"
                              rows="3">{{ old('catatan', $verifikasiLapangan->catatan) }}</textarea>
                </div>

                {{-- Foto Lama --}}
                @if(is_array($verifikasiLapangan->foto_verifikasi) && count($verifikasiLapangan->foto_verifikasi))
                    <div class="mb-3">
                        <label class="form-label">Foto Saat Ini</label>
                        <div class="row g-2">
                            @foreach($verifikasiLapangan->foto_verifikasi as $foto)
                                <div class="col-md-2">
                                    <img src="{{ Storage::url($foto) }}"
                                         class="img-thumbnail"
                                         style="height:100px;object-fit:cover">
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                {{-- Foto Baru --}}
                <div class="mb-3">
                    <label class="form-label">Tambah Foto Baru</label>
                    <input type="file"
                           name="foto_verifikasi[]"
                           class="form-control"
                           multiple>
                </div>

                {{-- Status --}}
                <div class="mb-4">
                    <span class="badge bg-{{ $status['color'] }}">
                        {{ $status['label'] }}
                    </span>
                </div>

                {{-- Action --}}
                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('verifikasi_lapangan.index') }}"
                       class="btn btn-secondary">
                        Batal
                    </a>

                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i> Update
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection
