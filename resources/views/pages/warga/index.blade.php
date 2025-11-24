@extends('layouts.admin.app')

@section('content')
<body class="bg-light">

<div class="container mt-5">
    <h2 class="mb-4 text-center">Data Warga</h2>

    <div class="mb-3 text-end">
        <a href="{{ route('warga.create') }}" class="btn btn-primary">+ Tambah Warga</a>
    </div>

    {{-- Kalau mau tampilkan pesan sukses --}}
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
<div class="table-responsive">
    <form method="GET" action="{{ route('warga.index') }}" class="mb-3">
        <div class="row">
            {{-- Filter Jenis Kelamin --}}
            <div class="col-md-2">
                <select name="jenis_kelamin" class="form-select" onchange="this.form.submit()">
                    <option value="">Semua Jenis Kelamin</option>
                    <option value="L" {{ request('jenis_kelamin')=='L' ? 'selected' : '' }}>Laki-Laki</option>
                    <option value="P" {{ request('jenis_kelamin')=='P' ? 'selected' : '' }}>Perempuan</option>
                </select>
            </div>

            {{-- 1️⃣ Tambah Form Search tepat di bawah filter gender --}}
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


    <table class="table table-bordered table-striped bg-white shadow-sm">
        <thead class="table-dark">
            <tr>
                <th>No</th>
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
            @forelse($dataWarga as $index => $warga)
            <tr>
                {{-- nomor urut mengikuti pagination --}}
                <td>{{ $dataWarga->firstItem() + $index }}</td>
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
            @empty
            <tr>
                <td colspan="10" class="text-center text-muted">Belum ada data warga</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    {{-- PAGINATION --}}
    <div class="mt-3">
        {{ $dataWarga->links('pagination::bootstrap-5') }}
    </div>

    <div class="text-center mt-4">
        <a href="{{ url('/dashboard') }}" class="btn btn-secondary">Kembali ke Dashboard</a>
    </div>
</div>

</body>
@endsection
