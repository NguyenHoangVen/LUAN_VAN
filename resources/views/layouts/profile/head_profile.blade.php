<?php 
$user = Auth::user();
?>
<div id="content">
	<div id="profile-user">
		<div class="cover-image">
			
			<img class="img_cover{{$user->id}}" src="image/image_cover/{{$user->img_cover}}" alt="">
			
			<div class="container position-avatar">
				<div class="container avatar-username">
					<div class="row">
						<div class="col-12  d-flex justify-content-center">
							<div class="v">
								<div class="border-avatar">
									<a href="" class="avatar "><img class="avatar{{$user->id}}" src="<?php checkFile(Auth::user()->avatar) ?>" alt=""></a>
								</div>
								<div class="username">
									<h1>{{$user->username}}</h1>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="container action-setting bg-padding">
			<div class="row introduce d-block d-lg-none">
				<div class="col-md-12">
					<h1>Gioi Thieu</h1>
					<div class="address">
						<span><i class="fas fa-map-marker-alt mr-3"></i>Can Tho,Viet Nam</span>
					</div>
					<div class="time-join"><span><i class="fas fa-calendar-alt mr-3"></i>Da tham gia 15/09/2020</span></div>
				</div>
			</div>
			<div class="row menu-profile">
				<div class="col-lg-8 col-md-12 menu">
					<ul class="d-flex btn ">
						<li><a href="{{url('user')}}/{{$user->id}}">Dòng thời gian</a></li>
						
						<li><a href="{{url('user')}}/{{$user->id}}/friends">Bạn bè</a></li>

					</ul>
				</div>
				<div class="col-lg-4 col-md-12">
					<div class="setting-profile d-flex mt-2">
						<a href="" class="btn btn-success w-100" data-toggle="modal" data-target="#editProfile">Sửa hồ sơ</a>
						<div class="dropdown ">
							<button class="btn btn-primary dropdown-toggle" data-toggle='dropdown'></button>
							<ul class="dropdown-menu dropdown-menu-right ">
								<li class="dropdown-item"><a href="" data-toggle='modal' data-target='#editAvatarImageCover'>Sửa hồ sơ ảnh</a></li>
								<li class="dropdown-item"><a href="" data-toggle="modal" data-target="#editProfile">Thông tin tài khoản</a></li>
								<li class="dropdown-item"><a href="" data-toggle="modal" data-target="#changePassword">Đổi mật khẩu</a></li>
								<li class="dropdown-item"><a href="{{url('logout')}}">Đăng Xuất</a></li>
								
							</ul>
							<!-- edit profile -->
						 	<div class="modal" id="editProfile">
								<form action="" id="form-update-profile" enctype="multipart/form-data">
									{{ csrf_field() }}
									<div class="modal-dialog modal-lg">
										<div class="modal-content">
											<div class="modal-header">
												<h4 class="modal-title font-weight-bold">Chỉnh sửa hồ sơ</h4>
												<button type="button" class="close" data-dismiss="modal">&times;</button>
											</div>
											<div class="modal-body">
												<!-- message success -->
												
												<div class="row">
													<div class="col-md-4 center-webkit">
														<div class="avatar-edit">
															<img  src="image/image_avatar/{{$user->avatar}}" alt="" class="changeSrc avatar{{$user->id}}">
															<div class="overlay-edit"></div>
															<div class="icon-image"><i class="far fa-image"></i></div>
															<input type="file" class="custom-file-input input-file-avatar" name="file_avatar">
															
														</div>
														<p class="form-error" id="error-file-avatar"></p>

													</div>
													<div class="col-md-8">
														<div class="form-group">
															<label for="fullname">Họ và tên:</label>
															<input type="text" class="form-control" id="fullname" name="fullname" >
														</div>
														<p class="form-error" id="error-fullname"></p>
														<div class="form-group">
															<label for="username">Username:</label>
															<input type="text" class="form-control" id="username" name="username">
														</div>
														<p class="form-error" id="error-username"></p>
														<div class="form-group">
															<label for="" class="mr-3">Gioi tinh:</label>
															<div class="form-check-inline">
																<lable class="form-check-label">
																	<input type="radio" class="form-check-input" id="male" name="gender" value="male">Nam
																</lable>

															</div>
															<div class="form-check-inline">
																<lable class="form-check-label">
																	<input type="radio" class="form-check-input" name="gender" id="female" value="female">Nữ
																</lable>
																
															</div>
												
													
														</div>
														<div class="form-group">
															<label for="email">Email:</label>
															<input type="text" class="form-control" id="email" name="email">
															
														</div>

														<p class="form-error" id="error-email"></p>
														<div class="form-group">
															<label for="address">Ngày sinh:</label>
															<input type="date" class="form-control" id="birthday" name="birthday">
														</div>
														<p class="form-error" id="error-birthday"></p>
														<div class="form-group">
															<label for="address">Địa Chỉ:</label>
															<input type="text" class="form-control" id="address" name="address">
														</div>
														<p class="form-error" id="error-address"></p>
														<div class="form-group">
															<label for="introduce">Giới thệu:</label>
															<textarea name="introduce" id="introduce" class="form-control"></textarea>
														</div>
													</div>
												</div>
												<!-- message success -->
												<div id="success-msg" class="d-none">
                    								<div class="alert alert-default-primary">Cập nhật tài khoản thành công!</div>
                								</div>
											</div>
											

											<div class="modal-footer">
												<input type="hidden" name="image_avatar" id="image_avatar">
	        									<button type="button" class="btn btn-danger" data-dismiss="modal">Hủy</button>
	        									<button type="submit" class="btn btn-success" id="btn-update-profile" name="update">Cập Nhật</button>
	      									</div>
										</div>
									</div>
								</form>
							</div>
							
							<!-- edit avarta - cover image -->
							<div class="modal" id="editAvatarImageCover">
								<form method="post" action="" enctype="multipart/form-data" id="formEditAvatarImageCover">
									{{ csrf_field() }}
									<div class="modal-dialog modal-lg">
										<div class="modal-content">
											<div class="modal-header">
												<h4 class="modal-title font-weight-bold">Chỉnh sửa hồ sơ ảnh </h4>
												<button type="button" class="close" data-dismiss="modal">&times;</button>
											</div>
											<div class="modal-body">
												<!-- image avarta -->
												<div id="success-msg" class="success-msg d-none">
                    								<div class="alert alert-success">Cập nhật hồ sơ ảnh thành công!</div>
                								</div>
												<div class="row">
													<div class="col-12">
														<div class="title-action d-flex justify-content-between">
															<h1>Ảnh đại diện</h1>
															<a href="">Chỉnh sửa <input type="file" class="input-file-avatar" name="file_avatar"></a>
														</div>
														
													</div>
													<div class="col-12 center-webkit">
														<div class="avatar-edit avarta-lg">
															<img class="changeSrc avatar{{$user->id}}" src="image/image_avatar/{{$user->avatar}}" alt="">
														
															
														</div>
														<p class="form-error" id="error-file-avatar"></p>

													</div>
													
												</div>
												<!-- image cover -->
												<div class="row">
													<div class="col-12">
														<div class="title-action d-flex justify-content-between">
															<h1>Ảnh bìa</h1>
															<a href="">Chỉnh sửa <input type="file" class="input-file-imgcover" name="file_cover"></a>
														</div>
													</div>
													<div class="col-12 center-webkit">
														<div class="image-cover">
															<img class="changeSrcImgCover img_cover{{$user->id}}" src="image/image_cover/{{$user->img_cover}}" alt="">
															
															
														</div>
														<p class="form-error" id="error-file-cover"></p>

													</div>
													
												</div>
											</div>
											<div class="modal-footer">
	        									<button type="button" class="btn btn-danger" data-dismiss="modal">Hủy</button>
	        									
	        									<button type="submit" class="btn btn-success" name="update" id="btnUpdateImgAvatarImgCover">Cập Nhật</button>
	      									</div>
										</div>
									</div>
								</form>
							</div>
							<!-- Change Password -->
							<div class="modal" id="changePassword">
								<form action="" method="post" id="form-register">
									@csrf
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header">
												<h4 class="modal-title font-weight-bold">Đổi mật khẩu</h4>
												<button type="button" class="close" data-dismiss="modal">&times;</button>
											</div>
											<div class="modal-body">
												<div id="success-msg" class="d-none">
                    								<div class="alert alert-success">Đổi mật khẩu thành công</div>
                								</div>
												<div class="row">
													
													<div class="col-12">
														<div class="form-group">
															<label for="password">Mật khẩu hiện tại:</label>
															<input type="password" class="form-control" name="password" id="password">
														</div>
														
														<p class="form-error" id="error-password"></p>
														
														<div class="form-group">
															<label for="new_password">Mật khẩu mới:</label>
															<input type="password" class="form-control" name="new_password" id="new_password">
														</div>
														
														<p class="form-error" id="error-newpass"></p>
													
														<div class="form-group">
															<label for="password_comfirm">Mật khẩu mới:</label>
															<input type="password" class="form-control" name="password_comfirm" id="password_comfirm">
														</div>
														
														<p class="form-error" id="error-password-comfirm"></p>
														
													</div>
												</div>
											</div>
											<div class="modal-footer">
	        									<button type="button" class="btn btn-danger" data-dismiss="modal">Hủy</button>
	        									<input type="submit" id="btn-change-pass" name="update" value="Cập Nhật" class="btn btn-success">
	        									
	      									</div>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>
		<div class="container action-show mt-3">
			<div class="row">
				<!-- sidebar-left -->
				