@extends('layouts.admin.app')

@section('content')
<body class="bg-light">
<div class="container py-4">
    <h2>Edit Media</h2>

    <div class="card p-4 shadow-sm">

        <form action="{{ route('media.update', $media->media_id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label>Ref Table</label>
                <input type="text" name="ref_table" value="{{ $media->ref_table }}" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Ref ID</label>
                <input type="text" name="ref_id" value="{{ $media->ref_id }}" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>File Saat Ini</label><br>
                @if($media->file_url)
                    <a href="{{ asset('storage/'.$media->file_url) }}" target="_blank">Lihat File</a>
                @else
                    <span class="text-danger">Tidak ada file</span>
                @endif
            </div>

            <div class="mb-3">
                <label>Upload File Baru (opsional)</label>
                <input type="file" name="file" class="form-control">
            </div>

            <button class="btn btn-primary">Update</button>
            <a href="{{ route('media.index') }}" class="btn btn-secondary">Kembali</a>
        </form>

    </div>
</div>
</body>
@endsection
