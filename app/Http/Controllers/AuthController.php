<?php

namespace App\Http\Controllers;

use App\Models\Calon_Mahasiswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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
        return redirect('/cekstatusakun')->with('success', 'Registrasi berhasil! Silakan cek status akun Anda.');
    }
    public function statusAkun()
    {
        return view('cekstatusakun');
    }
}
