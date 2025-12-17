@extends('layouts.admin.app')

@section('content')
<div class="container">
    <h1>Detail Pendaftar Bantuan</h1>

    <div class="card">
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th>Nama Warga</th>
                    <td>{{ $pendaftar_bantuan->warga->nama ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Program Bantuan</th>
                    <td>{{ $pendaftar_bantuan->program->nama_program ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Status Seleksi</th>
                    <td>{{ ucfirst($pendaftar_bantuan->status_seleksi) }}</td>
                </tr>
            </table>

            <a href="{{ route('pendaftar_bantuan.index') }}" class="btn btn-secondary">
                Kembali
            </a>

            <a href="{{ route('pendaftar_bantuan.edit', $pendaftar_bantuan->pendaftar_id) }}"
               class="btn btn-warning">
                Edit
            </a>
        </div>
    </div>
</div>
@endsection
