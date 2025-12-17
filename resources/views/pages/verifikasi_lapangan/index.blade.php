@extends('layouts.admin.app')

@section('title', 'Verifikasi Lapangan')

@section('content')
<div class="container">
    <h1>Verifikasi Lapangan</h1>

    <a href="{{ route('verifikasi_lapangan.create') }}" class="btn btn-primary mb-3">
        Tambah Data
    </a>

    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Petugas</th>
            <th>Tanggal</th>
            <th>Skor</th>
        </tr>
        @foreach($verifikasi as $item)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $item->petugas }}</td>
            <td>{{ $item->tanggal }}</td>
            <td>{{ $item->skor ?? '-' }}</td>
        </tr>
        @endforeach
    </table>

    {{ $verifikasi->links() }}
</div>
@endsection
