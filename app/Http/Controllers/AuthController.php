<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Tampilkan form login
    public function showlogin()
    {
        return view('auth.login-form');
    }

    // Proses login
    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'username' => 'required',
            'password' => ['required', 'min:3', 'regex:/[A-Z]/']
        ], [
            'username.required' => 'Username wajib diisi.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 3 karakter.',
            'password.regex' => 'Password harus mengandung huruf kapital.'
        ]);

        // Cek user di database
        $user = User::where('name', $request->username)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            // Jika cocok, arahkan ke halaman sukses
            return redirect()->route('admin.dashboard')->with('username', $user->name);
        }

        return back()->with('error', 'Username atau password salah.');
    }

    // Halaman sukses login
    public function loginSuccess()
    {
        $username = session('username');
        if (!$username) {
            return redirect()->route('login.form')->with('error', 'Silakan login terlebih dahulu.');
        }
        return view('auth.login-success', compact('username'));
        return redirect()->route('login.success')->with('username', $user->name);
    }

    // Tampilkan form register
    public function showRegister()
    {
        return view('auth.register-form');
    }

    // Proses register
    public function register(Request $request)
    {
        // Validasi input
        $request->validate([
            'username' => 'required|unique:users,name',
            'email' => 'required|email|unique:users,email',
            'password' => ['required', 'min:3', 'regex:/[A-Z]/']
        ], [
            'username.required' => 'Username wajib diisi.',
            'username.unique' => 'Username sudah digunakan.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah terdaftar.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 3 karakter.',
            'password.regex' => 'Password harus mengandung huruf kapital.'
        ]);

        // Simpan user baru
        User::create([
            'name' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        return redirect()->route('register.success')->with('username', $request->username);
    }

    // Halaman sukses register
    public function registerSuccess()
    {
        $username = session('username');
        return view('auth.register-success', compact('username'));
    }
}
