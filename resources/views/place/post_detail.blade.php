@extends('layouts.index')
@section('content')
<?php
	$image_topic = json_decode($post_review->topic->image)[0];
	
?>
<div id="content">
	<div class="overview-place" id="forum">
		<div class="post bk-img overlay" style="background-image: url('image/image_place/{{$image_topic}}')">
			<div class="container ">
				<div class="row">
					<div class="col-md-12 banner-title text-center">
						<a href="{{url('topic')}}/{{$post_review->topic_id}}" class="post-title mb-20 d-block">{{$post_review->topic->name}}</a>
						<div class="info-create d-flex justify-content-center ">
							<a href="" class="avatar"><img src="image/image_avatar/{{$post_review->topic->user->avatar}}" alt=""></a>
							<span class="username align-self-center">{{$post_review->user->username}}</span>
							<span class="create-date align-self-center"><i class="fas fa-calendar-alt">  {{$post_review->topic->created_at->format('d-m-Y')}}</i></span>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Chi tiet bai post -->
		<div id="detail_post_forum">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="topic-title-head d-flex">
						<span class="topic">[Chia sẻ]</span>
						<h2 href="?page=detail_post_forum" class="title"> <?php echo "_". ucwords($post_review->title) ?></h2>
					</div>
				</div>
			</div>
			
		</div>

		<div class="container detail">
			<div class="row">
				<div class="col-lg-8 col-md-12">
					<div class="row p-broder">
						<div class="col-lg-2 col-md-12 avatar-center">
							<div class="image-avatar"><a href="" class="avatar d-block"><img src="image/image_avatar/{{$post_review->user->avatar}}" alt=""></a></div>
							<div class="username"><h1>{{$post_review->user->username}}</h1></div>
						</div>
						<div class="col-lg-10 col-md-12 post-content">
							<div class="date">{{$post_review->created_at->format('d-m-Y')}}</div>
							<!-- Noi dung -->
							{!!$post_review->content!!}
						</div>	
					</div>
				</div>
				<div class="col-lg-4 col-md-12">
					<div class="row p-broder">
						<div class="col-12">
							<div class="title-new"><h1>Bài viết liên quan</h1></div>
								<ul class="list-post mb-2">
									<li class="d-flex">
										<a href="" class="avatar d-block mr-3"><img src="https://img3.thuthuatphanmem.vn/uploads/2019/06/08/hinh-nen-hotgirl-duyen-dang_125438813.jpg" alt=""></a>
										<div class="info-desc">
											<div class="topic-title">
												<span class="topic">[Chia sẻ]</span>
												<a href="?page=detail_post_forum" class="title">Mien Nam than thuong</a>
											</div>
											<div class="time mt-2"><i class="fas fa-calendar-alt mr-1"></i> 10/13/2020</div>
										</div>
									</li>
									<li class="d-flex">
										<a href="" class="avatar d-block mr-3"><img src="https://img3.thuthuatphanmem.vn/uploads/2019/06/08/hinh-nen-hotgirl-duyen-dang_125438813.jpg" alt=""></a>
										<div class="info-desc">
											<div class="topic-title">
												<span class="topic">[Chia se]</span>
												<a href="?page=detail_post_forum" class="title">LÀO CAI-HÀ GIANG NHỮNG NGÀY CHỚM SANG ĐÔNG</a>
											</div>
											<div class="time mt-2"><i class="fas fa-calendar-alt mr-1"></i> 10/13/2020</div>
										</div>
									</li>
									<li class="d-flex">
										<a href="" class="avatar d-block mr-3"><img src="https://img3.thuthuatphanmem.vn/uploads/2019/06/08/hinh-nen-hotgirl-duyen-dang_125438813.jpg" alt=""></a>
										<div class="info-desc">
											<div class="topic-title">
												<span class="topic">[Chia se]</span>
												<a href="?page=detail_post_forum" class="title">Mien Nam than thuong</a>
											</div>
											<div class="time mt-2"><i class="fas fa-calendar-alt mr-1"></i> 10/13/2020</div>
										</div>
									</li>
									<li class="d-flex">
										<a href="" class="avatar d-block mr-3"><img src="https://img3.thuthuatphanmem.vn/uploads/2019/06/08/hinh-nen-hotgirl-duyen-dang_125438813.jpg" alt=""></a>
										<div class="info-desc">
											<div class="topic-title">
												<span class="topic">[Chia se]</span>
												<a href="?page=detail_post_forum" class="title">LÀO CAI-HÀ GIANG NHỮNG NGÀY CHỚM SANG ĐÔNG</a>
											</div>
											<div class="time mt-2"><i class="fas fa-calendar-alt mr-1"></i> 10/13/2020</div>
										</div>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
			

		</div>

		<!-- form comment -->
		<div class="form-comment" data-toggle='modal' data-target='#myComentPost'>
			<i class="far fa-comment-alt"></i>
		</div>
		<div id="myComentPost" class="modal fade">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title"><i class="fas fa-edit mr-2 "></i>Đặt câu hỏi, bình luận</h4>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>
					<div class="modal-body">
						<h1>Mời bạn đặt câu hỏi hoặc bình luận</h1>
						<div class="wp-form-comment d-flex">
							<a href="" class="avatar d-inline-block mr-2"><img src="https://img3.thuthuatphanmem.vn/uploads/2019/06/08/hinh-nen-hotgirl-duyen-dang_125438813.jpg" alt=""></a>
							<form action="" method="post" class="w-100">
								<textarea name="" id="" class="w-100" rows="10" placeholder="Mời bạn nhập..."></textarea>
								<button class="btn btn-primary">Send</button>
								<button class="btn btn-danger" data-dismiss="modal">Huy</button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	</div>		
</div>
<!-- XU LÝ HIỂN THỊ CÁC ĐỊA ĐIỂM GẦN LÊN BẢN ĐỒ -->

@endsection
