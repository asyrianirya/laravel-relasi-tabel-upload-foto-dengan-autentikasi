<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Prodi;

class ProdiSeeder extends Seeder
{
    public function run()
    {
        Prodi::create(['kd_prodi' => 'A1', 'nama_prodi' => 'Rekayasa Perangkat Lunak']);
        Prodi::create(['kd_prodi' => 'A2', 'nama_prodi' => 'Teknik Informatika']);
		Prodi::create(['kd_prodi' => 'A3', 'nama_prodi' => 'Sistem Informasi']);
		Prodi::create(['kd_prodi' => 'A4', 'nama_prodi' => 'Manajemen Informatika']);
    }
}
