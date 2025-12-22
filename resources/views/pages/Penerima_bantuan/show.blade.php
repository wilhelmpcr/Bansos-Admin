@extends('layouts.admin.app')

@section('content')
<div class="container-fluid px-4">
    <h4 class="mb-3">Detail Penerima Bantuan</h4>

    <table class="table table-bordered">
        <tr>
            <th width="30%">Nama</th>
            <td>{{ $data->nama }}</td>
        </tr>
        <tr>
            <th>NIK</th>
            <td>{{ $data->nik }}</td>
        </tr>
        <tr>
            <th>Warga</th>
            <td>{{ $data->warga->nama ?? '-' }}</td>
        </tr>
        <tr>
            <th>Program</th>
            <td>{{ $data->program->nama_program ?? '-' }}</td>
        </tr>
        <tr>
            <th>Status</th>
            <td>{{ ucfirst($data->status) }}</td>
        </tr>
        <tr>
            <th>Keterangan</th>
            <td>{{ $data->keterangan ?? '-' }}</td>
        </tr>
    </table>

    <a href="{{ route('penerima_bantuan.index') }}" class="btn btn-secondary">
        ← Kembali
    </a>
</div>
@endsection
