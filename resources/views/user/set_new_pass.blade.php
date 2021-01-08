@extends('layouts.index')
@section('content')
<div id="content">
	<div id="login">
		
		<div class="wp-form-login">
			<h1>Đặt mật khẩu mới</h1>
			<form method="post" action="{{url('post-set-new-pass')}}">
				@csrf
				<div class="input-group mb-3">
					<input type="password" class="form-control" name="password" placeholder="Nhập Password" required="">
					<div class="input-group-append">
						<span class="input-group-text"><i class="fas fa-lock"></i></span>
					</div>
				</div>
				@error('password')
				<p class="form-error">{{$message}}</p>
				@enderror
				<div class="input-group mb-3">
					<input type="password" class="form-control" name="password_comfirm" placeholder="Nhập Lại Password" required="">
					<div class="input-group-append">
						<span class="input-group-text"><i class="fas fa-lock"></i></span>
					</div>
				</div>
				@error('password_comfirm')
				<p class="form-error">{{$message}}</p>
				@enderror
				<div class="input-group mb-3">
					<input type="hidden" name="email" value="{{session('email')}}">
					<input type="submit" name="" class="btn btn-success w-100" name="submit" value="Xác Nhận">
				</div>
				<div class="input-group text-center">
					<p><a href="{{url('forgot-pass')}}">Quên mật khẩu /</a>  <a href="{{url('register')}}">Đăng kí</a></p>
					
				</div>
			</form>
		</div>
	</div>
	<!--  -->

</div>
@endsection