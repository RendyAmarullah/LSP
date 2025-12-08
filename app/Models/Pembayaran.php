<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;

    protected $table = 'pembayarans';

    protected $fillable = [
        'kode_transaksi',
        'id_calon_mahasiswa',
        'tanggal',
        'jenis_pembayaran',
        'jumlah_bayar',
        'metode_pembayaran',
        'bukti_bayar',
        'status',
        'keterangan_admin'

    ];

    public function calonMahasiswa()
    {
        return $this->belongsTo(Calon_Mahasiswa::class, 'id_calon_mahasiswa');
    }
}
