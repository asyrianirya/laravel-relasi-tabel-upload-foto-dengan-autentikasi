<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Matkul;

class MatkulSeeder extends Seeder
{
    public function run()
    {
        Matkul::create(['kd_mk' => 'M001', 'kd_prodi' => 'A1', 'semester' => '4', 'nama_matkul' => 'Pemrograman Web Lanjut']);
        Matkul::create(['kd_mk' => 'M002', 'kd_prodi' => 'A1', 'semester' => '4', 'nama_matkul' => 'Pemrograman Berorentasi Objek Lanjut']);
    }
}

