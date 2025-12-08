<?php

namespace App\Http\Controllers;

use App\Models\Calon_Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Calon_MahasiswaController extends Controller
{
    public function index()
    {
       
        $pendaftar = Calon_Mahasiswa::orderBy('created_at', 'desc')->paginate(10);

        return view('admin.calonmahasiswa', compact('pendaftar'));
    }
        public function showProfil()
    {
       
        $userId = Auth::id();
        $data = Calon_Mahasiswa::where('user_id', $userId)->first();
        if(!$data) {
            return redirect('/pendaftaranmahasiswa')->with('warning', 'Silakan isi formulir pendaftaran terlebih dahulu.');
        }

        return view('profile', compact('data'));
    }
    public function updateStatus(Request $request, $id)
    {
        
        $pendaftar = Calon_Mahasiswa::findOrFail($id);

        
        $request->validate([
            'status' => 'required|in:tervalidasi,ditolak'
        ]);

        $pendaftar->status = $request->status;
        $pendaftar->save();
        $pesan = $request->status == 'tervalidasi' ? 'Mahasiswa berhasil diterima!' : 'Mahasiswa telah ditolak.';
        
        return redirect()->back()->with('success', $pesan);
    }
}
