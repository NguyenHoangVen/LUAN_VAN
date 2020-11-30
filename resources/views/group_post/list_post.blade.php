<?php $number = count($list_post)?>
@if($number > 0)
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
									<textarea class="form-control content-report" name="reason" rows="5" placeholder="Lý do báo cáo bài viết..."></textarea>
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
	<div class="post-content">
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
					
											
											<div class="reply">
												<!-- chen id cua binh luan cha tai class -->
												<b class="{{$comment->id}}">Tra loi<input type="hidden" name="user" value="{{$comment->user->username}}"></b>
												
											</div>
											
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
														
														<div class="reply">
															<!-- chen id cua binh luan cha tai class -->
															<b class="{{$comment->id}}"  onclick="">Tra loi<input type="hidden" name="user" value="{{$comment_child->user->username}}"></b>
															
														</div>
														
													</div>
												</div>

											</li>
											@endif
											@endforeach
											<div class="input-reply">
												<div class="user-comment-child-{{$comment->id}}  d-none">
													<div class="d-flex">
														<div class="image-avatar mr-3">
															<a href="" class="avatar d-block"><img src="https://img3.thuthuatphanmem.vn/uploads/2019/06/08/hinh-nen-hotgirl-duyen-dang_125438813.jpg" alt=""></a>
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
							
							<div class="user-comment-parent d-flex pt-2">
								<div class="image-avatar mr-3">
									<a href="" class="avatar d-block"><img src="https://img3.thuthuatphanmem.vn/uploads/2019/06/08/hinh-nen-hotgirl-duyen-dang_125438813.jpg" alt=""></a>
								</div>
								<input type="text" name="comment-parent" class="input-comment" placeholder="Nhập bình luận...">
								<input type="hidden" name="post_id" class="post_id" value="{{$post->id}}">
								<input type="hidden" class="parent_id" value="0">
								<input type="hidden" class="user_comment" value="{{Auth::user()->id}}" >
							</div>
							
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
@else
<div class="list-post">
	<div class="alert alert-info">Bạn chưa có bài viết nào đóng góp trong nhóm này</div>
</div>
@endif