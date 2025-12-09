@extends('layouts.admin.app')

@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Data Peristiwa Kelahiran</h4>
        <a href="{{ route('kelahiran.create') }}" class="btn btn-primary">Tambah Kelahiran</a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-primary">
                    <tr>
                        <th>#</th>
                        <th>Foto</th>
                        <th>Nama Bayi</th>
                        <th>Anak</th>
                        <th>Ayah</th>
                        <th>Ibu</th>
                        <th>Tanggal Lahir</th>
                        <th>Tempat Lahir</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($kelahiran as $index => $k)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>
                                {{-- GANTI INI: $k->foto menjadi $k->media atau $k->medias --}}
                                @if($k->media && $k->media->file_url)
                                    <img src="{{ asset('storage/'.$k->media->file_url) }}"
                                         width="80"
                                         height="80"
                                         style="object-fit: cover; border-radius: 5px;"
                                         alt="Foto {{ $k->nama_bayi }}">
                                @else
                                    <span class="badge bg-secondary">Tidak ada foto</span>
                                @endif
                            </td>
                            <td>{{ $k->nama_bayi }}</td>
                            <td>{{ $k->anak->nama ?? '-' }}</td>
                            <td>{{ $k->ayah->nama ?? '-' }}</td>
                            <td>{{ $k->ibu->nama ?? '-' }}</td>
                            <td>{{ \Carbon\Carbon::parse($k->tanggal_lahir)->format('d-m-Y') }}</td>
                            <td>{{ $k->tempat_lahir }}</td>
                            <td>
                                <a href="{{ route('kelahiran.edit', $k->kelahiran_id) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('kelahiran.destroy', $k->kelahiran_id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center">Belum ada data kelahiran</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
