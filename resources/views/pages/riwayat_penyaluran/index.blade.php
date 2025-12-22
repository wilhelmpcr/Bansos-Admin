@extends('layouts.admin.app')

@section('content')
    <div class="container mt-4">

        {{-- HEADER --}}
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3>Riwayat Penyaluran</h3>
            <a href="{{ route('riwayat_penyaluran.create') }}" class="btn btn-primary">
                <i class="fa fa-plus"></i> Tambah Penyaluran
            </a>
        </div>

        {{-- FILTER & SEARCH --}}
        <form method="GET" class="row g-2 mb-3">
            <div class="col-md-4">
                <select name="program_id" class="form-select">
                    <option value="">Semua Program</option>
                    @foreach ($programs as $program)
                        <option value="{{ $program->program_id }}"
                            {{ request('program_id') == $program->program_id ? 'selected' : '' }}>
                            {{ $program->nama_program }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-4">
                <input type="text" name="search" value="{{ request('search') }}" class="form-control"
                    placeholder="Cari nama warga / program...">
            </div>

            <div class="col-md-2">
                <button class="btn btn-primary w-100">
                    <i class="fa fa-search"></i> Cari
                </button>
            </div>

            <div class="col-md-2">
                <a href="{{ route('riwayat_penyaluran.index') }}" class="btn btn-secondary w-100">
                    Reset
                </a>
            </div>
        </form>

        {{-- TABLE --}}
        <div class="table-responsive">
            <table class="table table-bordered align-middle table-hover">
                <thead class="table-light text-center">
                    <tr>
                        <th width="40">#</th>
                        <th>Pendaftar</th>
                        <th>Program</th>
                        <th>Tanggal</th>
                        <th>Jumlah</th>
                        <th>Status</th>
                        <th>Bukti</th>
                        <th width="160">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($riwayats as $item)
                        <tr>
                            <td class="text-center">
                                {{ $loop->iteration + ($riwayats->currentPage() - 1) * $riwayats->perPage() }}</td>

                            <td>{{ $item->pendaftar->warga->nama ?? '-' }}</td>

                            <td>{{ $item->pendaftar->program->nama_program ?? '-' }}</td>

                            <td class="text-center">
                                {{ \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') }}
                            </td>

                            <td>
                                Rp {{ number_format($item->jumlah, 0, ',', '.') }}
                            </td>

                            <td class="text-center">
                                <span
                                    class="badge bg-{{ $item->status === 'selesai'
                                        ? 'success'
                                        : ($item->status === 'diproses'
                                            ? 'warning'
                                            : ($item->status === 'draft'
                                                ? 'secondary'
                                                : 'danger')) }}">
                                    {{ ucfirst($item->status) }}
                                </span>
                            </td>

                            {{-- BUKTI --}}
                            <td class="text-center">
                                @if (!empty($item->dokumen))
                                    <img src="{{ asset('storage/' . $item->dokumen[0]) }}" width="55"
                                        class="img-thumbnail" style="cursor:pointer" data-bs-toggle="modal"
                                        data-bs-target="#fotoModal{{ $item->penyaluran_id }}">
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>

                            {{-- AKSI --}}
                            <td class="text-center">
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ route('riwayat_penyaluran.show', $item->penyaluran_id) }}"
                                        class="btn btn-info" title="Detail">
                                        <i class="fa fa-eye"></i>
                                    </a>

                                    <a href="{{ route('riwayat_penyaluran.edit', $item->penyaluran_id) }}"
                                        class="btn btn-warning" title="Edit">
                                        <i class="fa fa-edit"></i>
                                    </a>

                                    <form action="{{ route('riwayat_penyaluran.destroy', $item->penyaluran_id) }}"
                                        method="POST" onsubmit="return confirm('Yakin hapus data ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger" title="Hapus">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>

                        {{-- MODAL FOTO --}}
                        @if (!empty($item->dokumen))
                            <div class="modal fade" id="fotoModal{{ $item->penyaluran_id }}" tabindex="-1">
                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Bukti Penyaluran</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body text-center">
                                            <img src="{{ asset('storage/' . $item->dokumen[0]) }}" class="img-fluid rounded">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                    @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted">
                                Belum ada data riwayat penyaluran
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- PAGINATION --}}

        <div class="d-flex justify-content-between align-items-center mt-3">
            <div class="text-muted">
                Menampilkan {{ $riwayats->firstItem() ?? 0 }} - {{ $riwayats->lastItem() ?? 0 }}
                dari {{ $riwayats->total() ?? 0 }} data
            </div>

            {{-- Nomor halaman + Next/Prev --}}
            {{ $riwayats->links('pagination::bootstrap-5') }}
        </div>


        {{-- KEMBALI --}}
        <div class="text-center mt-4">
            <a href="{{ route('dashboard') }}" class="btn btn-secondary">
                Kembali ke Dashboard
            </a>
        </div>

    </div>
@endsection
