@extends('layouts.admin.app')

@section('content')
    <div class="container py-4">

        <h3 class="mb-3">Data Penerima Bantuan</h3>

        {{-- Alert --}}
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        {{-- FILTER & SEARCH --}}
        <form method="GET" action="{{ route('penerima_bantuan.index') }}" class="row g-2 mb-3">
            <div class="col-md-3">
                <select name="warga_id" class="form-select">
                    <option value="">-- Semua Warga --</option>
                    @foreach ($warga as $w)
                        <option value="{{ $w->warga_id }}" @selected(request('warga_id') == $w->warga_id)>
                            {{ $w->nama }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-3">
                <select name="program_id" class="form-select">
                    <option value="">-- Semua Program --</option>
                    @foreach ($program as $p)
                        <option value="{{ $p->program_id }}" @selected(request('program_id') == $p->program_id)>
                            {{ $p->nama_program }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-3">
                <input type="text" name="search" class="form-control" placeholder="Cari nama warga / keterangan"
                    value="{{ request('search') }}">
            </div>

            <div class="col-md-3 d-flex gap-2">
                <button class="btn btn-primary">Filter</button>
                <a href="{{ route('penerima_bantuan.index') }}" class="btn btn-secondary">
                    Reset
                </a>
            </div>
        </form>

        {{-- Tambah --}}
        <a href="{{ route('penerima_bantuan.create') }}" class="btn btn-primary mb-3">
            + Tambah Data
        </a>

        {{-- TABLE --}}
        <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle">
                <thead class="table-dark text-center">
                    <tr>
                        <th width="5%">No</th>
                        <th>Nama Warga</th>
                        <th>Program</th>
                        <th>Keterangan</th>
                        <th width="15%">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($dataPenerima as $index => $item)
                        <tr>
                            {{-- No --}}
                            <td class="text-center">
                                {{ $dataPenerima->firstItem() + $index }}
                            </td>

                            {{-- Nama Warga --}}
                            <td>{{ $item->warga->nama ?? '-' }}</td>

                            {{-- Program --}}
                            <td>{{ $item->program->nama_program ?? '-' }}</td>

                            {{-- Keterangan --}}
                            <td>{{ $item->keterangan ?? '-' }}</td>

                            {{-- Aksi --}}
                            <td class="text-center text-nowrap">
                                <a href="{{ route('penerima_bantuan.show', $item->penerima_id) }}"
                                    class="btn btn-info btn-sm">
                                    Detail
                                </a>

                                <a href="{{ route('penerima_bantuan.edit', $item->penerima_id) }}"
                                    class="btn btn-warning btn-sm">
                                    Edit
                                </a>

                                <form action="{{ route('penerima_bantuan.destroy', $item->penerima_id) }}" method="POST"
                                    class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted">
                                Data penerima bantuan belum tersedia
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- INFO JUMLAH DATA & PAGINATION --}}
        <div class="d-flex justify-content-between align-items-center mt-3 flex-wrap gap-2">

            {{-- INFO JUMLAH DATA --}}
            <div class="text-muted small">
                @if ($dataPenerima->total() > 0)
                    Menampilkan
                    <strong>{{ $dataPenerima->firstItem() }}</strong>
                    sampai
                    <strong>{{ $dataPenerima->lastItem() }}</strong>
                    dari
                    <strong>{{ $dataPenerima->total() }}</strong>
                    data
                @else
                    Menampilkan 0 data
                @endif
            </div>

            {{-- PAGINATION --}}
            <div>
                {{ $dataPenerima->withQueryString()->links('pagination::bootstrap-5') }}
            </div>

        </div>

        {{-- KEMBALI --}}
        <div class="text-center mt-3">
            <a href="{{ route('dashboard') }}" class="btn btn-secondary">
                Kembali ke Dashboard
            </a>
        </div>


    </div>
@endsection
