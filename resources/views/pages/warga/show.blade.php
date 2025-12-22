@extends('layouts.admin.app')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4 text-center">Detail Data Warga</h2>

    <div class="card shadow-sm">
        <div class="card-body">

            <div class="row">
                {{-- FOTO BUKTI --}}
                <div class="col-md-4 text-center mb-3">
                    @if ($warga->foto_bukti)
                        <a href="{{ asset('storage/' . $warga->foto_bukti) }}" target="_blank">
                            <img src="{{ asset('storage/' . $warga->foto_bukti) }}"
                                 class="img-fluid rounded shadow"
                                 style="max-height: 300px;"
                                 alt="Foto Bukti">
                        </a>
                        <p class="text-muted mt-2">
                            Klik foto untuk memperbesar
                        </p>
                    @else
                        <div class="border rounded p-5 text-muted">
                            Tidak ada foto bukti
                        </div>
                    @endif
                </div>

                {{-- DATA WARGA --}}
                <div class="col-md-8">
                    <table class="table table-bordered">
                        <tr>
                            <th width="35%">No KTP</th>
                            <td>{{ $warga->no_ktp }}</td>
                        </tr>
                        <tr>
                            <th>Nama</th>
                            <td>{{ $warga->nama }}</td>
                        </tr>
                        <tr>
                            <th>Jenis Kelamin</th>
                            <td>{{ $warga->jenis_kelamin == 'L' ? 'Laki-Laki' : 'Perempuan' }}</td>
                        </tr>
                        <tr>
                            <th>Agama</th>
                            <td>{{ $warga->agama }}</td>
                        </tr>
                        <tr>
                            <th>Pekerjaan</th>
                            <td>{{ $warga->pekerjaan }}</td>
                        </tr>
                        <tr>
                            <th>Telp</th>
                            <td>{{ $warga->telp ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{ $warga->email ?? '-' }}</td>
                        </tr>
                    </table>

                    <div class="text-end">
                        <a href="{{ route('warga.index') }}" class="btn btn-secondary">
                            Kembali
                        </a>
                        <a href="{{ route('warga.edit', $warga->warga_id) }}"
                           class="btn btn-warning">
                            Edit
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
