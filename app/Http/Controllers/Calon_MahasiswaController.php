<?php

namespace App\Http\Controllers;

use App\Models\Calon_Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Calon_MahasiswaController extends Controller
{
    public function index()
    {
        // Ambil data terbaru, 10 per halaman
        $pendaftar = Calon_Mahasiswa::orderBy('created_at', 'desc')->paginate(10);

        return view('admin.calonmahasiswa', compact('pendaftar'));
    }
        public function showProfil()
    {
        // Ambil data calon mahasiswa berdasarkan email user yang sedang login
        $userId = Auth::id();
        $data = Calon_Mahasiswa::where('user_id', $userId)->first();

        // Jika data belum ada (belum mengisi form), bisa diarahkan ke form pendaftaran
        if(!$data) {
            return redirect('/pendaftaranmahasiswa')->with('warning', 'Silakan isi formulir pendaftaran terlebih dahulu.');
        }

        return view('profile', compact('data'));
    }
}
