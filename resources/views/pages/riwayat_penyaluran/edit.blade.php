@extends('layouts.admin.app')

@section('content')
<div class="container mt-4">
    <h3>Edit Riwayat Penyaluran</h3>

    <form action="{{ route('riwayat_penyaluran.update', $riwayat->penyaluran_id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Input sama seperti create.blade.php, tapi pakai value -->
        <div class="mb-3">
            <label>Pendaftar Bantuan</label>
            <select name="pendaftar_id" class="form-control" required>
                <option value="">-- Pilih Pendaftar --</option>
                @foreach($pendaftars as $d)
                    <option value="{{ $d->pendaftar_id }}" {{ $d->pendaftar_id == $riwayat->pendaftar_id ? 'selected' : '' }}>
                        {{ $d->warga->nama ?? 'N/A' }} -
                        {{ $d->program->nama_program ?? 'N/A' }}
                        ({{ $d->status_seleksi ?? 'pending' }})
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Tanggal Penyaluran</label>
            <input type="date" name="tanggal" class="form-control" value="{{ $riwayat->tanggal }}" required>
        </div>

        <div class="mb-3">
            <label>Jumlah Bantuan</label>
            <input type="number" name="jumlah" class="form-control" step="0.01" value="{{ $riwayat->jumlah }}" required>
        </div>

        <div class="mb-3">
            <label>Keterangan</label>
            <textarea name="keterangan" class="form-control" rows="3">{{ $riwayat->keterangan }}</textarea>
        </div>

        <div class="mb-3">
            <label>Status</label>
            <select name="status" class="form-control" required>
                <option value="draft" {{ $riwayat->status == 'draft' ? 'selected' : '' }}>Draft</option>
                <option value="diproses" {{ $riwayat->status == 'diproses' ? 'selected' : '' }}>Diproses</option>
                <option value="selesai" {{ $riwayat->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                <option value="dibatalkan" {{ $riwayat->status == 'dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Bukti Penyaluran (opsional)</label>
            <input type="file" name="file" class="form-control" accept=".jpg,.jpeg,.png,.pdf">
            @if($riwayat->dokumen)
                <small class="text-muted">File saat ini:
                    @foreach(json_decode($riwayat->dokumen, true) as $doc)
                        <a href="{{ asset('storage/'.$doc) }}" target="_blank">{{ basename($doc) }}</a>
                    @endforeach
                </small>
            @endif
        </div>

        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        <a href="{{ route('riwayat_penyaluran.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
