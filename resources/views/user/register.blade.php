@extends('layouts.index')
@section('content')
<div id="content">
	<div id="register">
		
		<div class="wp-form-register">
			<h1>Đăng Kí Tài Khoản</h1>
			@if(session('register_success'))
			<div class="alert alert-success">{{session('register_success')}}</div>
			@endif
			<form method="post" action="{{url('register')}}">
				@csrf
				<div class="input-group mb-3">
					<input type="text" class="form-control" name="fullname" placeholder="Tên đầy đủ của bạn" value="{{ old('fullname') }}">
					
					<div class="input-group-append">
						<span class="input-group-text"><i class="fas fa-user"></i></span>
					</div>

				</div>
				@error('fullname')
				<p class="form-error">{{$message}}</p>
				@enderror
				<div class="input-group mb-3">
					<input type="text" class="form-control" name="username" placeholder="Tên tài khoản" value="{{ old('username') }}">
					
					<div class="input-group-append">
						<span class="input-group-text"><i class="fas fa-user"></i></span>
					</div>
				</div>
				@error('username')
				<p class="form-error">{{$message}}</p>
				@enderror
				<div class="input-group mb-3">
					<input type="email" class="form-control" name="email" placeholder="Nhập Email của bạn" value="{{ old('email') }}">
					<div class="input-group-append">
						<span class="input-group-text"><i class="fas fa-envelope"></i></span>
					</div>
				</div>
				@error('email')
				<p class="form-error">{{$message}}</p>
				@enderror
				<div class="input-group mb-3">
					<input type="password" class="form-control" name="password" placeholder="Nhập Password" value="{{ old('password') }}">
					<div class="input-group-append">
						<span class="input-group-text"><i class="fas fa-lock"></i></span>
					</div>
				</div>
				@error('password')
				<p class="form-error">{{$message}}</p>
				@enderror
				<div class="input-group mb-3">
					<input type="password" class="form-control" name="password_comfirm" placeholder="Nhập lại password" value="{{ old('password_comfirm') }}">
					<div class="input-group-append">
						<span class="input-group-text"><i class="fas fa-lock"></i></span>
					</div>
				</div>
				@error('password_comfirm')
				<p class="form-error">{{$message}}</p>
				@enderror
				<div class="input-group mb-3">
					<input type="date" class="form-control" name="birthday" placeholder="Nhập Password" value="{{ old('birthday') }}">
					
				</div>
				@error('birthday')
				<p class="form-error">{{$message}}</p>
				@enderror
				<div class="input-group mb-3">
					<select name="gender" class="custom-select" id="">
						<option value="">---Giới tính---</option>
						<option value="male">Nam</option>
						<option value="female">Nữ</option>
					</select>
				</div>
				@error('gender')
				<p class="form-error">{{$message}}</p>
				@enderror
				<div class="input-group mb-3">
					<input type="text" class="form-control" name="address" placeholder="Nhập Địa chỉ" value="{{ old('address') }}">
					<div class="input-group-append">
						<span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
					</div>
				</div>
				@error('address')
				<p class="form-error">{{$message}}</p>
				@enderror
				<div class="input-group mb-3 d-flex justify-content-center">
					<input type="submit" name="" class="btn btn-success w-50" name="submit" value="Đăng Kí">
				</div>
				<div class="input-group d-flex justify-content-center">
					<p ><a href="login" class="text-center">Đăng Nhập</a></p>
					
				</div>

			</form>
		</div>
	</div>
	<!--  -->

</div>
@endsection