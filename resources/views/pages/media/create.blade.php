@extends('layouts.admin.app')

@section('content')
<div class="container py-4">
    <h3>Upload Media Warga: {{ $warga->nama }}</h3>

    <form action="{{ route('media.store', $warga->warga_id) }}"
          method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label>Upload File</label>
            <input type="file" name="file" class="form-control" required>
        </div>

        <button class="btn btn-success">Upload</button>
        <a href="{{ route('media.index', $warga->warga_id) }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
