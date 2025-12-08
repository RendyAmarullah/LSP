<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Prodi extends Model
{
    use HasFactory;

    // Nama tabel di database (opsional jika nama model singular dari tabel)
    protected $table = 'prodis';

    // Kolom yang boleh diisi secara massal (Mass Assignment)
    protected $fillable = [
        'kode_prodi',
        'nama_prodi',
        'jenjang',
        'fakultas',
        'biaya_kuliah',
    ];

    // Mengubah tipe data saat diambil dari database
    protected $casts = [
        'biaya_kuliah' => 'double', // Agar terbaca sebagai angka/float
    ];

    /**
     * Accessor untuk memformat Biaya Kuliah ke format Rupiah.
     * Cara panggil di Blade: {{ $item->biaya_kuliah_formatted }}
     */
    protected function biayaKuliahFormatted(): Attribute
    {
        return Attribute::make(
            get: fn () => 'Rp ' . number_format($this->biaya_kuliah, 0, ',', '.')
        );
    }
}