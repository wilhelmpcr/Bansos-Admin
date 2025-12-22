@extends('layouts.admin.app')

@section('title', '404 - Halaman Tidak Ditemukan')

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="min-height: 70vh;">
    <div class="text-center">
        <h1 class="display-1 fw-bold text-danger">404</h1>
        <h4 class="mb-3">Halaman Tidak Ditemukan</h4>
        <p class="text-muted">
            Maaf, halaman yang Anda akses tidak tersedia,<br>
            sudah dihapus, atau Anda tidak memiliki hak akses.
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
