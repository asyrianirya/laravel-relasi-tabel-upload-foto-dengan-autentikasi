<?php
	
	use Illuminate\Database\Migrations\Migration;
	use Illuminate\Database\Schema\Blueprint;
	use Illuminate\Support\Facades\Schema;
	
	return new class extends Migration
	{
		/**
			* Run the migrations.
			*
			* @return void
		*/
		public function up(): void
		{
			Schema::create('matkuls', function (Blueprint $table) {
				$table->id();
				$table->string('kd_mk');
				$table->string('kd_prodi');
				$table->string('semester');
				$table->string('nama_matkul');
				$table->timestamps();
			});
		}
		
		/**
			* Reverse the migrations.
			*
			* @return void
		*/
		public function down(): void
		{
			Schema::dropIfExists('matkuls');
		}
	};
