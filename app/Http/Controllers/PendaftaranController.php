<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PendaftaranController extends Controller
{
     public function dashboard()
    {
        // Logika untuk menampilkan dashboard (misalnya, me-return view)
        return view('pendaftaran');
    }
    public function logout(Request $request)
    {
        Auth::logout(); // Logout pengguna saat ini

        $request->session()->invalidate(); // Hapus sesi
        $request->session()->regenerateToken(); // Buat ulang token CSRF

        // Arahkan pengguna ke landing page (/)
        return redirect('/'); 
    }
}
