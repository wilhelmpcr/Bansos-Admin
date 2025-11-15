@extends('layouts.admin.app') {{-- sesuaikan dengan layout-mu --}}

@section('content')
<div class="container">
    <h1>Data Pendaftar Bantuan</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('pendaftar_bantuan.create') }}" class="btn btn-primary mb-3">
        + Tambah Pendaftar
    </a>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama Warga</th>
                <th>Program Bantuan</th>
                <th>Status Seleksi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pendaftar as $index => $p)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $p->warga->nama ?? '-' }}</td>
                    <td>{{ $p->program->nama_program ?? '-' }}</td>
                    <td>{{ ucfirst($p->status_seleksi) }}</td>
                    <td>
                        <a href="{{ route('pendaftar_bantuan.edit', $p->pendaftar_id) }}" class="btn btn-sm btn-warning">
                            Edit
                        </a>

                        <form action="{{ route('pendaftar_bantuan.destroy', $p->pendaftar_id) }}"
                              method="POST"
                              style="display:inline-block"
                              onsubmit="return confirm('Yakin hapus data ini?');">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" type="submit">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">Belum ada pendaftar.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
