<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $searchableColumns = ['name', 'email'];

        $users = User::query()->search($request, ['name', 'email']);

// Filter email domain
        if ($request->email_domain == 'gmail') {
            $users->where('email', 'like', '%@gmail.com');
        } elseif ($request->email_domain == 'example') {
            $users->where('email', 'like', '%@example.com');
        }

// Filter role
        if ($request->role) {
            $users->where('role', $request->role);
        }

        $users = $users->paginate(10)->withQueryString();

        return view('pages.user.index', compact('users'));
    }

    public function create()
    {
        return view('pages.user.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'gender'   => 'required|in:male,female',
            'password' => 'required|string|min:6|confirmed',
            'role'     => 'required|in:user,admin', // ⬅️ validasi role
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'gender'   => $request->gender,
            'password' => Hash::make($request->password),
            'role'     => $request->role, // ⬅️ simpan role
        ]);

        return redirect()->route('user.index')->with('success', 'User berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('pages.user.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email,' . $id,
            'gender'   => 'required|in:male,female',
            'password' => 'nullable|string|min:6|confirmed',
            'role'     => 'required|in:user,admin', // ⬅️ validasi role
        ]);

        $data = [
            'name'   => $request->name,
            'email'  => $request->email,
            'gender' => $request->gender,
            'role'   => $request->role, // ⬅️ update role
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('user.index')->with('success', 'User berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('user.index')->with('success', 'Data user berhasil dihapus');
    }
        public function show($id)
    {
        $user = User::findOrFail($id);
        return view('pages.user.show', compact('user'));
    }

}
