@extends('layouts.admin.app')

@section('title', '403 - Akses Ditolak')

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="min-height: 70vh;">
    <div class="text-center">
        <h1 class="display-1 fw-bold text-warning">403</h1>
        <h4 class="mb-3">Akses Ditolak</h4>
        <p class="text-muted">
            Anda tidak memiliki izin untuk mengakses halaman ini.<br>
            Silakan hubungi administrator jika ini adalah kesalahan.
        </p>

        <a href="{{ url()->previous() }}" class="btn btn-secondary me-2">
            Kembali
        </a>

        <a href="{{ route('dashboard') }}" class="btn btn-primary">
            Ke Dashboard
        </a>
    </div>
</div>
@endsection
