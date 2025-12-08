<?php

namespace App\Http\Controllers;

use App\Models\Pengumuman;
use App\Models\User;
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
    public function updateAkun(Request $request)
        {
            $user = Auth::user();

            // 1. Validasi Input
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email,' . $user->id, 
            ]);

            // 2. Update Data di Tabel Users
          
            $userModel = User::find($user->id);
            $userModel->name = $request->name;
            $userModel->email = $request->email;
            $userModel->status = 'pending';
            $userModel->save();

            return redirect()->back()->with('success', 'Data akun berhasil diperbarui! Menunggu verifikasi ulang.');
        }
    }