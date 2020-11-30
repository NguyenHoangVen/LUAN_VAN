@extends('layouts.index')
@section('content')
<div id="content">
	<div id="register">
		
		<div class="wp-form-register">
			
			<div class="alert account_vertifi text-center">
				<h2>Lấy lại mật khẩu</h2>
				<p>Mời bạn nhập vào Email tài khoản, Hệ thống sẽ gửi mã xác nhận vào email của bạn. Bạn vui lòng kiểm tra Email để lấy lại mật khẩu của mình.</p>
			</div>
			<form action="{{url('post-forgot-pass')}}" method="post">
				@csrf
				<div class="form-group code-number w-50">
					<input type="email" name="email" class="form-control" placeholder="Nhập email">
					@if(session('error'))
					<p class="form-error">{{session('error')}}</p>
					@endif
				</div>
				
				<div class="form-group mt-4 text-center">
					
					<input type="submit" value="Gửi xác nhận" name="btn-submit" class="btn btn-success">
					
				</div>
			</form>
		</div>
	</div>
	<!--  -->

</div>
@endsection