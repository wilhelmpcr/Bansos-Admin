@extends('layouts.admin.app')

@section('content')
<body class="bg-light">

<div class="container mt-5">
    <h2 class="mb-4 text-center">Data Warga</h2>

    <div class="mb-3 text-end">
        <a href="{{ route('warga.create') }}" class="btn btn-primary">+ Tambah Warga</a>
    </div>

    <table class="table table-bordered table-striped bg-white shadow-sm">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>No KTP</th>
                <th>Nama</th>
                <th>Jenis Kelamin</th>
                <th>Agama</th>
                <th>Pekerjaan</th>
                <th>Telp</th>
                <th>Email</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($dataWarga as $warga)
            <tr>
                <td>{{ $warga->warga_id }}</td>
                <td>{{ $warga->no_ktp }}</td>
                <td>{{ $warga->nama }}</td>
                <td>{{ $warga->jenis_kelamin == 'L' ? 'Laki-Laki' : 'Perempuan' }}</td>
                <td>{{ $warga->agama }}</td>
                <td>{{ $warga->pekerjaan }}</td>
                <td>{{ $warga->telp ?? '-' }}</td>
                <td>{{ $warga->email ?? '-' }}</td>
                <td class="text-center">
                    <a href="{{ route('warga.edit', $warga->warga_id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('warga.destroy', $warga->warga_id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button onclick="return confirm('Yakin hapus data ini?')" class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="text-center mt-4">
        <a href="{{ url('/dashboard') }}" class="btn btn-secondary">Kembali ke Dashboard</a>
    </div>
</div>

</body>
@endsection
