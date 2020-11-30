<div class="card direct-chat direct-chat-warning mb-0">
	                  	<div class="card-header p-1">
	                    	
	                    	<div class="user-block">
	                    		<img class="img-circle img-bordered-sm" src="image/image_avatar/{{$user->avatar}}" alt="User Image">
	                    		<span class="username">
		                          <a href="#">{{ Str::limit($user->username, 13) }}</a>
		                         
		                        </span>
	                    	</div>
	                    	<div class="card-tools">
		                      	<span title="3 New Messages" class="badge badge-warning">3</span>
		                      	<button type="button" class="btn btn-tool" data-card-widget="collapse">
		                        <i class="fas fa-minus"></i>
		                      	</button>
		                      	<button type="button" class="btn btn-tool" title="Contacts" data-widget="chat-pane-toggle">
		                        <i class="fas fa-comments"></i>
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
			                          	<span class="direct-chat-timestamp float-left">23 Jan 2:05 pm</span>
			                        </div>
			                        <!-- /.direct-chat-infos -->
			                        <img class="direct-chat-img" src="image/image_avatar/{{$message->user_send->avatar}}" alt="message user image">
			                        <!-- /.direct-chat-img -->
			                        <div class="direct-chat-text">
			                          {{$message->content}}
			                        </div>
			                        <!-- /.direct-chat-text -->
		                      	</div>
		                     	@else
		                      	<div class="direct-chat-msg">
			                        <div class="direct-chat-infos clearfix">
			                          	<span class="direct-chat-name float-left">{{$message->user_send->username}}</span>
			                          	<span class="direct-chat-timestamp float-right">23 Jan 2:00 pm</span>
			                        </div>
			                        <!-- /.direct-chat-infos -->
			                        <img class="direct-chat-img" src="image/image_avatar/{{$message->user_send->avatar}}" alt="message user image">
			                        <!-- /.direct-chat-img -->
			                        <div class="direct-chat-text">
			                          	{{$message->content}}
			                        </div>
			                        <!-- /.direct-chat-text -->
		                      	</div>
		                      	@endif
		                      
		                      	@endforeach

		                      	
		                     

		                    </div>
	                    	<!--/.direct-chat-messages-->

	                    	<!-- Contacts are loaded here -->
	                    	<div class="direct-chat-contacts">
		                      	<ul class="contacts-list">
			                        <li>
			                          	<a href="#">
			                            	<img class="contacts-list-img" src="{{asset('Admin/dist/img/user1-128x128.jpg')}}" alt="User Avatar">

			                            	<div class="contacts-list-info">
			                              	<span class="contacts-list-name">
			                                Count Dracula
			                                	<small class="contacts-list-date float-right">2/28/2015</small>
			                             	</span>
			                              	<span class="contacts-list-msg">How have you been? I was...</span>
			                            	</div>
			                            <!-- /.contacts-list-info -->
			                          	</a>
			                        </li>
			                        <!-- End Contact Item -->
			                        <li>
			                          	<a href="#">
				                            <img class="contacts-list-img" src="{{asset('Admin/dist/img/user1-128x128.jpg')}}" alt="User Avatar">

				                            <div class="contacts-list-info">
				                              	<span class="contacts-list-name">
				                                Sarah Doe
				                                	<small class="contacts-list-date float-right">2/23/2015</small>
				                              	</span>
				                              	<span class="contacts-list-msg">I will be waiting for...</span>
				                            </div>
			                            <!-- /.contacts-list-info -->
			                          	</a>
			                        </li>
		                      	</ul>
	                      	<!-- /.contacts-list -->
	                    	</div>
	                    	<!-- /.direct-chat-pane -->
	                  	</div>
                  		<!-- /.card-body -->
	                  	<div class="card-footer">
		                    
	                      	<div class="input-group">
	                      		<input type="hidden" class="receive_id" value="{{$user->id}}">
	                      		<input type="hidden" class="send_id" value="{{Auth::user()->id}}">
	                        	<input type="text" name="message" placeholder="Type Message ..." class="form-control input-message">
	                        	<span class="input-group-append">
	                         	 	<button type="button" class="btn btn-warning">Send</button>
	                        	</span>
	                      	</div>
		                    
	                  	</div>
                  		<!-- /.card-footer-->
                	</div>