<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'identifier' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        $field = filter_var($request->identifier, FILTER_VALIDATE_EMAIL) ? 'email' : 'nim';
        $credentials = [
            $field => $request->identifier,
            'password' => $request->password,
        ];

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            if (!Auth::user()->is_active) {
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                return back()->withErrors([
                    'identifier' => 'Akun Anda telah dinonaktifkan oleh petugas.',
                ])->onlyInput('identifier');
            }

            if (Auth::user()->role === 'petugas') {
                return redirect()->intended(route('petugas.dashboard'));
            }

            return redirect()->intended(route('home'));
        }

        return back()->withErrors([
            'identifier' => 'NIM/Email atau password salah.',
        ])->onlyInput('identifier');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'nim' => ['required', 'string', 'max:20', 'unique:pengguna,nim'],
            'no_hp' => ['required', 'string', 'max:20'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);

        $user = User::create([
            'nama' => $validated['nama'],
            'nim' => $validated['nim'],
            'no_hp' => $validated['no_hp'],
            'password' => $validated['password'],
            'role' => 'mahasiswa',
            'is_active' => true,
        ]);

        Auth::login($user);

        return redirect()->route('home')->with('success', 'Registrasi berhasil. Selamat datang di FindIT UNEJ.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home')->with('success', 'Anda telah keluar.');
    }
}