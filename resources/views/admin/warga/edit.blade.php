<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Warga</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <h2 class="text-center mb-4">Edit Data Warga</h2>

<form action="{{ route('warga.update', $warga->warga_id) }}" method="POST">
    @csrf
    @method('PUT')



        <div class="mb-3">
            <label>No KTP</label>
            <input type="text" name="no_ktp" value="{{ $warga->no_ktp }}" class="form-control" required maxlength="16">
        </div>

        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="nama" value="{{ $warga->nama }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Jenis Kelamin</label>
            <select name="jenis_kelamin" class="form-select" required>
                <option value="L" {{ $warga->jenis_kelamin == 'L' ? 'selected' : '' }}>Laki-Laki</option>
                <option value="P" {{ $warga->jenis_kelamin == 'P' ? 'selected' : '' }}>Perempuan</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Agama</label>
            <input type="text" name="agama" value="{{ $warga->agama }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Pekerjaan</label>
            <input type="text" name="pekerjaan" value="{{ $warga->pekerjaan }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Telp</label>
            <input type="text" name="telp" value="{{ $warga->telp }}" class="form-control">
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" value="{{ $warga->email }}" class="form-control">
        </div>

        <div class="text-end">
            <a href="{{ route('warga.index') }}" class="btn btn-secondary">Batal</a>
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </form>
</div>
</body>
</html>
