<?php
	
	namespace App\Models;
	
	use Illuminate\Database\Eloquent\Factories\HasFactory;
	use Illuminate\Database\Eloquent\Model;
	use Illuminate\Database\Eloquent\Relations\belongsToMany;
	use App\Models\Prodi;
	
	class Matkul extends Model
	{
		use HasFactory;
		protected $table = 'matkuls';
		
		public function prodi()
		{
			return $this->belongsTo(Prodi::class, 'kd_prodi', 'kd_prodi');
		}
		
	}
