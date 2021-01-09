<?php Carbon\Carbon::setLocale('vi');?>
<div class="card direct-chat direct-chat-warning mb-0">
	                  	<div class="card-header p-1">
	                    	
	                    	<div class="user-block">
	                    		<img class="img-circle img-bordered-sm" src="image/image_avatar/{{$user->avatar}}">
	                    		<span class="username">
		                          <a href="#">{{ Str::limit($user->username, 13) }}</a>
		                         
		                        </span>
	                    	</div>
	                    	<div class="card-tools">
		                      	
		                      	<button type="button" class="btn btn-tool" data-card-widget="collapse">
		                        <i class="fas fa-minus"></i>
		                      	</button>
		                      	
		                      	<button type="button" class="btn btn-tool close-box" data-card-widget="remove">
		                        <i class="fas fa-times"></i>
		                      	</button>
	                    	</div>
	                  	</div>
                  		<!-- /.card-header -->
	                  	<div class="card-body">
	                    <!-- Conversations are loaded here -->
		                    <div class="direct-chat-messages">
		                      	<!-- Message. Default to the left -->
		                      	@foreach($messages as $message)
		                     	@if($message->from == Auth::user()->id)
		                     	<div class="direct-chat-msg right">
			                        <div class="direct-chat-infos clearfix">
			                          	<span class="direct-chat-name float-right">{{$message->user_send->username}}</span>
			                          	
			                        </div>
			                        <!-- /.direct-chat-infos -->
			                        <img class="direct-chat-img" src="image/image_avatar/{{$message->user_send->avatar}}">
			                        <!-- /.direct-chat-img -->
			                        <div class="direct-chat-text">
			                          <div>{{$message->content}}</div>
			                          <div class="direct-chat-infos clearfix">
			                          	
			                          	<span class="mt-2 direct-chat-timestamp float-right">{{Carbon\Carbon::parse($message->created_at)->diffForHumans()}}</span>
			                        </div>
			                        </div>
			                        <!-- /.direct-chat-text -->
		                      	</div>
		                     	@else
		                      	<div class="direct-chat-msg">
			                        <div class="direct-chat-infos clearfix">
			                          	<span class="direct-chat-name float-left">{{$message->user_send->username}}</span>
			                         
			                        </div>
			                        <!-- /.direct-chat-infos -->
			                        <img class="direct-chat-img" src="image/image_avatar/{{$message->user_send->avatar}}">
			                        <!-- /.direct-chat-img -->
			                        <div class="direct-chat-text">
			                          	<div>{{$message->content}}</div>
				                         <span class="direct-chat-timestamp">{{Carbon\Carbon::parse($message->created_at)->diffForHumans()}}</span>
				                        
			                        </div>
			                        <!-- /.direct-chat-text -->
		                      	</div>
		                      	@endif
		                      
		                      	@endforeach

		                      	
		                     

		                    </div>
	                    	<!--/.direct-chat-messages-->

	                    	
	                  	</div>
                  		<!-- /.card-body -->
	                  	<div class="card-footer">
		                    
	                      	<div class="input-group">
	                      		<input type="hidden" class="receive_id" value="{{$user->id}}">
	                      		<input type="hidden" class="send_id" value="{{Auth::user()->id}}">
	                        	<input type="text" name="message" placeholder="Nhập tin nhắn..." class="form-control input-message">
	                        	<span class="input-group-append">
	                         	 	<button type="button" class="btn btn-warning">Send</button>
	                        	</span>
	                      	</div>
		                    
	                  	</div>
                  		<!-- /.card-footer-->
                	</div>