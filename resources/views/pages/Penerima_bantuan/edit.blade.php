@extends('layouts.admin.app')

@section('content')
<div class="container">

    <h3 class="mb-4">Edit Penerima Bantuan</h3>

    {{-- ERROR VALIDASI --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <form action="{{ route('penerima_bantuan.update', $data->penerima_id) }}"
                  method="POST"
                  enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- WARGA --}}
                <div class="mb-3">
                    <label class="form-label">Warga</label>
                    <select name="warga_id" class="form-select" required>
                        <option value="">-- Pilih Warga --</option>
                        @foreach($warga as $w)
                            <option value="{{ $w->warga_id }}"
                                {{ old('warga_id', $data->warga_id) == $w->warga_id ? 'selected' : '' }}>
                                {{ $w->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- PROGRAM --}}
                <div class="mb-3">
                    <label class="form-label">Program Bantuan</label>
                    <select name="program_id" class="form-select" required>
                        <option value="">-- Pilih Program --</option>
                        @foreach($program as $p)
                            <option value="{{ $p->program_id }}"
                                {{ old('program_id', $data->program_id) == $p->program_id ? 'selected' : '' }}>
                                {{ $p->nama_program }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- KETERANGAN --}}
                <div class="mb-3">
                    <label class="form-label">Keterangan</label>
                    <textarea name="keterangan" class="form-control" rows="3">{{ old('keterangan', $data->keterangan) }}</textarea>
                </div>

                {{-- FOTO --}}
                <div class="mb-3">
                    <label class="form-label">Foto Penerima Bantuan</label>
                    <input type="file" name="foto" class="form-control" accept="image/*">
                    <small class="text-muted">Format: JPG, PNG (Max 2MB)</small>
                </div>

                {{-- PREVIEW FOTO LAMA --}}
                @if ($data->foto)
                    <div class="mb-3">
                        <label class="form-label">Foto Saat Ini</label><br>
                        <img src="{{ asset('storage/' . $data->foto) }}"
                             class="img-thumbnail"
                             style="width:150px;height:150px;object-fit:cover;">
                    </div>
                @endif

                <button type="submit" class="btn btn-primary">
                    Update
                </button>

                <a href="{{ route('penerima_bantuan.index') }}" class="btn btn-secondary">
                    Kembali
                </a>
            </form>
        </div>
    </div>

</div>
@endsection
