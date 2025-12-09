<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    // Tampilkan halaman login
    public function showLogin()
    {
        return view('pages.auth.login-form');
    }

    // Proses login
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => ['required', 'min:3', 'regex:/[A-Z]/'],
        ]);

        if (Auth::attempt(['name' => $request->username, 'password' => $request->password])) {
            $request->session()->regenerate();
            $user = Auth::user();

            return match ($user->role) {
                'admin'  => redirect()->route('admin.dashboard')
                                ->with('success', 'Selamat datang Admin '.$user->name),
                default  => redirect()->route('user.dashboard')
                                ->with('success', 'Selamat datang '.$user->name),
            };
        }

        return back()->with('error','Username atau password salah.');
    }

    // Tampilkan halaman register
    public function showRegister()
    {
        return view('pages.auth.register-form');
    }

    // Proses register
    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|string|unique:users,name',
            'email'    => 'required|email|unique:users,email',
            'password' => ['required', 'min:3', 'regex:/[A-Z]/'],
        ]);

        $user = User::create([
            'name'     => $request->username,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => 'user',
        ]);

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('user.dashboard')
                         ->with('success', 'Selamat datang '.$user->name);
    }

    // Logout user
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')
                         ->with('success', 'Logout berhasil.');
    }
}
