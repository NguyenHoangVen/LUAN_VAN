<div id="header">
				<div class="container">
					<div class="row">
						<!-- tao id user login de truyen qua socket chat -->
						<input type="hidden" id="id_user_login" value="<?php
						if(Auth::check()) echo Auth::user()->id
						?>">
						<div class="col-12 d-flex justify-content-between">
							<!-- <div id="logo"> -->
								<a href="{{url('home')}}" title="" class="d-block" id="logo"><img src="image/logo/logophuot.png" alt="" ></a>
							<!-- </div> -->
							<div id="nav-respon" class="d-block d-md-none">
                                <i class="fas fa-bars"></i>
                            </div>
	                        <div class="d-none d-md-block">
	                        	<ul id="main-menu" class="d-flex">
	                            	<li><a href="{{url('home')}}">Trang Chủ</a></li>
	                            	<li><a href="{{url('team')}}">Team phượt</a></li>
	                            	<li class="dropdown"><a href="" class="dropdown-toggle" data-toggle='dropdown'>Google Map</a>
	                            		<ul class="dropdown-menu sub-menu">
	                            			<li><a href="{{url('maps/direction')}}" class="dropdown-item">Map chỉ đường</a></li>
	                            			<li><a href="maps" class="dropdown-item">Map tìm kiếm</a></li>
	                            			
	                            		</ul>
	                            	</li>
	                            	<li class="dropdown"><a href="" class="dropdown-toggle" data-toggle='dropdown'>Diễn Đàn</a>
	                            		<ul class="dropdown-menu sub-menu">
	                            			<li><a href="?page=forum&topic=team" class="dropdown-item">Lập team</a></li>
	                            			<li><a href="{{url('team/post-share')}}" class="dropdown-item">Chia sẻ</a></li>
	                            			<li><a href="?page=forum&topic=question" class="dropdown-item">Hỏi đáp</a></li>
	                            		</ul>
	                            	</li>
	                            	<li class="dropdown"><a href="{{url('group-post')}}">Nhóm</a>
	                            		
	                            	</li>


	                            </ul>
	                        </div>
                            <div class="user-login">
                            	<!-- user chua dang nhap -->
                            	@if(!Auth::check())
                            	<div class="not-loged-in"><a href="{{url('login')}}" title="" class="btn btn-danger"><i class="fas fa-sign-in-alt"></i> Đăng Nhập</a></div>
                            	@else
                            	<!-- user da dang nhap -->
                            	<div class="loged-in">
	                            	<div class=" d-flex justify-content-between">
	                            		<div class="alert-bell">
	                            			
		                            		<a href="">
		                            			<i class="fas fa-bell"></i>
		                            		</a>
		                            		<span class="number">8</span>
		                            	</div>
	                            		
	                            		<a href="{{url('add-place')}}" class="write-post"><i class="fas fa-pencil-alt"></i></a>
	                            		
                            			<a href="{{url('user')}}/{{Auth::user()->id}}" class="avatar d-block "><img class="avatar{{Auth::user()->id}}" src="image/image_avatar/{{Auth::user()->avatar}}" alt=""></a>
	                            			
	                            		</div>
	                            	</div>
	                            </div>
	                            @endif
                            </div>
						</div>
					</div>
				</div>
			</div>