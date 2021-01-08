@extends('layouts.index')
@section('content')
<div id="content">
	<div id="login">
		
		<div class="wp-form-login">
			<h1>Đăng Nhập</h1>
			@if(session('success'))
			<div class="alert alert-info alert-dismissible">
			    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			    <strong>{{session('success')}}!</strong> 
		  	</div>
		  	@endif
			<form method="post" action="{{url('post-login')}}">
				@csrf
				<div class="input-group mb-3">
					<input type="email" class="form-control" name="email" placeholder="Nhập email của bạn" required>
					
					<div class="input-group-append">
						<span class="input-group-text"><i class="fas fa-user"></i></span>
					</div>
				</div>
				<div class="input-group mb-3">
					<input type="password" class="form-control" name="password" placeholder="Nhập Password" required="">
					<div class="input-group-append">
						<span class="input-group-text"><i class="fas fa-lock"></i></span>
					</div>
				</div>
				@if(session('error'))
				<p class="form-error">{{session('error')}}</p>
				@endif
				<div class="input-group mb-3">
					<input type="submit" name="" class="btn btn-success w-100" name="submit" value="Đăng Nhập">
				</div>
				<a href="login/facebook" class="btn w-100 mb-1 d-flex justify-content-center bx">
					<img src="image/logo/facebook-icon.png" id="image-fb">
					<span>Đăng nhập bằng Facebook</span>
				</a>
				<a href="{{url('login/google')}}" class="btn w-100 mb-1 d-flex justify-content-center bv">
					<img src="image/logo/google-icon.png" id="image-gg">
					<span>Đăng nhập bằng Google</span>
				</a>
				<div class="input-group text-center">
					<p><a href="{{url('forgot-pass')}}">Quên mật khẩu /</a>  <a href="{{url('register')}}">Đăng kí</a></p>	
				</div>
			</form>
		</div>
	</div>
	<!--  -->

</div>
@endsection