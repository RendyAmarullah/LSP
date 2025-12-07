<?php

namespace App\Http\Controllers;

use App\Models\Calon_Mahasiswa;
use App\Models\Pengumuman;
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
        // Ambil pengumuman terbaru
        $user = Auth::user();
        $status= $user->status;
        
        $pengumuman = Pengumuman::latest()->get(); 

        // Kirim variabel $pengumuman ke view dashboard
        return view('dashboard', compact('pengumuman','status')); 
    }

    public function pengumuman()
    {
        $pengumuman = Pengumuman::latest()->get();

        return view('admin.dashboard', compact('pengumuman'));
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
            $user = Auth::user(); // Ambil data user yang sedang login

            // 3. Cek Role & Redirect Sesuai Role
            if ($user->role === 'admin') {
                // Jika Admin, arahkan ke URL dashboard admin
                return redirect()->intended('/admin/dashboard')->with('success', 'Selamat datang Admin!');
            } 
            
            if ($user->role === 'mahasiswa') {
                // Jika Mahasiswa, arahkan ke URL dashboard biasa
                return redirect()->intended('/dashboard')->with('success', 'Selamat datang Mahasiswa!');
            }

            // Jika role tidak dikenali, paksa logout
            Auth::logout();
            throw ValidationException::withMessages([
                'email' => ['Akun Anda tidak memiliki hak akses yang valid.'],
            ]);
        }

        // 4. Kembali ke form login dengan error jika password salah
        throw ValidationException::withMessages([
            'email' => ['Email atau password yang Anda masukkan tidak valid.'],
        ]);
    }
        
}
