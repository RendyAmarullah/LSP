<?php

namespace Database\Seeders;

use App\Models\Prodi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProdiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'kode_prodi'   => 'TI',
                'nama_prodi'   => 'Teknik Informatika',
                'jenjang'      => 'S1',
                'fakultas'     => 'Fakultas Teknik',
                'biaya_kuliah' => 8500000.00
            ],
            [
                'kode_prodi'   => 'SI',
                'nama_prodi'   => 'Sistem Informasi',
                'jenjang'      => 'S1',
                'fakultas'     => 'Fakultas Ilmu Komputer',
                'biaya_kuliah' => 8000000.00
            ],
            [
                'kode_prodi'   => 'DKV',
                'nama_prodi'   => 'Desain Komunikasi Visual',
                'jenjang'      => 'S1',
                'fakultas'     => 'Fakultas Seni dan Desain',
                'biaya_kuliah' => 9000000.00
            ],
            [
                'kode_prodi'   => 'MNJ',
                'nama_prodi'   => 'Manajemen',
                'jenjang'      => 'S1',
                'fakultas'     => 'Fakultas Ekonomi dan Bisnis',
                'biaya_kuliah' => 7500000.00
            ],
            [
                'kode_prodi'   => 'AKT',
                'nama_prodi'   => 'Akuntansi',
                'jenjang'      => 'S1',
                'fakultas'     => 'Fakultas Ekonomi dan Bisnis',
                'biaya_kuliah' => 7500000.00
            ],
            [
                'kode_prodi'   => 'HKM',
                'nama_prodi'   => 'Ilmu Hukum',
                'jenjang'      => 'S1',
                'fakultas'     => 'Fakultas Hukum',
                'biaya_kuliah' => 7000000.00
            ],
            [
                'kode_prodi'   => 'PSI',
                'nama_prodi'   => 'Psikologi',
                'jenjang'      => 'S1',
                'fakultas'     => 'Fakultas Psikologi',
                'biaya_kuliah' => 8200000.00
            ],
            [
                'kode_prodi'   => 'MI',
                'nama_prodi'   => 'Manajemen Informatika',
                'jenjang'      => 'D3',
                'fakultas'     => 'Fakultas Ilmu Terapan',
                'biaya_kuliah' => 5500000.00
            ],
            [
                'kode_prodi'   => 'TE',
                'nama_prodi'   => 'Teknik Elektro',
                'jenjang'      => 'S1',
                'fakultas'     => 'Fakultas Teknik',
                'biaya_kuliah' => 8500000.00
            ],
            [
                'kode_prodi'   => 'KOM',
                'nama_prodi'   => 'Ilmu Komunikasi',
                'jenjang'      => 'S1',
                'fakultas'     => 'Fakultas Ilmu Komunikasi',
                'biaya_kuliah' => 7800000.00
            ],
        ];

        
        foreach ($data as $prodi) {
            Prodi::firstOrCreate(
                
                ['kode_prodi' => $prodi['kode_prodi']],
                $prodi

            );
                
            
        }
    }
}
