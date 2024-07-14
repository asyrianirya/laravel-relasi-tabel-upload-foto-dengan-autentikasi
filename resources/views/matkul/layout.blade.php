<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>@yield('title', 'Laravel | Tabel Mahasiswa')</title>

        <link rel="stylesheet" type="text/css" href="{{ asset('/css/app.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('/css/datatables.min.css') }}">
    </head>
    <body>
        <nav class="navbar ">
            <div class="container-fluid">
                <a class="navbar-brand" href="/">
                <img src="{{ asset('logomark.min.svg') }}" alt="" width="30" height="24" class="d-inline-block align-text-top">Laravel 10</a>
            </div>
        </nav>
        <div class="container-fluid">
            @yield('content')
        </div>

        <script src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>
		<script src="{{ asset('js/jquery.validate.min.js') }}"></script>
		<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
		<script src="{{ asset('js/datatables.min.js') }}"></script>
		<script src="{{ asset('js/sweetalert2@11.js') }}"></script>

        @yield('js')
    </body>
</html>