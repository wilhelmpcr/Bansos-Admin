@extends('layouts.admin.app')

@section('content')
    <div class="container mt-4">
        <h3>Edit Riwayat Penyaluran</h3>

        <form action="{{ route('riwayat_penyaluran.update', $riwayat->penyaluran_id) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- Pendaftar --}}
            <div class="mb-3">
                <label class="form-label">Pendaftar Bantuan</label>
                <select name="pendaftar_id" class="form-control" required>
                    <option value="">-- Pilih Pendaftar --</option>
                    @foreach ($pendaftars as $d)
                        <option value="{{ $d->pendaftar_id }}"
                            {{ $d->pendaftar_id == $riwayat->pendaftar_id ? 'selected' : '' }}>
                            {{ $d->warga->nama ?? 'N/A' }} -
                            {{ $d->program->nama_program ?? 'N/A' }}
                            ({{ $d->status_seleksi }})
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Tanggal --}}
            <div class="mb-3">
                <label class="form-label">Tanggal Penyaluran</label>
                <input type="date" name="tanggal" class="form-control" value="{{ $riwayat->tanggal?->format('Y-m-d') }}"
                    required>
            </div>

            {{-- Jumlah --}}
            <div class="mb-3">
                <label class="form-label">Jumlah Bantuan</label>
                <input type="number" name="jumlah" class="form-control" step="0.01" value="{{ $riwayat->jumlah }}"
                    required>
            </div>

            {{-- Keterangan --}}
            <div class="mb-3">
                <label class="form-label">Keterangan</label>
                <textarea name="keterangan" class="form-control" rows="3">{{ $riwayat->keterangan }}</textarea>
            </div>

            {{-- Status --}}
            <div class="mb-3">
                <label class="form-label">Status</label>
                <select name="status" class="form-control" required>
                    <option value="draft" {{ $riwayat->status === 'draft' ? 'selected' : '' }}>Draft</option>
                    <option value="diproses" {{ $riwayat->status === 'diproses' ? 'selected' : '' }}>Diproses</option>
                    <option value="selesai" {{ $riwayat->status === 'selesai' ? 'selected' : '' }}>Selesai</option>
                    <option value="dibatalkan" {{ $riwayat->status === 'dibatalkan' ? 'selected' : '' }}>Dibatalkan
                    </option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Bukti Penyaluran (opsional)</label>
                <input type="file" name="file" class="form-control" accept=".jpg,.jpeg,.png,.pdf">

                @if (!empty($riwayat->dokumen))
                    <div class="mt-3">
                        <label class="form-label">File saat ini:</label>
                        <div class="d-flex gap-3 flex-wrap">
                            @foreach ($riwayat->dokumen as $doc)
                                @if (Str::endsWith($doc, ['jpg', 'jpeg', 'png']))
                                    <div class="text-center">
                                        <img src="{{ asset('storage/' . $doc) }}" class="img-thumbnail"
                                            style="width:120px;height:120px;object-fit:cover">
                                        <div class="small text-muted mt-1">
                                            {{ basename($doc) }}
                                        </div>
                                    </div>
                                @else
                                    <a href="{{ asset('storage/' . $doc) }}" target="_blank"
                                        class="btn btn-outline-secondary btn-sm">
                                        📄 {{ basename($doc) }}
                                    </a>
                                @endif
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>


            {{-- Tombol --}}
            <div class="mt-4">
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                <a href="{{ route('riwayat_penyaluran.index') }}" class="btn btn-secondary">
                    Kembali
                </a>
            </div>
        </form>
    </div>
@endsection
