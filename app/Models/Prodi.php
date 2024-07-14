<?php
	
	namespace App\Models;
	
	use Illuminate\Database\Eloquent\Factories\HasFactory;
	use Illuminate\Database\Eloquent\Model;
	use Illuminate\Database\Eloquent\Relations\HasMany;
	use App\Models\Mahasiswa;
	
	class Prodi extends Model
	{
		use HasFactory;
		protected $table = 'prodis';
		
		public function matkuls()
		{
			return $this->hasMany(Matkul::class, 'kd_prodi', 'kd_prodi');
		}
		
	}
