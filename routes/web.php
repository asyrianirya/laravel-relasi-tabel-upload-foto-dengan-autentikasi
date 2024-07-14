<?php
	
	use Illuminate\Support\Facades\Route;
	use App\Http\Controllers\MahasiswaController;
	use App\Http\Controllers\ProdiController;
	use App\Http\Controllers\MatkulController;
	use App\Http\Controllers\AuthenController;
	use Illuminate\Support\Facades\Auth;
	
	/*
		|--------------------------------------------------------------------------
		| Web Routes
		|--------------------------------------------------------------------------
		|
		| Here is where you can register web routes for your application. These
		| routes are loaded by the RouteServiceProvider and all of them will
		| be assigned to the "web" middleware group. Make something great!
		|
	*/
	//Otentikasi
	Route::controller(AuthenController::class)->group(function(){
		Route::get('/registration','registration')->middleware('alreadyLoggedIn');
		Route::post('/registration-user','registerUser')->name('register-user');
		Route::get('/login','login')->middleware('alreadyLoggedIn');
		Route::post('/login-user','loginUser')->name('login-user');
		Route::get('/dashboard','dashboard')->middleware('isLoggedIn');
		Route::get('/','dashboard')->middleware('isLoggedIn');
		Route::get('/logout','logout');
	});	
	
	Route::middleware('isLoggedIn')->group(function () {
		
		
		Route::resource('mahasiswas', MahasiswaController::class);
		Route::post('mahasiswas/{mahasiswa}', [MahasiswaController::class, 'update']);
		
		Route::resource('prodis', ProdiController::class);
		Route::post('prodis/{prodi}', [ProdiController::class, 'update']);
		
		Route::resource('matkuls', MatkulController::class);
		Route::post('matkuls/{matkul}', [MatkulController::class, 'update']);
		
	});								