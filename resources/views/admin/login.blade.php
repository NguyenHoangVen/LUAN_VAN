<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Đăng nhập Admin</title>
	<link rel="stylesheet" href="{{asset('bootstrap/css/bootstrap.min.css')}}">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.7/css/all.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<link rel="stylesheet" type="text/css" href="{{asset('css/admin.css')}}">
</head>
<body>
	<div id="content">
		<div id="login">
			<div class="wp-form-login">
				<div class="logo"><img src="{{asset('image/logo/logophuot.png')}}" alt=""></div>
				<h1>Admin</h1>
				<form action="" method="POST" action="{{url('admin-page/login')}}">
					@csrf
					<div class="input-group mb-3">
						<input type="email" class="form-control" name="email" placeholder="Nhập email của bạn" required="" value="admin@gmail.com">
						
						<div class="input-group-append">
							<span class="input-group-text"><i class="fas fa-user"></i></span>
						</div>
					</div>
					<div class="input-group mb-3">
						<input type="password" class="form-control" name="password" placeholder="Nhập Password" required="" value="hoangven1">
						<div class="input-group-append">
							<span class="input-group-text"><i class="fas fa-lock"></i></span>
						</div>
					</div>
					@if(session('error'))
					<p class="form-error">{{session('error')}}</p>
					@endif
					<input type="submit" value="Đăng Nhập" class="btn btn-primary w-100">
				</form>
			</div>
		</div>
	</div>
</body>
</html>