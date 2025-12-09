@extends('layouts.admin.app')

@section('content')
<div class="container py-4">
    <h3>Media Warga : {{ $warga->nama }}</h3>

    <a href="{{ route('media.create', $warga->warga_id) }}" class="btn btn-primary mb-3">
        Upload File
    </a>

    @if($warga->media->count())
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>File</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($warga->media as $m)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>
                    <a target="_blank" href="{{ asset('storage/'.$m->file_url) }}">
                        Lihat File
                    </a>
                </td>
                <td>
                    <form action="{{ route('media.destroy', [$warga->warga_id, $m->id]) }}"
                          method="POST">
                        @csrf @method('DELETE')
                        <button class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
        <p>Belum ada media.</p>
    @endif
</div>
@endsection
