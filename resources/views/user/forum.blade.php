@extends('layouts.index')
@section('content')
@include('layouts.profile.head_profile')
<div class="col-lg-3 d-none d-md-block">
	<div class="row bg-padding">
		<div class="introduce">
			<div class="col-lg-12">
				<h1>Gioi Thieu</h1>
				<div class="address">
					<span><i class="fas fa-map-marker-alt mr-3"></i>Can Tho,Viet Nam</span>
				</div>
				<div class="time-join"><span><i class="fas fa-calendar-alt mr-3"></i>Da tham gia 15/09/2020</span></div>
			</div>
		</div>
	</div>
	<div class="row bg-padding mt-3">
		<div class="introduce">
			<div class="col-lg-12">
				<h1>Chia sẻ các điểm du lịch</h1>
				<div class="address">
					<span><i class="fas fa-map-marker-alt mr-3"></i>Can Tho,Viet Nam</span>
				</div>
				<div class="time-join"><span><i class="fas fa-calendar-alt mr-3"></i>Da tham gia 15/09/2020</span></div>
			</div>
		</div>
	</div>
	<!-- cac group cong dong -->
	<?php
	$list_group = \DB::table('group_post')->where('user_id',Auth::user()->id)->get();
	$number = count($list_group);
	?>
	@if($number > 0)
	<div class="row bg-padding mt-3">
		<div class="introduce">
			<h1>Group của bạn</h1>
			<ul>
				@foreach($list_group as $group)
				<li>
					<a href="group-post/admin/{{$group->id}}" class="d-flex">
						<div class="avatar">
							<img src="upload/avatar_group/{{$group->avatar}}" alt="">
							<div class="online"></div>
						</div>
						<div class="username"><h1>{{$group->name}}</h1></div>
					</a>
				</li>
				@endforeach
			</ul>
		</div>
	</div>
	@endif
	
	
</div>
<div class="col-lg-6 col-md-12 diary rating-comment mt-0">
	@for($i=1;$i<=3;$i++)
	<div class="row p-responsive mb-4">
		<div class="bg-white pt-pb-15">
			<div class="col-12 info-user d-flex mb-3">
				<a href="" class="avatar d-block"><img src="image/image_avatar/{{$user->avatar}}" alt=""></a>
				<div class="username-time ml-3 d-flex justify-content-between w-100">
					<div>
						<a href="" class="username">hoang ven</a>
						<span class="time">đã viết bài viêt này vào 4/5/555</span>
					</div>
					<div class="report-follow dropdown dropleft"><i class="fas fa-ellipsis-h" data-toggle='dropdown'></i>
						<div class="dropdown-menu ">
							<a href="" class="dropdown-item">Báo cáo nội dung</a>
							<a href="" class="dropdown-item">Theo dõi</a>
						</div>
					</div>
				</div>

			</div>
			<div class="col-12 info-content">
				
				<div class="row review-image">
					@for($i=1;$i<=6;$i++)
					<div class="col-6 thumb">
						<img src="image/image_avatar/images.jpg" alt="" >
					</div>
					@endfor
					<div class="col-6 thumb thumb-relative">
						<img src="https://dynamic-media-cdn.tripadvisor.com/media/photo-o/1a/6f/e6/7c/r-t-trong.jpg?w=400&h=200&s=1" alt="">
						<div class="overlayy"><div class="number"><span>+ 4</span></div></div>
					</div>
					
					
				
				</div>
				<div class="content">
					<h1 class="title">cho noi cai rang</h1>
				</div>
			</div>
			<div class="col-12 mt-2">
				<a class="link d-flex" href="travel/detail/1">
					<div class="image"><img class="w-100" src="image/image_avatar/images" alt=""></div>
					<div class="info-desc">
						<div class="title"><h1>cho noi cai rang</h1></div>
						<div class="num-star">
							<span class="star">
							<i class="fa fa-star checked"></i>
							<i class="fa fa-star checked"></i>
							<i class="fa fa-star checked"></i>
							<i class="fa fa-star checked"></i>
							<i class="fa fa-star checked"></i>
						</span>
						</div>
						<div class="location"><p>can tho,3/2</p></div>
					</div>
					<a href=""></a>
				</a>
			</div>
		
		</div>
	</div>
	@endfor
	<!-- place user created -->
	<div class="row p-responsive mb-4">
		<div class="bg-white pt-pb-15">
			<div class="col-12 info-user d-flex mb-3">
				<a href="" class="avatar d-block"><img src="https://img3.thuthuatphanmem.vn/uploads/2019/06/08/hinh-nen-hotgirl-duyen-dang_125438813.jpg" alt=""></a>
				<div class="username-time ml-3 d-flex justify-content-between w-100">
					<div>
						<a href="" class="username">HoangVen</a>
						<span class="time">đã viết bài viêt này vào 15/09/2020</span>
					</div>
					<div class="report-follow dropdown dropleft"><i class="fas fa-ellipsis-h" data-toggle='dropdown'></i>
						<div class="dropdown-menu ">
							<a href="" class="dropdown-item">Bao cao noi dung</a>
							<a href="" class="dropdown-item">Theo doi</a>
						</div>
					</div>
				</div>

			</div>
			<div class="col-12 info-content">
				
				<div class="row review-image">
					<div class="col-6 thumb">
						<img src="https://dynamic-media-cdn.tripadvisor.com/media/photo-o/1a/6f/e6/7c/r-t-trong.jpg?w=400&h=200&s=1" alt="" data-toggle='modal' data-target='#modalImage'>
					</div>
					<div class="col-6 thumb">
						<img src="https://dynamic-media-cdn.tripadvisor.com/media/photo-o/1a/6f/e6/7c/r-t-trong.jpg?w=400&h=200&s=1" alt="" data-toggle='modal' data-target='#modalImage'>
					</div>
					<div class="col-6 thumb">
						<img src="https://dynamic-media-cdn.tripadvisor.com/media/photo-o/1a/6f/e6/7c/r-t-trong.jpg?w=400&h=200&s=1" alt="" data-toggle='modal' data-target='#modalImage'>
					</div>
					<div class="col-6 thumb thumb-relative">
						<img src="https://dynamic-media-cdn.tripadvisor.com/media/photo-o/1a/6f/e6/7c/r-t-trong.jpg?w=400&h=200&s=1" alt="">
						<div class="overlayy " data-toggle='modal' data-target='#modalImage'><div class="number"><span>+9</span></div></div>
					</div>
					<!-- <div class="col-6"><img src="https://dynamic-media-cdn.tripadvisor.com/media/photo-o/1a/6f/e6/7c/r-t-trong.jpg?w=400&h=200&s=1" alt=""></div>
					<div class="col-6"><img src="https://dynamic-media-cdn.tripadvisor.com/media/photo-o/1a/6f/e6/7c/r-t-trong.jpg?w=400&h=200&s=1" alt=""></div>
					<div class="col-6"><img src="https://dynamic-media-cdn.tripadvisor.com/media/photo-o/1a/6f/e6/7c/r-t-trong.jpg?w=400&h=200&s=1" alt=""></div>
					<div class="col-6"><img src="https://dynamic-media-cdn.tripadvisor.com/media/photo-o/1a/6f/e6/7c/r-t-trong.jpg?w=400&h=200&s=1" alt=""></div> -->
				</div>
				<div class="content">
					<h1 class="title">Đi đến đây là không muốn về</h1>
				</div>
			</div>
			<div class="col-12 mt-2">
				<a class="link d-flex" href="?page=detail_place">
					<div class="image"><img class="w-100" src="https://dulichtoday.vn/wp-content/uploads/2017/04/vinh-Ha-Long.jpg" alt=""></div>
					<div class="info-desc">
						<div class="title"><h1>Cho noi cai rang</h1></div>
						<div class="num-star">
							<span class="star">
							<i class="fa fa-star checked"></i>
							<i class="fa fa-star checked"></i>
							<i class="fa fa-star checked"></i>
							<i class="fa fa-star checked"></i>
							<i class="fa fa-star checked"></i>
						</span>
						</div>
						<div class="location"><p>Can Tho, Viet Nam</p></div>
					</div>
					<a href=""></a>
				</a>
			</div>
		
		</div>
	</div>
</div>
@include('layouts.profile.bottom_profile')
@endsection
@section('script')
<script  type="text/javascript">
	$(document).ready(function(){
		// 1. Change password by ajax
		
	})
</script>
@endsection