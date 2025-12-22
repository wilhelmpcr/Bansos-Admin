@extends('layouts.admin.app')

@section('content')
    <div class="container py-4">

        <h2 class="mb-4 text-center">Data Program Bantuan</h2>

        {{-- Tombol tambah --}}
        <div class="mb-3 text-end">
            <a href="{{ route('program_bantuan.create') }}" class="btn btn-primary">
                + Tambah Program
            </a>
        </div>

        <div class="card shadow-sm">
            <div class="card-body">

                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="table-responsive">

                    {{-- FILTER & SEARCH --}}
                    <form method="GET" action="{{ route('program_bantuan.index') }}" class="mb-3">
                        <div class="row g-2">
                            <div class="col-md-4">
                                <select name="nama_program" class="form-select" onchange="this.form.submit()">
                                    <option value="">Semua Program</option>
                                    <option value="Bantuan Sembako"
                                        {{ request('nama_program') == 'Bantuan Sembako' ? 'selected' : '' }}>Bantuan Sembako
                                    </option>
                                    <option value="Bantuan Beasiswa Mahasiswa"
                                        {{ request('nama_program') == 'Bantuan Beasiswa Mahasiswa' ? 'selected' : '' }}>Bantuan
                                        Beasiswa Mahasiswa</option>
                                    <option value="Bantuan Pendidikan"
                                        {{ request('nama_program') == 'Bantuan Pendidikan' ? 'selected' : '' }}>Bantuan Pendidikan
                                    </option>
                                    <option value="Bantuan Kesehatan"
                                        {{ request('nama_program') == 'Bantuan Kesehatan' ? 'selected' : '' }}>Bantuan Kesehatan
                                    </option>
                                    <option value="Bantuan Lansia"
                                        {{ request('nama_program') == 'Bantuan Lansia' ? 'selected' : '' }}>Bantuan Lansia
                                    </option>
                                    <option value="Bantuan Difabel"
                                        {{ request('nama_program') == 'Bantuan Difabel' ? 'selected' : '' }}>Bantuan Difabel
                                    </option>
                                    <option value="Bantuan Perumahan"
                                        {{ request('nama_program') == 'Bantuan Perumahan' ? 'selected' : '' }}>Bantuan Perumahan
                                    </option>
                                </select>
                            </div>

                            <div class="col-md-3">
                                <div class="input-group">
                                    <input type="text" name="search" class="form-control"
                                        value="{{ request('search') }}" placeholder="Search">

                                    <button class="btn btn-outline-secondary" type="submit">
                                        🔍
                                    </button>

                                    @if (request('search'))
                                        <a href="{{ route('program_bantuan.index') }}" class="btn btn-outline-danger">
                                            Clear
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </form>

                    {{-- TABLE --}}
                    <table class="table table-bordered table-striped align-middle">
                        <thead class="table-dark text-center">
                            <tr>
                                <th>No</th>
                                <th>Foto</th>
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
                                    <td class="text-center">
                                        @if ($program->foto && file_exists(public_path('storage/' . $program->foto)))
                                            <img src="{{ asset('storage/' . $program->foto) }}" class="rounded shadow-sm"
                                                style="width:80px;height:80px;object-fit:cover">
                                        @else
                                            <span class="text-muted">Tidak ada</span>
                                        @endif
                                    </td>

                                    {{-- FOTO --}}
                                    <td class="text-center">
                                        @if (!empty($program->foto))
                                            <img src="{{ asset('storage/' . $program->foto) }}" class="img-thumbnail"
                                                style="width:70px;height:70px;object-fit:cover">
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>

                                    <td>{{ $program->kode }}</td>
                                    <td>{{ $program->nama_program }}</td>
                                    <td class="text-center">{{ $program->tahun }}</td>
                                    <td>{{ $program->deskripsi ?? '-' }}</td>
                                    <td class="text-end">
                                        Rp {{ number_format($program->anggaran, 0, ',', '.') }}
                                    </td>

                                    <td class="text-center">
                                        <div class="d-grid gap-1">
                                            <a href="{{ route('program_bantuan.show', $program->program_id) }}"
                                                class="btn btn-info btn-sm">
                                                Detail
                                            </a>

                                            <a href="{{ route('program_bantuan.edit', $program->program_id) }}"
                                                class="btn btn-warning btn-sm">
                                                Edit
                                            </a>

                                            <form action="{{ route('program_bantuan.destroy', $program->program_id) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Yakin ingin menghapus program ini?')">
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center text-muted">
                                        Belum ada data program bantuan
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    {{-- PAGINATION --}}
                    <div class="mt-3">
                        {{ $programs->links('pagination::bootstrap-5') }}
                    </div>

                </div>
            </div>
        </div>

        <div class="text-center mt-4">
            <a href="{{ url('/dashboard') }}" class="btn btn-secondary">
                Kembali ke Dashboard
            </a>
        </div>

    </div>
@endsection
