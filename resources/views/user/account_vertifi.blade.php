@extends('layouts.index')
@section('content')
<div id="content">
	<div id="register">
		
		<div class="wp-form-register">
			
			<div class="alert account_vertifi text-center">
				<h2>Xác minh tài khoản bằng gmail</h2>
				<p>Chúng tôi vừa gửi tin nhắn chứa mã xác minh đến email của bạn. Vui lòng kiểm tra tin nhắn và nhập mã được gửi đến:<strong>{{session('email')}}</strong></p>
			</div>
			<form action="{{url('post-account-vertifi')}}" method="post">
				@csrf
				<div class="form-group code-number">
					<input type="text" name="code_number" class="form-control">
					@error('code_number')
					<p class="form-error">{{$message}}</p>
					@enderror
				</div>
				
				<div class="form-group mt-4 text-center">
					<input type="hidden" name="email" value="{{session('email')}}">
					<input type="hidden" name="username" value="{{session('username')}}">
					<input type="hidden" name="password" value="{{session('password')}}">
					<input type="submit" value="Xác minh" name="btn-submit" class="btn btn-success">
					<a href="resend/{{session('email')}}" class="btn btn-primary">Gửi lại mã</a>
				</div>
			</form>
		</div>
	</div>
	<!--  -->

</div>
@endsection
@section('script')
<script type="text/javascript">
	var exist = '{{Session::has('resend')}}';
    if(exist){
        Swal.fire({
	        position: 'center',
	        icon: 'success',
	        title: 'Đã gửi lại mã xác nhận !',
	        // showConfirmButton: false,
	        button:'ok'
	        // timer: 1800
	    })
    }
</script>
@endsection