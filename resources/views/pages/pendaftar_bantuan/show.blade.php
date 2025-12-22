@extends('layouts.admin.app')

@section('content')
<div class="container">
    <h1>Detail Pendaftar Bantuan</h1>

    <div class="card mt-3 shadow-sm">
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

                {{-- FOTO --}}
                <tr>
                    <th>Foto</th>
                    <td>
                        @if (!empty($pendaftar_bantuan->foto))
                            <img src="{{ asset('storage/' . $pendaftar_bantuan->foto) }}"
                                 alt="Foto Pendaftar"
                                 class="img-thumbnail"
                                 style="max-width: 180px;">
                        @else
                            <span class="text-muted">Tidak ada foto</span>
                        @endif
                    </td>
                </tr>
            </table>

            <a href="{{ route('pendaftar_bantuan.index') }}" class="btn btn-secondary">
                Kembali
            </a>

            <a href="{{ route('pendaftar_bantuan.edit', $pendaftar_bantuan) }}" class="btn btn-warning">
                Edit
            </a>
        </div>
    </div>
</div>
@endsection
