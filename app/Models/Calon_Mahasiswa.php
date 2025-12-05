<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Calon_Mahasiswa extends Model
{
    protected $table = 'calon_mahasiswas';
    protected $fillable = ['user_id', 'nama_lengkap', 'status_pendaftaran'];
}
