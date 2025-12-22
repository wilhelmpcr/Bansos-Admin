@extends('layouts.admin.app')

@section('title', 'Verifikasi Lapangan')

@section('content')
<div class="container-fluid mt-4"> {{-- container-fluid supaya full-width --}}
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Verifikasi Lapangan</h3>
        <a href="{{ route('verifikasi_lapangan.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-1"></i> Tambah Data
        </a>
    </div>

    {{-- FILTER & SEARCH --}}
    <form method="GET" class="row g-2 mb-3">
        <div class="col-md-6">
            <input type="text"
                   name="search"
                   value="{{ request('search') }}"
                   class="form-control"
                   placeholder="Cari nama warga atau petugas...">
        </div>
        <div class="col-md-2">
            <button class="btn btn-primary w-100">
                <i class="fas fa-search me-1"></i> Cari
            </button>
        </div>
        <div class="col-md-2">
            <a href="{{ route('verifikasi_lapangan.index') }}" class="btn btn-secondary w-100">
                Reset
            </a>
        </div>
    </form>

    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover align-middle">
            <thead class="table-light text-center">
                <tr>
                    <th width="5%">No</th>
                    <th>Pendaftar</th>
                    <th>Petugas</th>
                    <th>Tanggal</th>
                    <th>Skor</th>
                    <th>Foto</th>
                    <th width="18%">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($verifikasi as $item)
                    <tr>
                        <td class="text-center">{{ $verifikasi->firstItem() + $loop->index }}</td>
                        <td>{{ $item->pendaftar->warga->nama ?? '-' }}</td>
                        <td>{{ $item->petugas }}</td>
                        <td class="text-center">{{ \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') }}</td>
                        <td class="text-center">
                            @if(!is_null($item->skor))
                                <span class="badge bg-info">{{ $item->skor }}%</span>
                            @else
                                -
                            @endif
                        </td>
                        <td class="text-center">
                            @if(is_array($item->foto_verifikasi) && count($item->foto_verifikasi) > 0)
                                <img src="{{ Storage::url($item->foto_verifikasi[0]) }}"
                                     width="50"
                                     class="rounded shadow-sm">
                            @else
                                -
                            @endif
                        </td>
                        <td class="text-center">
                            <div class="btn-group btn-group-sm">
                                <a href="{{ route('verifikasi_lapangan.show', $item->verifikasi_id) }}" class="btn btn-info">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('verifikasi_lapangan.edit', $item->verifikasi_id) }}" class="btn btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('verifikasi_lapangan.destroy', $item->verifikasi_id) }}"
                                      method="POST"
                                      onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted">
                            Data verifikasi belum tersedia
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- PAGINATION --}}
    <div class="d-flex justify-content-between align-items-center mt-3">
        <div class="text-muted">
            Menampilkan {{ $verifikasi->firstItem() ?? 0 }} - {{ $verifikasi->lastItem() ?? 0 }}
            dari {{ $verifikasi->total() ?? 0 }} data
        </div>

        <div>
            {{ $verifikasi->appends(request()->query())->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>

{{-- Optional CSS untuk jarak antar elemen --}}
@push('styles')
<style>
    .table td, .table th {
        vertical-align: middle;
    }
    .table img {
        object-fit: cover;
    }
</style>
@endpush
@endsection
