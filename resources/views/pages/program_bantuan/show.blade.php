@extends('layouts.admin.app')

@section('content')
<div class="bg-light">
<div class="container py-4">

    <h2 class="mb-4 text-center">Detail Program Bantuan</h2>

    <div class="card shadow-sm">
        <div class="card-body">

            <table class="table table-borderless">
                <tr>
                    <th width="30%">Kode Program</th>
                    <td>{{ $program->kode }}</td>
                </tr>
                <tr>
                    <th>Nama Program</th>
                    <td>{{ $program->nama_program }}</td>
                </tr>
                <tr>
                    <th>Tahun</th>
                    <td>{{ $program->tahun }}</td>
                </tr>
                <tr>
                    <th>Deskripsi</th>
                    <td>{{ $program->deskripsi ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Anggaran</th>
                    <td>
                        Rp {{ number_format($program->anggaran, 0, ',', '.') }}
                    </td>
                </tr>
                <tr>
                    <th>Dibuat</th>
                    <td>{{ $program->created_at->format('d M Y') }}</td>
                </tr>
            </table>

            <div class="text-end">
                <a href="{{ route('program_bantuan.index') }}" class="btn btn-secondary">
                    Kembali
                </a>
                <a href="{{ route('program_bantuan.edit', $program->id) }}" class="btn btn-warning">
                    Edit
                </a>
            </div>

        </div>
    </div>

</div>
</div>
@endsection
