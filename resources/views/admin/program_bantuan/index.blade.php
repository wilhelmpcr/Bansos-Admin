@extends('layouts.admin.app')

@section('content')
<body class="bg-light">

<div class="container py-4">
    <h2 class="mb-4 text-center">Data Program Bantuan</h2>

    <!-- Tombol tambah data -->
    <div class="mb-3 text-end">
        <a href="{{ route('program_bantuan.create') }}" class="btn btn-primary">+ Tambah Program</a>
    </div>

    <!-- Tabel data -->
    <div class="card shadow-sm">
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <table class="table table-bordered table-striped align-middle">
                <thead class="table-dark text-center">
                    <tr>
                        <th>No</th>
                        <th>Kode</th>
                        <th>Nama Program</th>
                        <th>Tahun</th>
                        <th>Deskripsi</th>
                        <th>Anggaran (Rp)</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($programs as $index => $program)
                        <tr>
                            <td class="text-center">{{ $index + 1 }}</td>
                            <td>{{ $program->kode }}</td>
                            <td>{{ $program->nama_program }}</td>
                            <td class="text-center">{{ $program->tahun }}</td>
                            <td>{{ $program->deskripsi ?? '-' }}</td>
                            <td class="text-end">{{ number_format($program->anggaran, 2, ',', '.') }}</td>
                            <td class="text-center">
                                <a href="{{ route('program_bantuan.edit', $program->program_id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('program_bantuan.destroy', $program->program_id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus program ini?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted">Belum ada data program bantuan</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="text-center mt-4">
        <a href="{{ url('/dashboard') }}" class="btn btn-secondary">Kembali ke Dashboard</a>
    </div>
</div>

</body>
@endsection
