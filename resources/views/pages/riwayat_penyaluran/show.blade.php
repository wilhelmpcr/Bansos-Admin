@extends('layouts.admin.app')

@section('title', 'Detail Riwayat Penyaluran')

@section('content')
    <div class="container">
        <h1 class="mb-4">Detail Riwayat Penyaluran</h1>

        <div class="card mb-4">
            <div class="card-body">

                <p>
                    <strong>Tanggal:</strong>
                    {{ $riwayat->tanggal_format }}
                </p>

                <p>
                    <strong>Jumlah:</strong>
                    {{ $riwayat->jumlah_format }}
                </p>

                <p>
                    <strong>Status:</strong>
                    <span
                        class="badge bg-{{ $riwayat->status === 'selesai'
                            ? 'success'
                            : ($riwayat->status === 'diproses'
                                ? 'warning'
                                : ($riwayat->status === 'dibatalkan'
                                    ? 'danger'
                                    : 'secondary')) }}">
                        {{ ucfirst($riwayat->status) }}
                    </span>
                </p>

                <p>
                    <strong>Keterangan:</strong>
                    {{ $riwayat->keterangan ?: '-' }}
                </p>

                <hr>

                <h5 class="mb-3">Pendaftar</h5>

                <p>
                    <strong>Nama Warga:</strong>
                    {{ $riwayat->nama_warga }}
                </p>

                <p>
                    <strong>Program Bantuan:</strong>
                    {{ $riwayat->nama_program }}
                </p>

            </div>
        </div>

        <div class="card mb-4">
            <div class="card-body">
                <h5 class="mb-3">Dokumen Bukti Penyaluran</h5>

                @if (!empty($riwayat->dokumen))
                    <div class="row">
                        @foreach ($riwayat->dokumen as $file)
                            @php
                                $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
                            @endphp

                            <div class="col-md-3 mb-3 text-center">
                                {{-- IMAGE --}}
                                @if (in_array($ext, ['jpg', 'jpeg', 'png']))
                                    <img src="{{ asset('storage/' . $file) }}" class="img-thumbnail"
                                        style="cursor:pointer; max-height:150px" data-bs-toggle="modal"
                                        data-bs-target="#dokumenModal{{ $loop->index }}">

                                    {{-- PDF --}}
                                @elseif ($ext === 'pdf')
                                    <a href="{{ asset('storage/' . $file) }}" target="_blank"
                                        class="btn btn-outline-danger w-100">
                                        <i class="fa fa-file-pdf"></i> Lihat PDF
                                    </a>

                                    {{-- OTHER --}}
                                @else
                                    <span class="text-muted">File tidak didukung</span>
                                @endif
                            </div>

                            {{-- MODAL PREVIEW IMAGE --}}
                            @if (in_array($ext, ['jpg', 'jpeg', 'png']))
                                <div class="modal fade" id="dokumenModal{{ $loop->index }}" tabindex="-1">
                                    <div class="modal-dialog modal-dialog-centered modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Bukti Penyaluran</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body text-center">
                                                <img src="{{ asset('storage/' . $file) }}" class="img-fluid rounded">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                @else
                    <p class="text-muted mb-0">-</p>
                @endif
            </div>
        </div>


        <a href="{{ route('riwayat_penyaluran.index') }}" class="btn btn-secondary">
            Kembali
        </a>
    </div>
@endsection
