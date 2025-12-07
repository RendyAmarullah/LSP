<?php

namespace App\Http\Controllers;

use App\Models\Pengumuman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    // PASTIKAN NAMA METHOD ADALAH 'dashboard' (sesuai yang dipanggil di rute)
    public function dashboard()
    {
        // Logika untuk menampilkan dashboard (misalnya, me-return view)
        return view('dashboard');
    }
    
    public function index()
{
    
    $user = Auth::user();
    
    
    $status_akun = $user->status; 
    
    $pengumuman = Pengumuman::all();

    return view('dashboard', compact('pengumuman', 'status'));
}
}