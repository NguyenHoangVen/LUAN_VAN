@extends('layouts.index')
@section('content')
<div id="content " class="pd-group">
	<div class="container group-post">
		<div class="row">
			<!-- Sidebar group -->
			@include('group_post.sidebar_group')
			<!-- List post in group -->
			<div class="col-8 post-group">
				<!-- group search  -->
				@if(count($list_group) > 0)
				@foreach($list_group as $item)
				<div class="group-item g-select d-flex justify-content-between">
					<a href="{{url('group-post')}}/detail/{{$item->id}}" class="d-flex">
						<div class="avatar-group avatar mr-3">
							<img src="upload/avatar_group/{{$item->avatar}}" alt="">
						</div>
						<div class="name-group">
							<h2>{{ucfirst($item->name)}}</h2>
							<p class="num-member"><i class="fas fa-users"></i> 145 thanh vien</p>
						</div>
					</a>
					<!-- new post -->
					
					<div class="group-item{{$item->id}}">				
						@if(isMemberGroup(Auth::user()->id,$item->id))
						@if(getStatusMemberGroup(Auth::user()->id,$item->id) == 'pending')
						<div type="text" class="btn btn-danger delete-request">Hủy yêu cầu
							<input type="hidden" name="id_group" class="id_group_post" value="{{$item->id}}">
							<input type="hidden" name="status" class="status-request" value="delete">
						</div>
						<div type="text" class="btn btn-success join-group-post d-none">Tham gia nhóm
							<input type="hidden" name="id_group" class="id_group_post" value="{{$item->id}}">
							<input type="hidden" name="status" class="status-request" value="join">
						</div>
						@else
						<div type="text" class="btn btn-success">Thanh Vien
							
						</div>
						@endif
						@else
						<div type="text" class="btn btn-success join-group-post">Tham gia nhóm
							<input type="hidden" name="id_group" class="id_group_post" value="{{$item->id}}">
							<input type="hidden" name="status" class="status-request" value="join">
						</div>
						<div type="text" class="btn btn-danger delete-request d-none">Hủy yêu cầu
							<input type="hidden" name="id_group" class="id_group_post" value="{{$item->id}}">
							<input type="hidden" name="status" class="status-request" value="delete">
						</div>
						@endif

						<div class="btn btn-primary" data-toggle='modal' data-target='#modalMemberGroup{{$item->id}}'><i class="fas fa-ellipsis-h"></i></div>
					</div>
					<!-- Modal danh sach thanh vien cua nhom -->
						<!-- Modal member in group --> 
					<div id="modalMemberGroup{{$item->id}}" class="modal modal-member-group">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<?php $num = count($item->members)?>
									<h4 class="modal-title">Thành viên của nhóm ({{$num}} Thành viên)</h4>
									<button type="button" class="close" data-dismiss="modal">&times;</button>
									
								</div>
								<div class="modal-content container">
									<div class="row">
										@foreach($item->members as $member)
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
								
							</div>
						</div>
					</div>
					
				</div>
				@endforeach
				@else
				<div class="alert alert-danger">Không tìm thấy kết quả <span class="rerror-form">gfd</span><?php echo $_GET['key'] ?></div>
				@endif
				<!--  -->
				
			</div>
		</div>
	</div>
	<!-- ======= MODAL ======== -->
	
	



<!-- ======= END MODAL======= -->
</div>


@endsection
@section('script')
<!-- Script cho phan sidebar -->

<script>
	$('.join-group-post, .delete-request').click(function(){
		var status_request = $(this).find('.status-request').val();
		var id_group = $(this).find('.id_group_post').val();
		console.log(status_request)
		console.log(id_group)
		if(status_request == 'join'){
			$('.group-item'+id_group).find('.join-group-post').addClass('d-none');
			$('.group-item'+id_group).find('.delete-request').removeClass('d-none');
		}else{
			$('.group-item'+id_group).find('.join-group-post').removeClass('d-none');
			$('.group-item'+id_group).find('.delete-request').addClass('d-none');
		}
		var data = {status_request:status_request,id_group:id_group};
	
		$.ajax({
			headers: {
	          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	        },
	        url: 'group-post/join-group-ajax',
	        dataType:'text',
	        data: data,
	        type:'post',
	        success:function(data){
	        	console.log(data);
	        }
		})
		
		
	})
</script>
@endsection