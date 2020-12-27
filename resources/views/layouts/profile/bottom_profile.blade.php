<!-- sidebar-right -->
				<div class="col-lg-3 ">
					<div class="frend-contact">
						<h2>Danh sach ban</h2>
						<ul class="listfriend">
							@foreach($friends as $friend)
							@if($friend->id_user_accept == Auth::user()->id)
							<li class="d-flex user">
								<div class="avatar">
									<img alt="" src="<?php checkFile($friend->user_accept->avatar) ?>">
									<div class="online"></div>
								</div>
								<div class="username"><h1>{{$friend->user_accept->username}}</h1></div>
								<input type="hidden" class="user-id" value="{{$friend->user_accept->id}}">
							</li>
							@else
							<li class="d-flex user">
								<div class="avatar">
									<img src="<?php checkFile($friend->user_send->avatar) ?>" alt="">
									<div class="online"></div>
								</div>
								<div class="username"><h1>{{$friend->user_send->username}}</h1></div>
								<input type="hidden" class="user-id" value="{{$friend->user_send->id}}">
							</li>
							@endif
							@endforeach
							
							

						</ul>
					</div>
				</div>

				<!-- BOX MESSAGE -->
				<div id="wp-box-messages">
					
				</div>
			</div>
		</div>
		
	</div>
	
</div>