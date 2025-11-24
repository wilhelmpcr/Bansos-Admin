@extends('layouts.admin.app')

@section('content')
<div class="container">
    <h1>Data Pendaftar Bantuan</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('pendaftar_bantuan.create') }}" class="btn btn-primary mb-3">
        + Tambah Pendaftar
    </a>

    <div class="table-responsive">
      <form method="GET" action="{{ route('pendaftar_bantuan.index') }}" class="mb-3">
          <div class="row">
              {{-- FILTER STATUS --}}
              <div class="col-md-3">
                  <select name="status_seleksi" class="form-select" onchange="this.form.submit()">
                      <option value="">Semua Status</option>
                      <option value="ditolak"   {{ request('status_seleksi')=='ditolak' ? 'selected' : '' }}>Ditolak</option>
                      <option value="diterima"  {{ request('status_seleksi')=='diterima' ? 'selected' : '' }}>Diterima</option>
                      <option value="dipending" {{ request('status_seleksi')=='dipending' ? 'selected' : '' }}>Dipending</option>
                  </select>
              </div>

              {{-- SEARCH + CLEAR --}}
              <div class="col-md-3">
                  <div class="input-group">
                      <input type="text"
                             name="search"
                             class="form-control"
                             id="exampleInputIconRight"
                             value="{{ request('search') }}"
                             placeholder="Search"
                             aria-label="Search">

                      <button type="submit" class="input-group-text" id="basic-addon2">
                          <svg class="icon icon-xxs" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                              <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path>
                          </svg>
                      </button>

                      @if(request('search'))
                          <a href="{{ request()->fullUrlWithQuery(['search' => null]) }}"
                             class="btn btn-outline-secondary ms-2"
                             id="clear-search">
                              Clear
                          </a>
                      @endif
                  </div>
              </div>
          </div>
      </form>

      <table class="table table-bordered table-striped">
          <thead>
              <tr>
                  <th>#</th>
                  <th>Nama Warga</th>
                  <th>Program Bantuan</th>
                  <th>Status Seleksi</th>
                  <th>Aksi</th>
              </tr>
          </thead>
          <tbody>
              @forelse($pendaftar as $index => $p)
                  <tr>
                      <td>{{ $pendaftar->firstItem() + $index }}</td>
                      <td>{{ $p->warga->nama ?? '-' }}</td>
                      <td>{{ $p->program->nama_program ?? '-' }}</td>
                      <td>{{ ucfirst($p->status_seleksi) }}</td>
                      <td>
                          <a href="{{ route('pendaftar_bantuan.edit', $p->pendaftar_id) }}" class="btn btn-sm btn-warning">
                              Edit
                          </a>

                          <form action="{{ route('pendaftar_bantuan.destroy', $p->pendaftar_id) }}"
                                method="POST"
                                style="display:inline-block"
                                onsubmit="return confirm('Yakin hapus data ini?');">
                              @csrf
                              @method('DELETE')
                              <button class="btn btn-sm btn-danger" type="submit">
                                  Hapus
                              </button>
                          </form>
                      </td>
                  </tr>
              @empty
                  <tr>
                      <td colspan="5" class="text-center">Belum ada pendaftar.</td>
                  </tr>
              @endforelse
          </tbody>
      </table>

      <div class="mt-3">
          {{ $pendaftar->links('pagination::bootstrap-5') }}
      </div>
    </div>
</div>
@endsection
