<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Calon_Mahasiswa extends Model
{
    use HasFactory;

    protected $table = 'calon_mahasiswas';

    protected $fillable = [
        'nama_lengkap',
        'email',
        'nomor_hp',
        'tempat_lahir',
        'tanggal_lahir',
        'alamat',
        'asal_sekolah',
        'jurusan_pilihan',
        'foto_diri',
    ];

}
