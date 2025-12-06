<?php

namespace App\Http\Controllers;

use App\Models\Calon_Mahasiswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
class AuthController extends Controller
{

    public function showRegisterForm()
    {
        return view ('auth.pendaftaran');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name'=> 'required|string|max:255',
            'email'=> 'required|string|email|max:255|unique:users',
            'password'=> 'required|string|min:8|confirmed'
        ]);

        DB::transaction(function()use($request){
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'mahasiswa',
            ]);
            // Calon_Mahasiswa::create([
            //     'user_id' => $user->id,
            //     'nama_lengkap' => $request->name,
            //     'status_pendaftaran' => 'Baru Mendaftar',
            //     'role' => 'mahasiswa'
            // ]);
            Auth::login($user);
        });
        return redirect('/dashboard')->with('success', 'Registrasi berhasil! Silakan cek status akun Anda.');
    }
    public function statusAkun()
    {
        return view('dashboard');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // 1. Validasi input
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // 2. Coba autentikasi
        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            
            $request->session()->regenerate();

            // 3. Cek Role (Opsional, tapi disarankan jika Anda memiliki Admin/Mahasiswa)
            if (Auth::user()->role !== 'mahasiswa') {
                 // Jika yang login bukan mahasiswa, logout dan beri pesan error
                 Auth::logout();
                 throw ValidationException::withMessages([
                    'email' => ['Akses ditolak untuk role ini.'],
                 ]);
            }
            
            // 4. Redirect ke dashboard jika berhasil
            return redirect()->intended('/dashboard')->with('success', 'Selamat datang! Anda berhasil login.');
        }

        // 5. Kembali ke form login dengan error jika gagal
        throw ValidationException::withMessages([
            'email' => ['Email atau password yang Anda masukkan tidak valid.'],
        ]);
    }

}
