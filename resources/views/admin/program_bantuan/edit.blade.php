<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Program Bantuan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-4">
    <h2 class="mb-4 text-center">Edit Program Bantuan</h2>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('program_bantuan.update', $program->program_id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="kode" class="form-label">Kode Program</label>
                    <input type="text" name="kode" id="kode" class="form-control" value="{{ old('kode', $program->kode) }}" required>
                    @error('kode') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="mb-3">
                    <label for="nama_program" class="form-label">Nama Program</label>
                    <input type="text" name="nama_program" id="nama_program" class="form-control" value="{{ old('nama_program', $program->nama_program) }}" required>
                    @error('nama_program') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="mb-3">
                    <label for="tahun" class="form-label">Tahun</label>
                    <input type="number" name="tahun" id="tahun" class="form-control" min="2000" max="2100" value="{{ old('tahun', $program->tahun) }}" required>
                    @error('tahun') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi</label>
                    <textarea name="deskripsi" id="deskripsi" class="form-control" rows="3">{{ old('deskripsi', $program->deskripsi) }}</textarea>
                    @error('deskripsi') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="mb-3">
                    <label for="anggaran" class="form-label">Anggaran (Rp)</label>
                    <input type="number" name="anggaran" id="anggaran" class="form-control" step="0.01" min="0" value="{{ old('anggaran', $program->anggaran) }}" required>
                    @error('anggaran') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="text-end">
                    <a href="{{ route('program_bantuan.index') }}" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-success">Perbarui</button>
                </div>
            </form>
        </div>
    </div>
</div>

</body>
</html>
