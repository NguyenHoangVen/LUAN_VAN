<?php
$user = Auth::user();

?>
<div class="col-lg-4 col-md-12 your-group p-0 scroll-sidebar-group">
	<div class="profile">
		<div class="d-flex">
			<div class="image-avatar">
				<a href="" class="avatar d-block"><img src="{{asset('image/image_avatar/')}}/{{$user->avatar}}" alt=""></a>
			</div>
			<div class="username"><b>{{$user->username}}</b></div>
		</div>
		<div class="row pt-2">
			<div class="col-10">
				<form action="{{url('group-post/search')}}" method="get" class="form-search-group" style="position: relative">
					<input type="text" class="form-control key" id="search-group" placeholder="Tìm hoặc tạo nhóm" name="key">
					<button class="icon-search" style="
					position: absolute;
				    right: 1px;
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
			<div class="col-2">
				<div type="text" class="btn btn-success" data-toggle='modal' data-target='#createNewGroup'><i class="fas fa-plus"></i></div>
				<!-- Modal tao moi group -->
				<div id="createNewGroup" class="modal fade">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<h4 class="modal-title">Tạo nhóm mới</h4>
								<button type="button" class="close" data-dismiss="modal">&times;</button>
							</div>
							<div class="modal-body">
								<div class="container">
									<form action="" id="formCreateGroupPost">
										<div class="row">
										
											<div class="col-12 form-group">
												<label for="">Tên nhóm <span style="color: red">*</span></label>
												<p class="form-error error-name-group"></p>
												<input type="text" class="form-control" name="name_group"
												id="name_group">
											</div>
											<div class="col-12">
												<div class="form-group">
													<label for="email">Ảnh đại diện nhóm</label>
													<p class="form-error error-file-group"></p>
													<div class="choseFile custom-file">
														<input type="file" class="custom-file-input file-avatar-group" name="image">
														<div class="icon-image"></div>
														<!-- image delete -->
														<div id="file_hidden"></div>
														<!--  -->
													</div>
													
												</div>
												<div class="avatar-group center-webkit mb-3">
													<div id="ven"></div>
												</div>

											</div>
											<div class="col-12">
												<button class="btn btn-success w-100">Tạo</button>
											</div>
										
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
				
			</div>
			
		</div>
	</div>

	<!-- end profile -->
	<!-- Quan li group -->
	<?php 
	// Nhóm do mình quản lí
	$list_group = \DB::table('group_post')->where('user_id',Auth::user()->id)->get();
	$number_1 = count($list_group);
					
	// Nhóm của mình
	global $groups;
	$groups = \DB::table('member_group_post')
            ->where('member_group_post.user_id',Auth::user()->id)
            ->where('member_group_post.status','member')
            ->join('group_post','group_post.id','=','member_group_post.group_id')
            ->get();
    $number = count($groups);
    ?>
    @if($number_1 > 0)
	<div class="list-group group-manage">
		<h1 style="font-size: 20px;
		    font-weight: bold;
		    color: #adabab;">Nhóm do bạn quản lí</h1>
		<ul>
            @foreach($list_group as $item)
			<li class="group-item ">
				<a href="{{url('group-post')}}/admin/{{$item->id}}" class="d-flex">
					<div class="avatar-group avatar mr-3">
					<img src="upload/avatar_group/{{$item->avatar}}" alt="">
					</div>
					<div class="name-group">
						<h2>{{$item->name}}</h2>
					</div>
				</a>
			</li>
			@endforeach

			
		</ul>
	</div>
	@endif
	<!-- Nhom cua minh -->
    @if($number > 0)
	<div class="list-group group-member">
		<h1 style="font-size: 20px;
		    font-weight: bold;
		    color: #adabab;">Nhóm của bạn</h1>
		<ul>
            @foreach($groups as $item)
			<li class="group-item ">
				<a href="{{url('group-post')}}/detail/{{$item->id}}" class="d-flex">
					<div class="avatar-group avatar mr-3">
						<img src="upload/avatar_group/{{$item->avatar}}" alt="">
					</div>
					<div class="name-group">
						<h2>{{$item->name}}</h2>
					</div>
				</a>
			</li>
			@endforeach

			
		</ul>
	</div>
	@endif

</div>
