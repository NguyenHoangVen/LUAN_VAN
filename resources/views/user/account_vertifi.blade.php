@extends('layouts.index')
@section('content')
<div id="content">
	<div id="register">
		
		<div class="wp-form-register">
			
			<div class="alert account_vertifi text-center">
				<h2>Xác minh tài khoản bằng gmail</h2>
				<p>Chúng tôi vừa gửi tin nhắn chứa mã xác minh đến email của bạn. Vui lòng kiểm tra tin nhắn và nhập mã được gửi đến:<strong>{{session('email')}}</strong></p>
			</div>
			<form action="{{url('post-account-vertifi')}}" method="post" id="account-vertifi">
				@csrf
				<div class="form-group code-number">
					<input type="text" name="code_number" class="form-control code_number">
					
					<p class="form-error"></p>
					
				</div>
				
				<div class="form-group mt-4 text-center">
					<input type="hidden" name="email" value="{{session('email')}}" class="email">
					<input type="hidden" name="username" value="{{session('username')}}">
					<input type="hidden" name="password" value="{{session('password')}}" class="password">
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

    // 
    $('#account-vertifi').on('submit',function(e){
    	e.preventDefault();
    	var code_number = $(this).find('.code_number').val();
    	var email = $(this).find('.email').val();
    	var password = $(this).find('.password').val();

    	if(code_number == ''){
    		$('.form-error').html('Bạn chưa nhập mã xác nhận');
    	}else{
    		$.ajax({
		        headers: {
		          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		        },
		        url: 'post-account-vertifi',
		        dataType:'json',
		        data: {email:email,code_number:code_number,password:password},
		        type: "post",
		        
		        success: function(data) {
		        	if(data.error){
		        		$('.form-error').html('Mã xác nhận không đúng');
		        	}
		        	if(data.success){
		        		window.location.href = 'home';
		        	}
		        	
		        }
		    });
    	}
    	
    })
</script>
@endsection