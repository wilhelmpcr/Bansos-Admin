<?php
namespace App\Http\Controllers;

use App\Models\PenerimaBantuan;
use App\Models\ProgramBantuan;
use App\Models\Warga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class PenerimaBantuanController extends Controller
{
    // ===============================
    // INDEX
    // ===============================
    public function index(Request $request)
    {
        $dataPenerima = PenerimaBantuan::with(['warga', 'program'])
            ->filter($request, ['program_id', 'warga_id'])
            ->search($request, ['keterangan'])
            ->paginate(10)
            ->withQueryString();

        return view('pages.penerima_bantuan.index', [
            'dataPenerima' => $dataPenerima,
            'warga'        => Warga::all(),
            'program'      => ProgramBantuan::all(),
        ]);
    }

    // ===============================
    // CREATE
    // ===============================
    public function create()
    {
        return view('pages.penerima_bantuan.create', [
            'warga'   => Warga::all(),
            'program' => ProgramBantuan::all(),
        ]);
    }

    // ===============================
    // STORE
    // ===============================
    public function store(Request $request)
    {
        $data = $request->validate([
            'warga_id'   => [
                'required',
                'exists:warga,warga_id',
                Rule::unique('penerima_bantuan')
                    ->where(fn($q) => $q->where('program_id', $request->program_id)),
            ],
            'program_id' => 'required|exists:program_bantuan,program_id',
            'keterangan' => 'nullable|string',
            'foto'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // upload foto jika ada
        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('penerima', 'public');
        }

        PenerimaBantuan::create($data);

        return redirect()
            ->route('penerima_bantuan.index')
            ->with('success', 'Data penerima bantuan berhasil ditambahkan');
    }

    // ===============================
    // SHOW
    // ===============================
    public function show($id)
    {
        $data = PenerimaBantuan::with(['warga', 'program'])
            ->findOrFail($id);

        return view('pages.penerima_bantuan.show', compact('data'));
    }

    // ===============================
    // EDIT
    // ===============================
    public function edit($id)
    {
        return view('pages.penerima_bantuan.edit', [
            'data'    => PenerimaBantuan::findOrFail($id),
            'warga'   => Warga::all(),
            'program' => ProgramBantuan::all(),
        ]);
    }

    // ===============================
    // UPDATE
    // ===============================
    public function update(Request $request, $id)
    {
        $request->validate([
            'warga_id'   => 'required|exists:warga,warga_id',
            'program_id' => 'required|exists:program_bantuan,program_id',
            'keterangan' => 'nullable|string',
            'foto'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = PenerimaBantuan::findOrFail($id);

        $input = $request->except('foto');

        if ($request->hasFile('foto')) {

            // hapus foto lama
            if ($data->foto && Storage::disk('public')->exists($data->foto)) {
                Storage::disk('public')->delete($data->foto);
            }

            // simpan foto baru
            $input['foto'] = $request->file('foto')->store('penerima', 'public');
        }

        $data->update($input);

        return redirect()
            ->route('penerima_bantuan.index')
            ->with('success', 'Data penerima bantuan berhasil diperbarui');
    }

    // ===============================
    // DESTROY
    // ===============================
    public function destroy($id)
    {
        PenerimaBantuan::findOrFail($id)->delete();

        return redirect()
            ->route('penerima_bantuan.index')
            ->with('success', 'Data penerima bantuan berhasil dihapus');
    }
}
