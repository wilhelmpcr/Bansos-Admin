@extends('layouts.admin.app')

@section('content')
<div class="container mt-5 bg-light">

    <h2 class="mb-4 text-center">Data Warga</h2>

    <div class="mb-3 text-end">
        <a href="{{ route('warga.create') }}" class="btn btn-primary">
            + Tambah Warga
        </a>
    </div>

    {{-- Pesan sukses --}}
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="table-responsive">

        {{-- FILTER & SEARCH --}}
        <form method="GET" action="{{ route('warga.index') }}" class="mb-3">
            <div class="row g-2">

                {{-- Filter Jenis Kelamin --}}
                <div class="col-md-2">
                    <select name="jenis_kelamin" class="form-select" onchange="this.form.submit()">
                        <option value="">Semua Jenis Kelamin</option>
                        <option value="L" {{ request('jenis_kelamin') == 'L' ? 'selected' : '' }}>
                            Laki-Laki
                        </option>
                        <option value="P" {{ request('jenis_kelamin') == 'P' ? 'selected' : '' }}>
                            Perempuan
                        </option>
                    </select>
                </div>

                {{-- Search --}}
                <div class="col-md-3">
                    <div class="input-group">
                        <input type="text"
                               name="search"
                               class="form-control"
                               value="{{ request('search') }}"
                               placeholder="Search">

                        <button type="submit" class="btn btn-secondary">
                            Cari
                        </button>

                        @if (request('search'))
                            <a href="{{ route('warga.index') }}"
                               class="btn btn-outline-secondary">
                                Clear
                            </a>
                        @endif
                    </div>
                </div>

            </div>
        </form>

        {{-- TABEL --}}
        <table class="table table-bordered table-striped bg-white shadow-sm align-middle">
            <thead class="table-dark">
                <tr>
                    <th class="text-center" width="50">No</th>
                    <th>ID</th>
                    <th>No KTP</th>
                    <th>Nama</th>
                    <th>Jenis Kelamin</th>
                    <th>Agama</th>
                    <th>Pekerjaan</th>
                    <th>Telp</th>
                    <th>Email</th>
                    <th class="text-center">Foto Bukti</th>
                    <th class="text-center" width="160">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($dataWarga as $index => $warga)
                    <tr>
                        <td class="text-center">
                            {{ $dataWarga->firstItem() + $index }}
                        </td>
                        <td>{{ $warga->warga_id }}</td>
                        <td>{{ $warga->no_ktp }}</td>
                        <td>{{ $warga->nama }}</td>
                        <td>
                            {{ $warga->jenis_kelamin == 'L' ? 'Laki-Laki' : 'Perempuan' }}
                        </td>
                        <td>{{ $warga->agama }}</td>
                        <td>{{ $warga->pekerjaan }}</td>
                        <td>{{ $warga->telp ?? '-' }}</td>
                        <td>{{ $warga->email ?? '-' }}</td>

                        {{-- FOTO BUKTI --}}
                        <td class="text-center">
                            @if ($warga->foto_bukti)
                                <a href="{{ asset('storage/' . $warga->foto_bukti) }}"
                                   target="_blank">
                                    <img src="{{ asset('storage/' . $warga->foto_bukti) }}"
                                         width="45"
                                         class="img-thumbnail"
                                         alt="Foto Bukti">
                                </a>
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>

                        {{-- AKSI --}}
                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-1">
                                <a href="{{ route('warga.show', $warga->warga_id) }}"
                                   class="btn btn-info btn-sm">
                                    Detail
                                </a>

                                <a href="{{ route('warga.edit', $warga->warga_id) }}"
                                   class="btn btn-warning btn-sm">
                                    Edit
                                </a>

                                <form action="{{ route('warga.destroy', $warga->warga_id) }}"
                                      method="POST"
                                      class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            onclick="return confirm('Yakin hapus data ini?')"
                                            class="btn btn-danger btn-sm">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="11" class="text-center text-muted">
                            Belum ada data warga
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{-- PAGINATION --}}
        <div class="mt-3">
            {{ $dataWarga->links('pagination::bootstrap-5') }}
        </div>

        <div class="text-center mt-4">
            <a href="{{ url('/dashboard') }}" class="btn btn-secondary">
                Kembali ke Dashboard
            </a>
        </div>

    </div>
</div>
@endsection
