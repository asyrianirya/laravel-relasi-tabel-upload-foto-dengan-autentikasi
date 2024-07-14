<?php
	namespace App\Models;
	use Illuminate\Database\Eloquent\Factories\HasFactory;
	use Illuminate\Database\Eloquent\Model;
	use Illuminate\Database\Eloquent\Relations\BelongsTo;
	use Illuminate\Database\Eloquent\Relations\BelongsToMany;
	use App\Models\Matkul;
	use App\Models\Prodi;
	
	class Mahasiswa extends Model
	{
		use HasFactory;
		protected $table = 'mahasiswas';
		
		public function prodi(){
			return $this->belongsTo('App\Models\Prodi');
		}
	}
