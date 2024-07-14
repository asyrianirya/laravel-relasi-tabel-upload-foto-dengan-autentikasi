<?php
	
	namespace Database\Seeders;
	use Illuminate\Database\Seeder;
	use App\Models\Mahasiswa;
	
	class MahasiswaSeeder extends Seeder
	{
		public function run()
		{
			Mahasiswa::create(['id' => 1, 'nim' => '42220068', 'name' => 'M.Burhanudin Asy\'ari', 'kd_prodi' => 'A1', 'semester' => '4', 'avatar' => 'avatars/ari.jpeg']);
			Mahasiswa::create(['id' => 2, 'nim' => '42220091', 'name' => 'Muslik', 'kd_prodi' => 'A1', 'semester' => '4', 'avatar' => 'avatars/muslik.jpeg']);
			Mahasiswa::create(['id' => 3, 'nim' => '42220062', 'name' => 'Haris Burhanudin', 'kd_prodi' => 'A1', 'semester' => '4', 'avatar' => 'avatars/haris.jpeg']);
			Mahasiswa::create(['id' => 4, 'nim' => '42220059', 'name' => 'Moh.Rakha Iqbbal Bareno', 'kd_prodi' => 'A1', 'semester' => '4', 'avatar' => 'avatars/iqbal.jpeg']);
			Mahasiswa::create(['id' => 5, 'nim' => '42220055', 'name' => 'Hari Sutrisno', 'kd_prodi' => 'A1', 'semester' => '4', 'avatar' => 'avatars/sutrisno.jpeg']);
			Mahasiswa::create(['id' => 6, 'nim' => '42220062', 'name' => 'Muhammad Ridho Sayyidina', 'kd_prodi' => 'A1', 'semester' => '4','avatar' => 'avatars/ridho.jpeg']);			
		}
	}
