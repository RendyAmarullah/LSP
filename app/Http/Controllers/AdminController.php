<?php

namespace App\Http\Controllers;

use App\Models\Calon_Mahasiswa;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
       
        $users = User::where('role', 'mahasiswa')->paginate(10);
        

        return view('admin.akun', compact('users'));
    }

    
    
    public function validasiUser($id)
    {
        $user = User::findOrFail($id);
        
        
        $user->status= 'tervalidasi';
        $user->save();

        return redirect()->back()->with('success', 'Akun mahasiswa berhasil divalidasi!');
    }

   
    public function tolakUser($id)
    {
        $user = User::findOrFail($id);
        
        // Pastikan nama kolom sesuai database (misal: 'status' atau 'status_pendaftaran')
        $user->status = 'ditolak'; 
        $user->save();
    
        return redirect()->back()->with('error', 'Pendaftaran mahasiswa telah ditolak.');
    }
}
