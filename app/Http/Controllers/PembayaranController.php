<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Calon_Mahasiswa;
use App\Models\Pembayaran;
use Illuminate\Support\Facades\Auth;
use Pest\Support\Str;

class PembayaranController extends Controller
{
    public function index()
    {
        
        $data = Calon_Mahasiswa::with('prodi')
                ->where('user_id', Auth::id())
                ->first();

        
        if (!$data) {
            return redirect('/pendaftaranmahasiswa')->with('error', 'Silakan lengkapi data pendaftaran terlebih dahulu.');
        }

        $pembayaran = Pembayaran::where('id_calon_mahasiswa', $data->id)
                      ->latest()
                      ->first();

        return view('pembayaran', compact('data', 'pembayaran'));
    }
    
    public function uploadBukti(Request $request)
    {
      
        $request->validate([
            'bukti_bayar' => 'required|image|mimes:jpeg,png,jpg,pdf|max:2048', // Max 2MB
        ]);

        
        $camaba = Calon_Mahasiswa::with('prodi')->where('user_id', Auth::id())->first();

     
        $pathBukti = null;
        if ($request->hasFile('bukti_bayar')) {
            $pathBukti = $request->file('bukti_bayar')->store('bukti-bayar', 'public');
        }

       
        $kodeTrx = 'TRX-' . date('Ymd') . '-' . strtoupper(Str::random(4));
        $pembayaran = Pembayaran::where('id_calon_mahasiswa', $camaba->id)->first();

        if ($pembayaran){

            $pembayaran->update([
                'bukti_bayar' => $pathBukti,
                'status'      => 'pending',
                'tanggal'     => now(),
                'keterangan_admin' => null
            ]);

            $pesan = 'Bukti pembayaran berhasil diperbarui! Silakan tunggu verifikasi admin.';

        }
        else
        {
            Pembayaran::create([
                'kode_transaksi'     => $kodeTrx,
                'id_calon_mahasiswa' => $camaba->id,
                'tanggal'            => now(),
                'jenis_pembayaran'   => 'biaya pendaftaran',
                'jumlah_bayar'       => $camaba->prodi->biaya_kuliah, 
                'metode_pembayaran'  => 'Transfer Bank',
                'bukti_bayar'        => $pathBukti,
                'status'             => 'pending',
            ]);
           
        }
        return redirect()->back()->with('success', 'Bukti pembayaran berhasil dikirim! Silakan tunggu verifikasi admin.');
    }

    public function index2()
    {
    
        $pembayaran = Pembayaran::with('calonMahasiswa')
                      ->orderBy('created_at', 'desc')
                      ->paginate(10);

        return view('admin.pembayaran', compact('pembayaran'));
    }

    public function updateStatus(Request $request, $id)
    {
        $trx = Pembayaran::findOrFail($id);

       
        $request->validate([
            'status' => 'required|in:lunas,ditolak',
            'keterangan_admin' => 'nullable|string'
        ]);

       
        $trx->status = $request->status;
        $trx->keterangan_admin = $request->keterangan_admin; 
        $trx->save();

        // (Opsional) Jika lunas, update juga status di tabel calon_mahasiswa jadi 'tervalidasi' jika perlu logic tersebut
        // if($request->status == 'lunas') {
        //      $trx->calonMahasiswa->update(['status' => 'tervalidasi']);
        // }

        return redirect()->back()->with('success', 'Status pembayaran berhasil diperbarui.');
    }
}