@extends('layouts.index')
@section('content')
<div id="content">
	<div id="register">
		
		<div class="wp-form-register">
			
			<div class="alert account_vertifi text-center">
				<h2>Xác minh đặt lại mật khẩu mới</h2>
				<p>Chúng tôi vừa gửi tin nhắn chứa mã xác minh đến email của bạn. Vui lòng kiểm tra tin nhắn và nhập mã được gửi đến:<strong>{{session('email')}}</strong></p>
			</div>
			<form action="{{url('post-newpass-vertifi')}}" method="post" id='newpass-vertifi'>
				@csrf
				<div class="form-group code-number">
					<input type="text" name="code_number" class="form-control code_number">
					
					<p class="form-error"></p>
				
				</div>
				
				<div class="form-group mt-4 text-center">
					<input type="hidden" name="email" value="{{session('email')}}" class="email">
					<input type="submit" value="Xác nhận" name="btn-submit" class="btn btn-success">
				</div>
			</form>
		</div>
	</div>
	<!--  -->

</div>
@endsection
@section('script')
<script type="text/javascript">
    $('#newpass-vertifi').on('submit',function(e){
    	e.preventDefault();
    	var code_number = $(this).find('.code_number').val();
    	var email = $(this).find('.email').val();
    	if(code_number == ''){
    		$('.form-error').html('Bạn chưa nhập mã xác nhận');
    	}else{
    		$.ajax({
		        headers: {
		          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		        },
		        url: 'post-newpass-vertifi',
		        dataType:'json',
		        data: {email:email,code_number:code_number},
		        type: "post",
		        
		        success: function(data) {
		        	console.log(data);
		        	if(data.error){
		        		$('.form-error').html('Mã xác nhận không đúng');
		        	}
		        	if(data.success){
		        		window.location.href = 'set-new-pass';
		        	}
		        	
		        }
		    });
    	}
    	
    })
</script>
@endsection