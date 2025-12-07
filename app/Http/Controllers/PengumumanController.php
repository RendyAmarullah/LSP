<?php

namespace App\Http\Controllers;

use App\Models\Pengumuman;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PengumumanController extends Controller
{
    public function index()
    {
        $pengumuman = Pengumuman::latest()->paginate(5);
        
        return view('admin.pengumuman', compact('pengumuman'))->with('page', 'index');
    }

    // 2. Tampilkan Form Tambah
    public function create()
    {
        
        return view('admin.pengumuman')->with('page', 'create');
    }
    // 3. PROSES SIMPAN DATA (Ini yang tadi Error/Hilang)
    public function store(Request $request)
    {
       
        $request->validate([
            'judul' => 'required',
            'isi' => 'required',
            'gambar' => 'image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $gambarPath = null;
        
        
        if ($request->hasFile('gambar')) {
           
            $gambarPath = $request->file('gambar')->store('pengumuman', 'public');
        }

       
        Pengumuman::create([
            'judul' => $request->judul,
            'isi' => $request->isi,
            'gambar' => $gambarPath
        ]);

        return redirect()->route('pengumuman.index')->with('success', 'Pengumuman berhasil ditambahkan');
    }

    // 4. Form Edit
    public function edit($id)
    {
        $pengumuman = Pengumuman::findOrFail($id);
        // Panggil file sama, bawa data pengumuman, 'page' => 'edit'
        return view('admin.pengumuman', compact('pengumuman'))->with('page', 'edit');
    }

    // 5. Update Data
    public function update(Request $request, $id)
    {
        $pengumuman = Pengumuman::findOrFail($id);
        
        $request->validate([
            'judul' => 'required',
            'isi' => 'required',
            'gambar' => 'image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $data = [
            'judul' => $request->judul,
            'isi' => $request->isi,
        ];

        // Logika Ganti Gambar
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($pengumuman->gambar && Storage::exists('public/' . $pengumuman->gambar)) {
                Storage::delete('public/' . $pengumuman->gambar);
            }
            // Upload gambar baru
            $data['gambar'] = $request->file('gambar')->store('pengumuman', 'public');
        }

        $pengumuman->update($data);

        return redirect()->route('pengumuman.index')->with('success', 'Pengumuman berhasil diperbarui');
    }

    // 6. Hapus Data
    public function destroy($id)
    {
        $pengumuman = Pengumuman::findOrFail($id);
        
        // Hapus file gambar dari storage
        if ($pengumuman->gambar && Storage::exists('public/' . $pengumuman->gambar)) {
            Storage::delete('public/' . $pengumuman->gambar);
        }

        $pengumuman->delete();
        return redirect()->route('admin.pengumuman')->with('success', 'Pengumuman dihapus');
    }

      
}
