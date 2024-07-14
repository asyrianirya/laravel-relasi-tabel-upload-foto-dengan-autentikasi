<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>@yield('title', 'Laravel 10')</title>
		
        <link rel="stylesheet" type="text/css" href="{{ asset('/css/app.css') }}">
		<style>
			body {
            background-image: url('/avatars/bkg.jpeg'); 
            background-size: cover;
            background-repeat: no-repeat;
            background-position: top-center;
			overflow: hidden;
			}
			header {
			margin-top: 100px;
			font-size: 50px;
			}
			.nim {
			text-decoration: underline;
			}
		</style>
	</head>
    <body>
        <nav class="navbar ">
            <div class="container-fluid">
                <a class="navbar-brand" href="/">
				<img src="{{ asset('logomark.min.svg') }}" alt="" width="30" height="24" class="d-inline-block align-text-top">Laravel 10</a>
				<div class="d-flex gap-3 align-items-center">
					<p class="m-0">Username: {{$data->name}}</p>
					<a class="btn btn-danger" href="logout" >Logout</a>
				</div>
			</div>
		</nav>
        <div class="container-fluid d-flex flex-column justify-content-center align-items-center">
			<header class="mb-5">PEMROGRAMAN WEB LANJUT</header>
			<main class="d-flex flex-column ">
				<div class="display-flex align-item-center button-group">
					<a class="btn btn-primary mx-2" href="/mahasiswas">Tabel Mahasiswa</a>
					<a class="btn btn-primary mx-2" href="/matkuls">Tabel Mata Kuliah</a>
					<a class="btn btn-primary mx-2" href="/prodis">Tabel Prodi</a>
				</div>
			</main>
			<aside>
				<p>Anggota Kelompok:</p>
				<ul>
					<li>Muslik <span class="nim">42220091</span></li>
					<li>Moh.Rakha Iqbal Bareno <span class="nim">42220059</span></li>
					<li>M.Burhanudin Asy'ari <span class="nim">42220068</span></li>
					<li>Hari Sutrisno <span class="nim">42220055</span></li>
					<li>Haris Burhanudin <span class="nim">42220056</span></li>
					<li>Muhammad Ridho Sayyidina <span class="nim">42220062</span></li>
				</ul>
			</aside>
		</div>
		
		<script src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>
		<script src="{{ asset('js/jquery.validate.min.js') }}"></script>
		<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
		<script src="{{ asset('js/datatables.min.js') }}"></script>
		<script src="{{ asset('js/sweetalert2@11.js') }}"></script>
		
		@yield('js')
	</body>
</html>							