@extends('layouts.admin.app')

@section('title', 'Detail Verifikasi Lapangan')

@section('content')
<div class="container-fluid">
    <div class="card shadow">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Detail Verifikasi Lapangan</h5>
            <a href="{{ route('verifikasi_lapangan.index') }}" class="btn btn-secondary btn-sm">
                Kembali
            </a>
        </div>

        <div class="card-body">
            <table class="table table-borderless">
                <tr>
                    <th width="30%">Nama Warga</th>
                    <td>: {{ $verifikasiLapangan->pendaftar->warga->nama ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Foto Warga</th>
                    <td>
                        @if($verifikasiLapangan->pendaftar->warga->foto ?? false)
                            <img src="{{ asset('storage/' . $verifikasiLapangan->pendaftar->warga->foto) }}"
                                 width="120"
                                 class="img-thumbnail rounded">
                        @else
                            <span class="text-muted">Tidak ada foto</span>
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>Petugas</th>
                    <td>: {{ $verifikasiLapangan->petugas ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Tanggal</th>
                    <td>: {{ optional($verifikasiLapangan->tanggal)->format('d-m-Y') }}</td>
                </tr>
                <tr>
                    <th>Skor</th>
                    <td>: {{ $verifikasiLapangan->skor ?? '0' }}%</td>
                </tr>
                <tr>
                    <th>Catatan</th>
                    <td>: {{ $verifikasiLapangan->catatan ?? '-' }}</td>
                </tr>
            </table>

            <hr>

            <h6>Foto Verifikasi</h6>

            @php
                $fotos = is_array($verifikasiLapangan->foto_verifikasi)
                    ? $verifikasiLapangan->foto_verifikasi
                    : [];
            @endphp

            @if(count($fotos))
                <div class="row">
                    @foreach($fotos as $foto)
                        <div class="col-md-3 mb-3">
                            <img src="{{ Storage::url($foto) }}"
                                 class="img-fluid rounded border">
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-muted">Tidak ada foto verifikasi</p>
            @endif
        </div>

        <div class="card-footer text-end">
            <a href="{{ route('verifikasi_lapangan.edit', $verifikasiLapangan->verifikasi_id) }}"
               class="btn btn-warning btn-sm">
                Edit
            </a>
        </div>
    </div>
</div>
@endsection
