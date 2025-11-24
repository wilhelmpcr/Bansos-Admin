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

            <div class="table-responsive">
              <form method="GET" action="{{ route('program_bantuan.index') }}" class="mb-3">
    <div class="row">
        {{-- FILTER PROGRAM (dropdown) --}}
        <div class="col-md-4">
            <select name="nama_program" class="form-select" onchange="this.form.submit()">
                <option value="">Semua Program</option>
                <option value="Bantuan Sembako"
                    {{ request('nama_program') == 'Bantuan Sembako' ? 'selected' : '' }}>
                    Bantuan Sembako
                </option>
                <option value="Bantuan Beasiswa Mahasiswa"
                    {{ request('nama_program') == 'Bantuan Beasiswa Mahasiswa' ? 'selected' : '' }}>
                    Bantuan Beasiswa Mahasiswa
                </option>
                <option value="Bantuan Pendidikan"
                    {{ request('nama_program') == 'Bantuan Pendidikan' ? 'selected' : '' }}>
                    Bantuan Pendidikan
                </option>
                <option value="Bantuan Kesehatan"
                    {{ request('nama_program') == 'Bantuan Kesehatan' ? 'selected' : '' }}>
                    Bantuan Kesehatan
                </option>
            </select>
        </div>

        {{-- 🔍 SEARCH + CLEAR (tepat di bawah filter "gender" versi tugasmu) --}}
        <div class="col-md-3">
            <div class="input-group">
                <input type="text"
                       name="search"
                       class="form-control"
                       id="exampleInputIconRight"
                       value="{{ request('search') }}"
                       placeholder="Search"
                       aria-label="Search">

                <button type="submit" class="input-group-text" id="basic-addon2">
                    <svg class="icon icon-xxs" fill="currentColor" viewBox="0 0 20 20"
                         xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                              d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                              clip-rule="evenodd"></path>
                    </svg>
                </button>

                {{-- 4️⃣ Clear Search --}}
                @if(request('search'))
                    <a href="{{ request()->fullUrlWithQuery(['search' => null]) }}"
                       class="btn btn-outline-secondary ms-2"
                       id="clear-search">
                        Clear
                    </a>
                @endif
            </div>
        </div>
    </div>
</form>

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
                                {{-- nomor ikut pagination --}}
                                <td class="text-center">{{ $programs->firstItem() + $index }}</td>
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
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus program ini?')">
                                            Hapus
                                        </button>
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

                {{-- PAGINATION --}}
                <div class="mt-3">
                    {{ $programs->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>

    <div class="text-center mt-4">
        <a href="{{ url('/dashboard') }}" class="btn btn-secondary">Kembali ke Dashboard</a>
    </div>
</div>

</body>
@endsection
