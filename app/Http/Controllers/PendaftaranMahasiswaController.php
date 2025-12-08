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
        return view('pendaftaranmahasiswa.pendaftaranmahasiswa', compact('prodis'));
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
            'foto_diri' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            
        ]);

        // 2. Proses Upload Gambar
        $pathFoto = null;
        if ($request->hasFile('foto_diri')) {
           
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
    
    public function edit()
{
    // Ambil data user yang login
    $data = Calon_Mahasiswa::where('user_id', Auth::id())->first();
    
    // Ambil data prodi untuk dropdown
    $prodis = \App\Models\Prodi::orderBy('fakultas')->orderBy('nama_prodi')->get()->groupBy('fakultas');

    return view('pendaftaranmahasiswa.edit', compact('data', 'prodis'));
}

public function update(Request $request)
{
    $camaba = Calon_Mahasiswa::where('user_id', Auth::id())->first();

    // Validasi input (Sama seperti store, tapi foto boleh kosong/nullable)
    $request->validate([
        'nama_lengkap' => 'required|string|max:255',
        'jenis_kelamin'=> 'required|string',
        'agama'        => 'required|string',
        'email'        => 'required|email',
        'nomor_hp'     => 'required|numeric',
        'tempat_lahir' => 'required|string',
        'tanggal_lahir'=> 'required|date',
        'alamat'       => 'required|string',
        'asal_sekolah' => 'required|string',
        'jurusan_pilihan' => 'required|string',
        'foto_diri'    => 'nullable|image|max:2048', // Foto opsional saat edit
    ]);

    // Handle File Foto (Jika ada upload baru)
    if ($request->hasFile('foto_diri')) {
        // (Opsional) Hapus foto lama di storage jika perlu
        $pathFoto = $request->file('foto_diri')->store('foto-maba', 'public');
        $camaba->foto_diri = $pathFoto;
    }

    // Ambil data prodi baru (jika user ganti jurusan)
    $prodi =Prodi::where('nama_prodi', $request->jurusan_pilihan)->first();

    // Update Data
    $camaba->update([
        'nama_lengkap' => $request->nama_lengkap,
        'jenis_kelamin'=> $request->jenis_kelamin,
        'agama'        => $request->agama,
        'email'        => $request->email,
        'nomor_hp'     => $request->nomor_hp,
        'tempat_lahir' => $request->tempat_lahir,
        'tanggal_lahir'=> $request->tanggal_lahir,
        'alamat'       => $request->alamat,
        'asal_sekolah' => $request->asal_sekolah,
        'jurusan_pilihan' => $request->jurusan_pilihan,
        'id_prodi'     => $prodi->id,
        'fakultas'     => $prodi->fakultas,
        
        
        'status'       => 'pending' 
    ]);

    return redirect('/profile')->with('success', 'Data berhasil diperbarui! Menunggu verifikasi ulang.');
}
}