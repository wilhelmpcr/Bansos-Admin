@extends('layouts.admin.app')

@section('content')
<div class="container">
    <h1>Data Pendaftar Bantuan</h1>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('pendaftar_bantuan.create') }}" class="btn btn-primary mb-3">
        + Tambah Pendaftar
    </a>

    <div class="table-responsive">

        {{-- FILTER & SEARCH --}}
        <form method="GET" action="{{ route('pendaftar_bantuan.index') }}" class="mb-3">
            <div class="row">
                <div class="col-md-3">
                    <select name="status_seleksi" class="form-select" onchange="this.form.submit()">
                        <option value="">Semua Status</option>
                        <option value="ditolak" {{ request('status_seleksi') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                        <option value="diterima" {{ request('status_seleksi') == 'diterima' ? 'selected' : '' }}>Diterima</option>
                        <option value="pending"  {{ request('status_seleksi') == 'pending'  ? 'selected' : '' }}>Pending</option>
                    </select>
                </div>

                <div class="col-md-3">
                    <div class="input-group">
                        <input type="text"
                               name="search"
                               class="form-control"
                               value="{{ request('search') }}"
                               placeholder="Search">
                        <button type="submit" class="input-group-text">🔍</button>

                        @if (request('search'))
                            <a href="{{ route('pendaftar_bantuan.index') }}"
                               class="btn btn-outline-secondary ms-2">
                                Clear
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </form>

        {{-- TABLE --}}
        <table class="table table-bordered table-striped align-middle">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Foto</th>
                    <th>Nama Warga</th>
                    <th>Program Bantuan</th>
                    <th>Status Seleksi</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
            @forelse ($pendaftar as $index => $p)
                <tr>
                    <td class="text-center">
                        {{ $pendaftar->firstItem() + $index }}
                    </td>

                    {{-- FOTO PENERIMA --}}
                    <td class="text-center">
                        @if ($p->penerima?->foto)
                            <img src="{{ asset('storage/' . $p->penerima->foto) }}"
                                 width="60"
                                 class="rounded img-thumbnail"
                                 alt="Foto Penerima">
                        @else
                            <span class="text-muted">Tidak ada foto</span>
                        @endif
                    </td>

                    <td>{{ $p->warga->nama ?? '-' }}</td>
                    <td>{{ $p->program->nama_program ?? '-' }}</td>

                    <td class="text-center">
                        <span class="badge
                            {{ $p->status_seleksi === 'diterima' ? 'bg-success' :
                               ($p->status_seleksi === 'ditolak' ? 'bg-danger' : 'bg-warning') }}">
                            {{ ucfirst($p->status_seleksi) }}
                        </span>
                    </td>

                    <td class="text-center">
                        <div class="btn-group">
                            <a href="{{ route('pendaftar_bantuan.show', $p) }}"
                               class="btn btn-sm btn-info">Detail</a>

                            <a href="{{ route('pendaftar_bantuan.edit', $p) }}"
                               class="btn btn-sm btn-warning">Edit</a>

                            <form action="{{ route('pendaftar_bantuan.destroy', $p) }}"
                                  method="POST"
                                  onsubmit="return confirm('Yakin hapus data ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="btn btn-sm btn-danger">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">
                        Belum ada pendaftar.
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>

        <div class="mt-3">
            {{ $pendaftar->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>
@endsection
