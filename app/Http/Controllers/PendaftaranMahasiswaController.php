<?php

namespace App\Http\Controllers;

use App\Models\Calon_Mahasiswa;
use App\Models\Prodi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PendaftaranMahasiswaController extends Controller
{
    // Menampilkan Form
    public function create()
    {
        $prodis = Prodi::orderBy('fakultas')->orderBy('nama_prodi')->get()->groupBy('fakultas');
        return view('pendaftaranmahasiswa', compact('prodis'));
    }

   
    public function store(Request $request)
    {
        // 1. Validasi Input
        $request->validate([
            
            'nama_lengkap' => 'required|string|max:255',
            'email' => 'required|email|unique:calon_mahasiswas,email',
            'nomor_hp' => 'required|numeric',
            'agama'        => 'required|string',
            'jenis_kelamin'=> 'required|string',
            'tempat_lahir' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string',
            'asal_sekolah' => 'required|string',
            'jurusan_pilihan' => 'required|string',
            'foto_diri' => 'required|image|mimes:jpeg,png,jpg|max:2048', // Max 2MB
            
        ]);

        // 2. Proses Upload Gambar
        $pathFoto = null;
        if ($request->hasFile('foto_diri')) {
            // Simpan ke folder: storage/app/public/foto-maba
            $pathFoto = $request->file('foto_diri')->store('foto-maba', 'public');
        }

        $prodi = Prodi::where('nama_prodi', $request->jurusan_pilihan)->first();

        // Pastikan prodi ditemukan (opsional, untuk keamanan)
        if (!$prodi) {
            return back()->withErrors(['jurusan_pilihan' => 'Prodi tidak valid.']);
        }
        // 3. Simpan ke Database
        Calon_Mahasiswa::create([
            'user_id' => Auth::id(),
            'id_prodi'=>$prodi->id,
            'nama_lengkap' => $request->nama_lengkap,
            'email' => $request->email,
            'nomor_hp' => $request->nomor_hp,
            'agama'        => $request->agama,
            'jenis_kelamin'=> $request->jenis_kelamin,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'alamat' => $request->alamat,
            'asal_sekolah' => $request->asal_sekolah,
            'fakultas'     => $prodi->fakultas,
            'jurusan_pilihan' => $request->jurusan_pilihan,
            'foto_diri' => $pathFoto,
            'status' =>'Menunggu verifikasi',
            
        ]);

        // 4. Redirect kembali dengan pesan sukses
        return redirect()->back()->with('success', 'Pendaftaran berhasil! Data Anda telah disimpan.');
    }
}