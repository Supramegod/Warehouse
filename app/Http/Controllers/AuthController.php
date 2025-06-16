<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Tampilkan halaman login & register
    public function showLoginForm()
    {
        return view('auth.login'); // pastikan view ini ada
    }

    // Proses login
    public function login(Request $request)
{
    $request->validate([
        'login' => ['required', 'string'], // Bisa username atau email
        'password' => ['required'],
    ]);

    $login_type = filter_var($request->login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

    $credentials = [
        $login_type => $request->login,
        'password' => $request->password,
    ];

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();

        $user = Auth::user();
        if ($user->role === 'admin' || $user->role === 'staff') {
            return redirect()->intended('/');
        }

        Auth::logout();
        return back()->withErrors([
            'login' => 'Anda tidak memiliki akses.',
        ])->onlyInput('login');
    }

    return back()->withErrors([
        'login' => 'Username/email atau password salah.',
    ])->onlyInput('login');
}

    public function showRegistrationForm()
{
    return view('auth.register');
}

    // Proses registrasi
    public function register(Request $request)
{
    $data = $request->validate([
        'name' => ['required','string','max:255'],
        'username' => ['required','string','max:255','unique:users,username'],
        'email' => ['required','email','max:255','unique:users,email'],
        'password' => ['required','confirmed','min:6'],
    ]);

    $user = User::create([
        'name' => $data['name'],
        'username' => $data['username'],
        'email' => $data['email'],
        'password' => Hash::make($data['password']),
        'role' => 'staff', // default role
    ]);

    Auth::login($user);
    return redirect('/');
}


    // Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}