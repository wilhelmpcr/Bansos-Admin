@extends('layouts.admin.app')

@section('content')
<div class="container">

    <h3 class="mb-4">Tambah Penerima Bantuan</h3>

    {{-- TAMPILKAN ERROR VALIDASI --}}
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
            <form action="{{ route('penerima-bantuan.store') }}" method="POST">
                @csrf

                {{-- WARGA --}}
                <div class="mb-3">
                    <label class="form-label">Warga</label>
                    <select name="warga_id" class="form-select" required>
                        <option value="">-- Pilih Warga --</option>
                        @foreach($warga as $w)
                            <option value="{{ $w->warga_id }}"
                                {{ old('warga_id') == $w->warga_id ? 'selected' : '' }}>
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
                                {{ old('program_id') == $p->program_id ? 'selected' : '' }}>
                                {{ $p->nama_program }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- KETERANGAN --}}
                <div class="mb-3">
                    <label class="form-label">Keterangan</label>
                    <textarea name="keterangan"
                              class="form-control"
                              rows="3"
                              placeholder="Opsional">{{ old('keterangan') }}</textarea>
                </div>

                <button type="submit" class="btn btn-success">
                    Simpan
                </button>

                <a href="{{ route('penerima-bantuan.index') }}" class="btn btn-secondary">
                    Kembali
                </a>
            </form>
        </div>
    </div>

</div>
@endsection
