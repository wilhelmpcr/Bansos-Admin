@extends('layouts.admin.app')

@section('content')
<div class="container-fluid pt-4 px-4">

    {{-- ================= WIDGETS ================= --}}
    <div class="row g-4">
        <div class="col-sm-6 col-xl-3">
            <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa fa-check-square fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2">Verifikasi Lapangan</p>
                    <h6 class="mb-0">{{ $totalVerifikasi }}</h6>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-xl-3">
            <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa fa-history fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2">Riwayat Penyaluran</p>
                    <h6 class="mb-0">{{ $totalRiwayat }}</h6>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-xl-3">
            <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa fa-box-open fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2">Program Bantuan</p>
                    <h6 class="mb-0">{{ $totalProgram }}</h6>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-xl-3">
            <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa fa-users fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2">Pendaftar Bantuan</p>
                    <h6 class="mb-0">{{ $totalPendaftar }}</h6>
                </div>
            </div>
        </div>
    </div>

    {{-- ================= RECENT PENDAFTAR ================= --}}
    <div class="row g-4 mt-3">
        <div class="col-12">
            <div class="bg-light rounded p-4">
                <h6 class="mb-3">Recent Pendaftar</h6>

                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>ID</th>
                                <th>Nama</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($latestPendaftar as $pendaftar)
                                <tr>
                                    <td>{{ $pendaftar->created_at->format('d M Y') }}</td>
                                    <td>{{ $pendaftar->id }}</td>
                                    <td>{{ $pendaftar->nama ?? '-' }}</td>
                                    <td>{{ $pendaftar->status_seleksi ?? 'Pending' }}</td>
                                    <td>
                                        <a href="{{ route('pendaftar_bantuan.show', $pendaftar) }}"
                                           class="btn btn-sm btn-primary">
                                            Detail
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>

</div>
@endsection
