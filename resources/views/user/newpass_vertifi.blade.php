@extends('layouts.index')
@section('content')
<div id="content">
	<div id="register">
		
		<div class="wp-form-register">
			
			<div class="alert account_vertifi text-center">
				<h2>Xác minh minh đặt lại mật khẩu mới</h2>
				<p>Chúng tôi vừa gửi tin nhắn chứa mã xác minh đến email của bạn. Vui lòng kiểm tra tin nhắn và nhập mã được gửi đến:<strong>{{session('email')}}</strong></p>
			</div>
			<form action="{{url('post-newpass-vertifi')}}" method="post">
				@csrf
				<div class="form-group code-number">
					<input type="text" name="code_number" class="form-control">
					@error('code_number')
					<p class="form-error">{{$message}}</p>
					@enderror
				</div>
				
				<div class="form-group mt-4 text-center">
					<input type="hidden" name="email" value="{{session('email')}}">
					<input type="submit" value="Xác nhận" name="btn-submit" class="btn btn-success">
				</div>
			</form>
		</div>
	</div>
	<!--  -->

</div>
@endsection