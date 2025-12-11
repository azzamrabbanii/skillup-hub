<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // --- FITUR REGISTER ---

    // 1. Tampilkan Form Register
    public function showRegister()
    {
        return view('auth.register');
    }

    // 2. Proses Simpan User Baru
    public function register(Request $request)
    {
        // Validasi Input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users', // Email gak boleh kembar
            'password' => 'required|min:6|confirmed', // Harus ada field password_confirmation di view
        ]);

        // Simpan ke Database
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Password wajib di-hash
            'role' => 'student', // Default user baru adalah Student
        ]);

        // Redirect ke halaman login dengan pesan sukses
        return redirect()->route('login')->with('success', 'Registration successful! Please login.');
    }

    // --- FITUR LOGIN ---

    // 3. Tampilkan Form Login
    public function showLogin()
    {
        return view('auth.login');
    }

    // 4. Proses Login
    public function login(Request $request)
    {
        // Validasi
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Coba Login (Auth::attempt akan otomatis cek hash password)
        if (Auth::attempt($request->only('email', 'password'))) {
            $request->session()->regenerate();

            $user = Auth::user();

            // CEK ROLE & REDIRECT
            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard')->with('success', 'Welcome Admin!');
            } elseif ($user->role === 'instructor') {
                return redirect()->route('instructor.dashboard')->with('success', 'Welcome Instructor!');
            } else {
                // Student
                return redirect()->route('home')->with('success', 'Welcome back to SkillUp Hub!');
            }
        }

        // Jika Gagal
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    // --- FITUR LOGOUT ---
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'You have logged out.');
    }
}
