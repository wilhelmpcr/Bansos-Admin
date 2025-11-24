<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Tampilkan semua data user (dengan pagination + filter).
     */
    public function index(Request $request)
    {
        // Kolom untuk pencarian teks
        $searchableColumns = ['name', 'email'];

        $users = User::query()
            ->search($request, $searchableColumns);

        // Filter email domain (gmail saja)
        if ($request->email_domain == 'gmail') {
            $users->where('email', 'like', '%@gmail.com');
        }

        $users = $users->paginate(10)->withQueryString();

        return view('pages.user.index', compact('users'));
    }
    /**
     * Tampilkan form tambah user.
     */
    public function create()
    {
        return view('pages.user.create');
    }

    /**
     * Simpan user baru ke database (password otomatis di-hash).
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email', // ⬅️ TIDAK pakai $id di sini
            'gender'   => 'required|in:male,female',
            'password' => 'required|string|min:6|confirmed', // ⬅️ wajib isi password saat create
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'gender'   => $request->gender,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('user.index')->with('success', 'User berhasil ditambahkan!');
    }

    /**
     * Tampilkan form edit user.
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);

        return view('pages.user.edit', compact('user'));
    }

    /**
     * Update data user (password hanya diubah jika diisi).
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email,' . $id,
            'gender'   => 'required|in:male,female',
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        $data = [
            'name'   => $request->name,
            'email'  => $request->email,
            'gender' => $request->gender,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('user.index')->with('success', 'User berhasil diperbarui!');
    }

    /**
     * Hapus user.
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('user.index')->with('success', 'Data user berhasil dihapus');
    }
}
