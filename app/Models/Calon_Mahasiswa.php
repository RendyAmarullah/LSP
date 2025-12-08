<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Calon_Mahasiswa extends Model
{
    use HasFactory;

    protected $table = 'calon_mahasiswas';

    protected $fillable = [
        'user_id',
        'id_prodi',
        'nama_lengkap',
        'email',
        'nomor_hp',
        'agama',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'alamat',
        'asal_sekolah',
        'fakultas',
        'jurusan_pilihan',
        'foto_diri',
        'status',
    ];

}
