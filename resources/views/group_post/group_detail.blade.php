@extends('layouts.index')
@section('content')
<div id="content " class="pd-group">
	
	<div class="container group-post">
		<div class="row">
			<!-- sidebar_group -->
			@include('group_post.sidebar_group')
			
			<!-- List post in group -->
			<div class="col-lg-8 post-group">
				<div class="group-item g-select d-flex justify-content-between">
					<div class="d-flex">
						<div class="avatar-group avatar mr-3">
							<img src="{{asset('upload/avatar_group')}}/{{$group->avatar}}" alt="">
						</div>
						<div class="name-group">
							<h2>{{$group->name}}</h2>
						</div>
					</div>
					<!-- new post -->
					
					<div class="new-post">
						<button type="text" class="btn btn-success" data-toggle='modal' data-target='#createPostOnGroup'
						
						<?php
						if(!checkMember(Auth::user()->id,$group->id)){
							echo "disabled=''";
						
						}
						?>
						>Đăng bài</button>
						
						<div class="btn btn-primary dropdown " >
							<i class="fas fa-ellipsis-h"  aria-expanded="false" data-toggle="dropdown"></i>
							<div class="dropdown-menu dropdown-menu-right">
								<div class="dropdown-item"  data-toggle="modal" data-target="#modalMemberGroup">Thành viên nhóm</div>
								@if(checkMember(Auth::user()->id,$group->id))
								<div class="dropdown-item my-post" >Bài viết bạn đóng góp</div>
								@endif
							</div>
						</div>
						<!--  -->
						
						
					</div>
					

				</div>
				<!-- Danh sach cac bai viet cua nhom -->
				<?php 
				$number = count($list_post);
				?>
				@if($number > 0)
				<div class="list-post scroll-post-group">
					@foreach($list_post as $post)
					<div class="post-item post-item{{$post->id}}">
						<div class="info-user d-flex">
							<div class="image-avatar mr-3">
								<a href="" class="avatar d-block"><img src="image/image_avatar/{{$post->user->avatar}}" alt=""></a>
							</div>
							<div class="create d-flex justify-content-between w-100">
								<div>
									<div class="username">{{$post->user->username}}</div>
									<div class="time">{{$post->created_at->format('d-m-Y')}}</div>
								</div>
								<!-- Bao cao bai viet -->
								<div class="report-post dropdown dropleft"><i class="fas fa-ellipsis-h" data-toggle="dropdown" aria-expanded="false"></i>
									<div class="dropdown-menu" style="">
										
										@if(Auth::user()->id == $post->user_id)
										<div class="dropdown-item edit-post" data-toggle='modal' data-target='#editPostOnGroup'>Chỉnh sửa bài viết
											<input type="hidden" class="post_id" value="{{$post->id}}">
										</div>
										<div class="dropdown-item delete-post">Xóa bài viết này
											<input type="hidden" class="post_id" value="{{$post->id}}">
										</div>
										@else
										<div class="dropdown-item" data-toggle='modal' data-target='#reportPost{{$post->id}}'>Báo cáo nội dung</div>
										@endif
									</div>
									<!-- modal report post -->
									<div id="reportPost{{$post->id}}" class="modal fade" style="cursor: default;">
										<div class="modal-dialog">
											<form action="{{url('group-post/report')}}" class="form-report-post" method="post">
												@csrf
												<div class="modal-content">
													<div class="modal-header">
														<h4 class="modal-title">Báo cáo bài viết</h4>
														<button type="button" class="close" data-dismiss="modal">&times;</button>
												        
													</div>
													<div class="modal-body">
														<textarea class="form-control content-report" name="reason" rows="5" placeholder="Lý do báo cáo bài viết..."
														></textarea>
														<!-- success report -->
														<div class="success-msg mt-2 mb-2 d-none">
															<div class="alert alert-success">Đã gửi nội dung báo cáo!</div>
														</div>
													</div>
													
								
													<div class="modal-footer">
														<button type="submit" class="btn btn-success send-report" disabled="" >Gửi</button>
													</div>
													<!-- input hidden -->
													<input type="hidden" class="report-post-id" value="{{$post->id}}">
													<input type="hidden" class="user-report" value="{{Auth::id()}}">
												</div>
											</form>
										</div>
									</div>
									<!-- /. Modal bao cao bai viet -->



								</div>
							</div>
							
						</div>
						<!-- post content -->
						<div class="post-content ">
							<div class="title">{{$post->title}}</div>
							<div class="content">{!!$post->content!!}</div>
							<!-- xem them -->
							<a href="" data-toggle="modal" data-target="#myModal{{$post->id}}">Xem them...</a>
							
						</div>
						<!-- comment post -->
						<div class="comment-post">
							
							<!-- list comment -->
							<?php 
							$comments = count($post->comments);
							?>
							<ul class="list-comment post-id-{{$post->id}}">
								<!-- truong hop chua co binh luan con -->
								@foreach($post->comments as $comment)
								@if($comment->parent_id == 0)
								<li class="mt-2">
									<div class="comment-parent d-flex">
										<div class="image-avatar mr-3">
											<a href="" class="avatar d-block"><img src="image/image_avatar/{{$comment->user->avatar}}" alt=""></a>
										</div>
										<div class="content">
											
											<h2 class="username font-15">{{$comment->user->username}}</h2>
											<span class="font-15">{{$comment->content}}</span>
											<!--  -->
					
											
											@if(checkMember(Auth::user()->id,$group->id))
											<div class="reply">
												<!-- chen id cua binh luan cha tai class -->
												<b class="{{$comment->id}}">Tra loi<input type="hidden" name="user" value="{{$comment->user->username}}"></b>
												
											</div>
											@endif
											
										</div>
									</div>
									<div class="comment-child d-flex child-comment-{{$comment->id}}">
										<ul>
											@foreach($post->comments as $comment_child)
											@if($comment_child->parent_id == $comment->id)
											<li class="mt-2">
												<div class="d-flex">
													<div class="image-avatar mr-3">
														<a href="" class="avatar d-block"><img src="image/image_avatar/{{$comment_child->user->avatar}}" alt=""></a>
													</div>
													<div class="content">
														<h2 class="username font-15">{{$comment_child->user->username}}</h2>
														<span class="font-15">{{$comment_child->content}}</span>
														<!-- Chi thanh vien moi dc bl -->
														@if(checkMember(Auth::user()->id,$group->id))
														<div class="reply">
															<!-- chen id cua binh luan cha tai class -->
															<b class="{{$comment->id}}"  onclick="">Tra loi<input type="hidden" name="user" value="{{$comment_child->user->username}}"></b>
															
														</div>
														@endif
														
													</div>
												</div>

											</li>
											@endif
											@endforeach
											<div class="input-reply">
												<div class="user-comment-child-{{$comment->id}}  d-none">
													<div class="d-flex">
														<div class="image-avatar mr-3">
															<a href="" class="avatar d-block"><img src="image/image_avatar/{{Auth::user()->avatar}}" alt=""></a>
														</div>
														<input type="text" name="comment-parent" class="input-comment user-reply-comment-{{$comment->id}}" placeholder="Nhập bình luận...">
														<input type="hidden" name="post_id" class="post_id" value="{{$post->id}}">
														<input type="hidden" class="parent_id" value="{{$comment->id }}">
														<input type="hidden" class="user_comment" value="{{Auth::user()->id}}" >
													</div>	
												</div>
											</div>
										</ul>
										
									</div>
									
								</li>

								@endif
								@endforeach
								
							</ul>
							<!-- Box comment -->
							@if(checkMember(Auth::user()->id,$group->id))
							<div class="user-comment-parent d-flex pt-2">
								<div class="image-avatar mr-3">
									<a href="" class="avatar d-block"><img src="image/image_avatar/{{Auth::user()->avatar}}" alt=""></a>
								</div>
								<input type="text" name="comment-parent" class="input-comment input-comment-parent" placeholder="Nhập bình luận...">
								<input type="hidden" name="post_id" class="post_id" value="{{$post->id}}">
								<input type="hidden" class="parent_id" value="0">
								<input type="hidden" class="user_comment" value="{{Auth::user()->id}}" >
							</div>
							@endif
							
						</div>
						<!-- Modal xem nhieu cua bai viet -->
						
						<div class="modal" id="myModal{{$post->id}}">
						  	<div class="modal-dialog modal-lg">
						    	<div class="modal-content">

						      <!-- Modal Header -->
							      	<div class="modal-header">
							        	<h4 class="modal-title">Chi tiết bài viết</h4>
							        	<button type="button" class="close" data-dismiss="modal">&times;</button>
							      	</div>

						      <!-- Modal body -->
							      	<div class="modal-body post-group">
							        	<div class="post-item">
											<div class="info-user d-flex">
												<div class="image-avatar mr-3">
													<a href="" class="avatar d-block"><img src="image/image_avatar/{{$post->user->avatar}}" alt=""></a>
												</div>
												<div class="create">
													<div class="username">{{$post->user->username}}</div>
													<div class="time">{{$post->created_at->format('d-m-Y')}}</div>
												</div>
											</div>
											<!-- post content -->
											<div class="post-content">
												<div class="title">{{$post->title}}</div>
												<div>{!!$post->content!!}</div>
												
											</div>

										</div>
											<!-- comment post -->
											
									</div>
							    </div>

						    

						    </div>
						</div>
					</div>
						
					
					@endforeach
					
				</div>
				@else
				<div class="list-post">
					<div class="alert alert-info">Chưa có bài viết nào trong nhóm này</div>
				</div>
				@endif

				<!-- Modal send id process post -->
					
				<!-- end modal -->
			</div>
			
		</div>
	</div>
	<!-- ======= MODAL ======== -->
	<div id="editPostOnGroup" class="modal fade">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Chỉnh sửa bài viết</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body">
					<div class="container">
						<form id="formEditPostGroup" method="post">
							
							<div class="row">
							
								<div class="col-12 form-group">
									<label for="">Tiêu đề bài viết <span style="color: red">*</span></label>
									<p class="form-error error-title"></p>
									<input type="text" class="form-control title-post" name="title">
									<input type="hidden" class="post_id" value="">
								</div>
								<div class="col-12 form-group">
									<label for="">Nội dung bài viết <span style="color: red">*</span></label>
									<p class="form-error error-content"></p>
									<textarea name="content" class="content-post summernote"></textarea>
					                
								</div>
								<div class="col-12">
									<button class="btn btn-success w-100">Cập Nhật</button>
								</div>
							
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Modal tao moi bai viet tren nhóm -->
	<div id="createPostOnGroup" class="modal fade">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Đăng bài lên nhóm</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body">
					<div class="container">
						<form action="{{url('group-post/create-post')}}" id="formPostGroup" method="post">
							 @csrf
							<div class="row">
							
								<div class="col-12 form-group">
									<label for="">Tiêu đề bài viết <span style="color: red">*</span></label>
									<p class="form-error error-title"></p>
									<input type="text" class="form-control title-post" name="title">
									<input type="hidden" name="group_id" value="{{$group->id}}">
								</div>
								<div class="col-12 form-group">
									<label for="">Nội dung bài viết <span style="color: red">*</span></label>
									<p class="form-error error-content"></p>
									<textarea  name="content" class="summernote content-post"></textarea>
					                
								</div>
								<div class="col-12">
									<button class="btn btn-success w-100">Đăng</button>
								</div>
							
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Modal member in group -->
	<div id="modalMemberGroup" class="modal fade modal-member-group">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<?php $num = count($group->members) ?>
					<h4 class="modal-title">Thành viên của nhóm ({{$num}} Thành viên)</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					
				</div>
				<div class="modal-content container">
					<div class="row">
						@foreach($group->members as $member)
						<div class="col-6">
							<div class="info-user d-flex">
								<div class="image-avatar mr-3">
									<a href="" class="avatar d-block"><img src="image/image_avatar/{{$member->user->avatar}}" alt=""></a>
								</div>
								<div class="create">
									<a href="" class="username">{{$member->user->username}}</a>
									<div class="time">{{$member->created_at->format('d-m-Y')}}</div>
								</div>
							</div>
						</div>
						@endforeach

					</div>
				</div>
				<div class="modal-footer">
		          	<a href="group-post/leave-group/{{Auth::user()->id}}/{{$group->id}}" class="btn btn-danger" onclick="return confirm('Bạn có muốn rời khỏi nhóm ?')">Rời nhóm</a>
		        </div>
			</div>
		</div>
	</div>
	
	<!-- Modal  -->

<!-- ======= END MODAL======= -->
</div>


@endsection
@section('script')
<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.3.0/socket.io.dev.js"></script> -->
<!-- Script cho phan sidebar -->

<!-- SCRIPT CHO PHAN DETAIL -->
<script>
	// Thong bao dang bai thanh cong
	var exist = '{{Session::has('create_post_success')}}';
    if(exist){
        Swal.fire({
	        position: 'center',
	        icon: 'success',
	        title: 'Đăng bài thành công !',
	        // showConfirmButton: false,
	        button:'ok'
	        // timer: 1800
	    })
    }

    // ================QUẢN LÍ BÀI VIẾT CÁ NHÂN=============
    // 1. Bai viet da dong gop
    $('.my-post').click(function(e){
    	var id_group = "{{$group->id}}";
    	var user_id = "{{Auth::user()->id}}";
    	$.ajax({
			headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "group-post/edit/"+id_group+'/'+user_id,
	      	data: "",
            cache: false,
	      	type:'get',
	      	success:function(data){
	      		$('.list-post').html(data);
	      		console.log(data)
	      		sendReport();
				disableReport();
				clickmodel();
				comment();
				editPost();
				checkUpdateEmpty();
				deletePost();
	      	}
		})
    	
    })
    // 2. Chinh sua bai viet
    editPost();
    function editPost(){
    	$('.edit-post').click(function(){
    		var post_id = $(this).find('.post_id').val();
    		console.log(post_id)
    		$('.error-title').html(' ');
			$('.error-content').html(' ');
    		$.ajax({
				headers: {
	                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	            },
	            url: "{{url('group-post/get-post-edit')}}",
		      	data: {post_id:post_id},
		      	type:'post',
		      	dataType:'json',

		      	success:function(data){
		      		console.log(data)
		      		$('#editPostOnGroup .title-post').val(data.success.title);
		      		$('#editPostOnGroup .summernote').summernote('code', data.success.content);
		      		$('#editPostOnGroup .post_id').val(data.success.id);
		      	}
			})

    	})
    }
    checkUpdateEmpty();
    function checkUpdateEmpty(){
	    $('#editPostOnGroup').on('submit',function(e){
	    	e.preventDefault();
	    	var title = $('.title-post').val();
			var content = $('.content-post').val();
			var post_id = $('.post_id').val();

			console.log(post_id);
			
			
			if(title == "" || content == ""){
				if(title == ""){
					alert('Bạn chưa nhập tiêu đề bài viết')
					// $('.error-title').html('Bạn chưa nhập tiêu đề');
				}
				if(content == ""){
					alert('Bạn chưa nhập nội dung bài viết')
					// $('.error-content').html('Bạn chưa nhập nội dung bài viết')
				}
				
			}

			// Cap nhat lai bai viet
			if(title != "" && content != ""){
				$.ajax({
					headers: {
		                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		            },
		            url: "{{url('group-post/update-post')}}",
			      	data: {title:title,content:content,post_id:post_id},
			      	type:'post',
			      	dataType:'json',
			      	success:function(data){
			      		$('#editPostOnGroup').modal('hide');
			      		$('.title-post').val('');
						$('.content-post').val('');
						
						$('.post-item'+post_id).find('.post-content .title').html(data.success.title);
						$('.post-item'+post_id).find('.post-content .content').html(data.success.content);
						console.log(data)

			      		
			      	}
				})
			}
	    	
	    })
	}

	// 3. Xoa bai viet
	deletePost();
	function deletePost(){
		$('.delete-post').click(function(){
			var check = confirm('Bạn có chắc muốn xóa?');
			if(check == true){
				var post_id = $(this).find('.post_id').val();
				$.ajax({
					headers: {
		                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		            },
		            url: "{{url('group-post/delete-post')}}",
			      	data: {post_id:post_id},
			      	type:'post',
			      	dataType:'json',

			      	success:function(data){
			      		console.log(data)
			      		if(data.success){
			      			$('.post-item'+post_id).remove();
			      		}
			      	}
				})
			}else{
				alert('k xoa')
			}	
		})
	}
    // ================================================
	// Kiem tra nhap rong khi tao bai viet tren group
	$('#createPostOnGroup').on('shown.bs.modal', function () {
		
			$('#formPostGroup').on('submit',function(e){
				var title = $(this).find('.title-post').val();
				var content = $(this).find('.content-post').val();
				
				console.log(content);
				$('.error-title').html(' ');
				$('.error-content').html(' ');
				if(title == "" || content == ""){
					if(title == ""){
						$('.error-title').html('Bạn chưa nhập tiêu đề');
					}
					if(content == ""){
						$('.error-content').html('Bạn chưa nhập nội dung bài viết')
					}
					e.preventDefault();
				}
			
				
			})
  		
	})


	// == BAO CAO BAI VIET=====
	sendReport();
	disableReport();
	function sendReport(){
		$('.form-report-post').on('submit',function(e){
			var content = $(this).find('.content-report').val();
			var post_id = $(this).find('.report-post-id').val();
			var user_report = $(this).find('.user-report').val();
			var data = {post_id:post_id,user_report:user_report,content:content};
			$(this).find('.content-report').val('');
			$.ajax({
				headers: {
	                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	            },
	            url: "{{url('group-post/report')}}",
		      	dataType:'json',
		      	data: data,
		      	type:'post',
		      	success:function(data){
		      		console.log(data)
		      		if(data.success){
	            		
	            		$('.success-msg').removeClass('d-none');
						var a = setInterval(function(){ 
				            $('.success-msg').addClass('d-none');
				            $('#reportPost'+post_id).modal('hide');
				            
				            clearInterval(a);
				        }, 2500);
				        
	            	}
		      	}
			})
			
			e.preventDefault()
		})
	}
	function disableReport(){
		$('.content-report').on('change keyup paste',function(){
			
			if($(this).val() == ''){
				$('.send-report').attr('disabled','disabled');   
			}else{
				$('.send-report').removeAttr('disabled')
			}
			
		})
	}
	

	// ===SOCKET BINH LUAN REALTIME BAI VIET===
	var socket = io('http://localhost:6001');
	// -- Lang nge su kien binh luan cua nguoi dung
	socket.on('laravel_database_comment_post:comment_post_group',function(data){
	
		// Nhan du lieu ve, hien thi len html
		if(data.data_comment.parent_id == 0){
  			$('.post-id-'+data.data_comment.post_id).append(data.data_comment.data_html);
  			clickmodel();
  			comment();
  		}else{
  		
  			$(data.data_comment.data_html).insertBefore($('.post-id-'+data.data_comment.post_id).find('.child-comment-'+data.data_comment.parent_id+' .input-reply'));
  			clickmodel();
  			// comment();
  		}
		
	})
	
	// -- Binh luan bai viet
	function comment(){
		$('.input-comment').on('keyup',function(e){
			if(e.key === 'Enter'){
				if($(this).val() != ""){
					
					var post_id = $(this).next('.post_id').val();
					var content = $(this).val();
					var parent_id = $(this).nextAll('.parent_id').val();
					var user_comment = $(this).nextAll('.user_comment').val();
					console.log(parent_id)
					var data = {user_comment:user_comment,parent_id:parent_id,post_id:post_id,content:content};
					console.log(data);
					
					$.ajax({
						headers: {
			                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			            },
			            url: "{{url('group-post/post/comment')}}",
				      	dataType:'json',
				      	data: data,
				      	type:'post',
				      	success:function(data){
				      		// if(parent_id == 0){
				      		// 	$('.post-id-'+post_id).append(data.data);
				      		// 	clickmodel();
				      		// 	comment();
				      		// }else{
				      		
				      		// 	$(data.data).insertBefore($('.post-id-'+post_id).find('.child-comment-'+parent_id+' .input-reply'));
				      		// 	clickmodel();
				      		// }
				      		
				        // 	console.log(data);
				      	}
					})
					$(this).val('');
				}
				
			}
		})
	}
	
	
	$('.input-comment-parent').click(function(){
		comment();
	})
	clickmodel();
	function clickmodel(){
		$('.reply b').click(function(){
		// -Can xu li tai 2 class ben duoi, va cho cai reply event click
			var id = $(event.target).attr('class');
			$('.user-comment-child-'+id).removeClass('d-none');

			var name = $(this).find('input').val();
			$('.user-reply-comment-'+id).val(name+' ');
			console.log(name);
			comment();
		})
	}
	// /.Tra loi tin nhan, nguoi dugn binh luan
</script>
<!-- Script summernote Editor  -->
<script>
//   $(function () {
//     // Summernote
//     $('.summernote').summernote()
// 	})
	 

</script>
@endsection
