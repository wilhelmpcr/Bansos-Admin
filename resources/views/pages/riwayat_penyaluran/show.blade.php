@extends('layouts.admin.app')

@section('content')
<div class="container mt-4">
    <h3>Detail Riwayat Penyaluran</h3>

    <table class="table table-bordered">
        <tr>
            <th>Pendaftar</th>
            <td>{{ $riwayat->pendaftar->warga->nama ?? 'N/A' }}</td>
        </tr>
        <tr>
            <th>Program</th>
            <td>{{ $riwayat->pendaftar->program->nama_program ?? 'N/A' }}</td>
        </tr>
        <tr>
            <th>Tanggal</th>
            <td>{{ $riwayat->tanggal }}</td>
        </tr>
        <tr>
            <th>Jumlah</th>
            <td>{{ number_format($riwayat->jumlah, 2) }}</td>
        </tr>
        <tr>
            <th>Status</th>
            <td>{{ ucfirst($riwayat->status) }}</td>
        </tr>
        <tr>
            <th>Keterangan</th>
            <td>{{ $riwayat->keterangan }}</td>
        </tr>
        <tr>
            <th>Dokumen</th>
            <td>
                @if($riwayat->dokumen)
                    @foreach(json_decode($riwayat->dokumen, true) as $doc)
                        <a href="{{ asset('storage/'.$doc) }}" target="_blank">{{ basename($doc) }}</a><br>
                    @endforeach
                @else
                    -
                @endif
            </td>
        </tr>
    </table>

    <a href="{{ route('riwayat_penyaluran.index') }}" class="btn btn-secondary">Kembali</a>
</div>
@endsection
