<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Login</title>
		<link rel="stylesheet" type="text/css" href="{{ asset('/css/app.css') }}">
	</head>
	<body>
		<div class="container">
			<div class="row">
				<div class="col-md-col-md-offset-4">
					<h2>Login</h2>
					<form action="{{route('login-user')}}" method="post"
					enctype="multipart/form-data">
						@csrf
						@if (Session::has('success'))
						<div class="alert alert-success">
							{{Session::get('success')}}
						</div>
						@endif
						@if (Session::has('fail'))
						<div class="alert alert-danger">
							{{Session::get('fail')}}
						</div>
						@endif
						<div class="form-group">
							<label for="email">Email</label>
							<input id="email" type="email" name="email" class="form-control">
							<span class="text-danger">
								@error('email')
								{{$message}}
								@enderror
							</span>
						</div>
						<div class="form-group">
							<label for="password">Password</label>
							<input id="password" type="password" name="password" class="form-control">
							<span class="text-danger">
								@error('password')
								{{$message}}
								@enderror
							</span>
						</div>
						<br>
						<div class="form-group">
							<button type="submit" class="btn btn-block btn-success">Login</button>
						</div>
						<br>
						<a href="registration">Registration</a>
					</form>
				</div>
			</div>
			<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
		</div>
	</body>
</html>