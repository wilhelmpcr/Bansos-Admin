@extends('layouts.admin.app')

@section('content')
<div class="container mt-4">
    <h3>Riwayat Penyaluran</h3>

    <a href="{{ route('riwayat_penyaluran.create') }}" class="btn btn-primary mb-3">Tambah Penyaluran</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Pendaftar</th>
                <th>Program</th>
                <th>Tanggal</th>
                <th>Jumlah</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($riwayats as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->pendaftar->warga->nama ?? 'N/A' }}</td>
                <td>{{ $item->pendaftar->program->nama_program ?? 'N/A' }}</td>
                <td>{{ $item->tanggal }}</td>
                <td>{{ number_format($item->jumlah, 2) }}</td>
                <td>{{ ucfirst($item->status) }}</td>
                <td>
                    <a href="{{ route('riwayat_penyaluran.show', $item->penyaluran_id) }}" class="btn btn-info btn-sm">Detail</a>
                    <a href="{{ route('riwayat_penyaluran.edit', $item->penyaluran_id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('riwayat_penyaluran.destroy', $item->penyaluran_id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Yakin hapus?')" class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
