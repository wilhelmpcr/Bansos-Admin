@extends('layouts.admin.app')

@section('content')
<h3>Detail Kelahiran</h3>

<p><b>Nama Bayi:</b> {{ $data->nama_bayi }}</p>
<p><b>Nama Ibu:</b> {{ $data->nama_ibu }}</p>
<p><b>Tanggal Lahir:</b> {{ $data->tanggal_lahir }}</p>
<p><b>Tempat Lahir:</b> {{ $data->tempat_lahir }}</p>

<h4>Media Terlampir</h4>

@foreach($media as $m)
    @if(str_contains($m->mime_type,'image'))
        <img src="{{ asset('uploads/peristiwa_kelahiran/'.$m->file_name) }}" width="200" class="m-2">
    @else
        <a href="{{ asset('uploads/peristiwa_kelahiran/'.$m->file_name) }}" target="_blank">{{ $m->file_name }}</a><br>
    @endif
@endforeach
@endsection
