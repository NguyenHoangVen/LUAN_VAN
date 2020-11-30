@extends('layouts.index')
@section('content')
@include('layouts.profile.head_profile')

<div class="col-lg-9 col-md-12 diary mt-0 p-0">
	<div class="bg-padding">
	<div class="card">
	  <div class="card-header p-2">
	    <ul class="nav nav-pills">
	      <li class="nav-item"><a class="nav-link active tab-friend" href="#all-friends" data-toggle="tab">Tất cả bạn bè 
	      	<input type="hidden" class="status" value="all-friend">
	      </a></li>
	      <li class="nav-item"><a class="nav-link tab-friend" href="#received-request" data-toggle="tab">Yêu cầu kết bạn
	      		<input type="hidden" class="status" value="request">
	      </a></li>
	      <li class="nav-item"><a class="nav-link tab-friend" href="#sended-request" data-toggle="tab">Yêu cầu đã gửi<input type="hidden" class="status" value="sended"></a></li>
	      <li class="nav-item"><a class="nav-link tab-friend" href="#suggestions-friend" data-toggle="tab">Những người bạn có thể biết<input type="hidden" class="status" value="suggestions"></a></li>
	      <li class="nav-item"><a class="nav-link" href="#search-all-friend" data-toggle="tab">Tìm kiếm</a></li>
	    </ul>
	  </div><!-- /.card-header -->
	  <div class="card-body">
	    <div class="tab-content">
	    	<!-- TAT CA BAN BE -->
	      	<div class="active tab-pane" id="all-friends">
	        	<!-- SEARCH -->
		        <div class="row mb-3">
		        	<div class="col-lg-6 col-md-12">
		       			<!-- form search friend -->
		       			<form action="" id="form-search-friend">
		       				<input type="text" class="form-control key" placeholder="Tìm hoặc tạo nhóm" name="key">
							<button class="icon-search" style="
							position: absolute;
						    right: 20px;
						    top: 2px;
						    padding: 7px;
						    font-size: 20px;
						    cursor: pointer;
						    background: white;
						    border: none;
						    color: #d8d8d8;
						    "><i class="fas fa-search"></i></button>
		       			</form>
		       		</div>
		        </div>
	        	<!-- LIST FRIENDS -->
		        <div class="list-friends">
			       	<div class="row">
			       		@foreach($friends as $friend)
			       		@if($friend->id_user_accept == Auth::user()->id)
			       		<div class="col-lg-6 col-md-12 mb-1 friend-{{$friend->user_accept->id}}">
			       			<div class="card">
							  	<div class="card-body p-2 ">
							  		<div class="respon-card">
								  		<div class="d-flex">
											<div class="avatar" style="width: 50px;height: 50px">
												<a href="">
													<img src="image/image_avatar/{{$friend->user_accept->avatar}}" alt="" class="w-100 h-100">
												</a>
											</div>
											<div class="username"><a  href="">{{$friend->user_accept->username}}</a></div>
										</div>		

										<div class="send mt-1 dropdown">
											<button class="btn btn-light w-100" data-toggle='dropdown'>Bạn bè</button>
											<div class="dropdown-menu dropdown-menu-right">
												<div class="dropdown-item delete-friend">Xóa bạn <input type="hidden" class="friend-id" value="{{$friend->user_accept->id}}"></div>
											</div>
										</div>
									
									</div>
							  	</div>
							</div>
			       		</div>
			       		@else
			       		<div class="col-lg-6 col-md-12 mb-1 friend-{{$friend->user_send->id}}">
			       			<div class="card">
							  	<div class="card-body p-2 ">
							  		<div class="respon-card">
								  		<div class="d-flex">
											<div class="avatar" style="width: 50px;height: 50px">
												<a href="">
													<img src="image/image_avatar/{{$friend->user_send->avatar}}" alt="" class="w-100 h-100">
												</a>
											</div>
											<div class="username"><a  href="">{{$friend->user_send->username}}</a></div>
										</div>		

										<div class="send mt-1 dropdown">
											<button class="btn btn-light w-100" data-toggle='dropdown'>Bạn bè</button>
											<div class="dropdown-menu dropdown-menu-right">
												<div class="dropdown-item delete-friend">Xóa bạn <input type="hidden" class="friend-id" value="{{$friend->user_send->id}}"></div>
											</div>
										</div>
									
									</div>
							  	</div>
							</div>
			       		</div>
			       		@endif
			       		@endforeach
			       		

			       		
			       	</div>
			    </div>
	      	</div>
	      	<!-- YEU CAU KET BAN -->
	      	<div class="tab-pane" id="received-request">
	      
		        <div class="list-friends">
			       	<div class="row">
			       		
			       		<!-- @foreach($list_user as $friend)
			       		<div class="col-lg-6 col-md-12 mb-1 friend-{{$friend->id}}">
			       			<div class="card">
							  	<div class="card-body p-2 ">
							  		<div class="respon-card">
								  		<div class="d-flex">
											<div class="avatar" style="width: 50px;height: 50px">
												<a href="">
													<img src="image/image_avatar/{{$friend->avatar}}" alt="" class="w-100 h-100">
												</a>
											</div>
											<div class="username"><a  href="">{{$friend->username}}</a></div>
										</div>		
										<div class="send mt-1"><button class="btn btn-success w-100 received-request">Chấp nhận
											<input type="hidden" class="send_id" value="{{$friend->id}}">
										</button></div>
									</div>
							  	</div>
							</div>
			       		</div>
			       		@endforeach
 -->
			       		
			       	</div>
			    </div>
	      	</div>
	   
	      	<!-- YEU CAU DA GUI -->
	      	<div class="tab-pane" id="sended-request">
	        	<div class="list-friends">
			       	<div class="row">
			       		
			       		<!-- @foreach($list_user as $friend)
			       		<div class="col-lg-6 col-md-12 mb-1 friend-{{$friend->id}}">
			       			<div class="card">
							  	<div class="card-body p-2 ">
							  		<div class="respon-card">
								  		<div class="d-flex">
											<div class="avatar" style="width: 50px;height: 50px">
												<a href="">
													<img src="https://img3.thuthuatphanmem.vn/uploads/2019/06/08/hinh-nen-hotgirl-duyen-dang_125438813.jpg" alt="" class="w-100 h-100">
												</a>
											</div>
											<div class="username"><a  href="">{{$friend->username}}</a></div>
										</div>		

										<div class="send mt-1"><button class="btn btn-danger w-100 delete-request">Hủy
											<input type="hidden" class="receive_id" value="{{$friend->id}}">
											
										</button></div>
									
									</div>
							  	</div>
							</div>
			       		</div>
			       		@endforeach

			       		<div class="col-lg-6 col-md-12">
			       			<div class="card">
							  	<div class="card-body d-flex p-2">
									<div class="avatar" style="width: 50px;height: 50px">
										<a href="">
											<img src="https://img3.thuthuatphanmem.vn/uploads/2019/06/08/hinh-nen-hotgirl-duyen-dang_125438813.jpg" alt="" class="w-100 h-100">
										</a>
									</div>
									<div class="d-flex justify-content-between w-100">
										<div class="username"><a  href="">HoangVen</a></div>
										<div class="send mt-1"><button class="btn btn-info">Gui</button></div>
									</div>
							  	</div>
							</div>
			       		</div> -->
			       	</div>
			    </div>
	      	</div>

	      	<!-- TIM KIEM TAT CA BAN BE -->
	      	<div class="tab-pane" id="search-all-friend">

	      		<!-- SEARCH -->
		        <div class="row mb-3">
		        	<div class="col-lg-6 col-md-12">
		       			<!-- form search friend -->
		       			<form id="form-search-all-friends" method="post">
		       				<input type="text" class="form-control key" placeholder="Nhập từ khóa tìm kiếm..." name="key">
							<button class="icon-search" style="
							position: absolute;
						    right: 20px;
						    top: 2px;
						    padding: 7px;
						    font-size: 20px;
						    cursor: pointer;
						    background: white;
						    border: none;
						    color: #d8d8d8;
						    "><i class="fas fa-search"></i></button>
		       			</form>
		       		</div>
		        </div>
	        	<div class="list-friends">
			       	<!-- result search -->
			    </div>
	      	</div>
	      	<!-- BAN BE GOI Y -->
	      	<div class="tab-pane" id="suggestions-friend">

	      		<div class="list-friends">
			       	<div class="row">
			       		
			       		@foreach($list_user as $friend)
			       		<div class="col-lg-6 col-md-12 mb-1 friend-{{$friend->id}}">
			       			<div class="card">
							  	<div class="card-body p-2 ">
							  		<div class="respon-card">
								  		<div class="d-flex">
											<div class="avatar" style="width: 50px;height: 50px">
												<a href="">
													<img src="image/image_avatar/{{$friend->avatar}}" alt="" class="w-100 h-100">
												</a>
											</div>
											<div class="username"><a  href="">{{$friend->username}}</a></div>
										</div>		

										<div class="send mt-1"><button class="btn btn-primary w-100 send-request">Thêm bạn
											<input type="hidden" class="receive_id" value="{{$friend->id}}">
											<!-- <input type="hidden" class="status" value="send"> -->
										</button></div>
									
									</div>
							  	</div>
							</div>
			       		</div>
			       		@endforeach
			       	</div>
			    </div>
	      	</div>

	     
	    </div>
	    <!-- /.tab-content -->
	  </div><!-- /.card-body -->
	</div>
	</div>
</div>
@include('layouts.profile.bottom_profile')
@endsection
@section('script')
<!--  -->
<script  type="text/javascript">
	// 	=== LAY ID CUA NGUOI DUNG===
	var user_id_login = "{{$user->id}}";

	// === AJAX SETTIN HEADER ==
	$.ajaxSetup({
	    headers: {
	        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	    }
	});
	// === CLICK LAY TAT CA TRANG THAI THEO TAB===
		// 1. Tab all friend
	$('.tab-friend').on('click',function(){
		var status = $(this).find('.status').val();
		
		$.ajax({
            url: "{{url('user/get-tab-friend')}}",
	      	dataType:'json',
	      	data: {status:status},
	      	type:'post',
	      	success:function(data){
	      		if(status == 'request'){
	      			$('#received-request .list-friends .row').html(data.html_result);
	      			receiveReuqest();
	      		}
	      		if(status == 'sended'){
	      			$('#sended-request .list-friends .row').html(data.html_result);
	      			deleteRequest();
	      		}
	      		if(status == 'all-friend'){
	      			$('#all-friends .list-friends .row').html(data.html_result);
	      			deleteFriend()
	      			// console.log(data)
	      		}
	      		
	      		
	      	}
		})
		
	})
	// == TIM KIEM TAT CA BAN BE ==
	$('#form-search-all-friends').on('submit',function(e){
		e.preventDefault();
		var key = $(this).find('.key').val();
		
		if(key != ""){
			$.ajax({
	            url: "{{url('user/search-all-friend')}}",
		      	dataType:'json',
		      	data: {key:key},
		      	type:'post',
		      	success:function(data){
		      		console.log(data)
		      		if(data.success){
		      			$('#search-all-friend .list-friends').html(data.user);
		      			sendRequest();
		      		}
		      	}
			})	
		}
		
	})
	

	// == SOCKET LANG NGE SU KIEN KET BAN ====
	// var socket = io('http://localhost:6001');

	// == GUI YEU CAU KET BAN AJAX ==
	sendRequest();
	function sendRequest(){
		$('.send-request').click(function(){
			var receive_id = $(this).find('.receive_id').val();
			$.ajax({
	            url: "{{url('user/send-request-add-friend')}}",
		      	dataType:'json',
		      	data: {receive_id:receive_id},
		      	type:'post',
		      	success:function(data){
		      		$('#suggestions-friend .friend-'+receive_id).remove();
		      		deleteRequest();
		      	}
			})	
			
		})
	}
	// == XOA YEU CAU KET BAN ===
	deleteRequest();
	function deleteRequest(){
		$('.delete-request').click(function(){
			var receive_id = $(this).find('.receive_id').val();
			
			$.ajax({
	            url: "{{url('user/delete-request-add-friend')}}",
		      	dataType:'json',
		      	data: {receive_id:receive_id},
		      	type:'post',
		      	success:function(data){
		      		
		      		$('#sended-request .friend-'+data.result).remove();
		      		console.log(data)
		      		
		      	}
			})	
		})
	}
	// == CHAP NHAN YEU CAU KET BAN AJAX ===
	receiveReuqest();
	function receiveReuqest(){
		$('.received-request').click(function(e){
			e.preventDefault();
			// 1. Chap nhan yeu cau cua ai, send_id
			var send_id = $(this).find('.send_id').val();
			$.ajax({
	            url: "{{url('user/accept-request-add-friend')}}",
		      	dataType:'json',
		      	data: {send_id:send_id},
		      	type:'post',
		      	success:function(data){
		      		
		      		$('#received-request .friend-'+send_id).remove()
		      		console.log(data)
		      	}
			})
			
		})
	}
	// == XOA BAN BE ===
	deleteFriend()
	function deleteFriend(){
		$('.delete-friend').on('click',function(){
			var friend_id = $(this).find('.friend-id').val();
			
			$.ajax({
	            url: "{{url('user/delete-friend')}}",
		      	dataType:'json',
		      	data: {friend_id:friend_id},
		      	type:'post',
		      	success:function(data){
		      		
		      		$('#all-friends .friend-'+friend_id).remove()
		      		console.log(data)
		      	}
			})
		})
	}
</script>
@endsection