<div class="card direct-chat direct-chat-warning mb-0">
	                  	<div class="card-header">
	                    	<h3 class="card-title">Direct Chat</h3>

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
		                      	@for($i=1;$i<=6;$i++)
		                      	<div class="direct-chat-msg">
			                        <div class="direct-chat-infos clearfix">
			                          	<span class="direct-chat-name float-left">Alexander Pierce</span>
			                          	<span class="direct-chat-timestamp float-right">23 Jan 2:00 pm</span>
			                        </div>
			                        <!-- /.direct-chat-infos -->
			                        <img class="direct-chat-img" src="{{asset('Admin/dist/img/user1-128x128.jpg')}}" alt="message user image">
			                        <!-- /.direct-chat-img -->
			                        <div class="direct-chat-text">
			                          Is this template really for free? That's unbelievable!
			                        </div>
			                        <!-- /.direct-chat-text -->
		                      	</div>
		                      	<!-- /.direct-chat-msg -->

		                      	<!-- Message to the right -->
		                      	<div class="direct-chat-msg right">
			                        <div class="direct-chat-infos clearfix">
			                          	<span class="direct-chat-name float-right">Sarah Bullock</span>
			                          	<span class="direct-chat-timestamp float-left">23 Jan 2:05 pm</span>
			                        </div>
			                        <!-- /.direct-chat-infos -->
			                        <img class="direct-chat-img" src="{{asset('Admin/dist/img/user1-128x128.jpg')}}" alt="message user image">
			                        <!-- /.direct-chat-img -->
			                        <div class="direct-chat-text">
			                          You better believe it!
			                        </div>
			                        <!-- /.direct-chat-text -->
		                      	</div>
		                      	<!-- /.direct-chat-msg -->
		                      	@endfor

		                      	
		                     

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
		                    <form action="#" method="post">
		                      	<div class="input-group">
		                        	<input type="text" name="message" placeholder="Type Message ..." class="form-control">
		                        	<span class="input-group-append">
		                         	 	<button type="button" class="btn btn-warning">Send</button>
		                        	</span>
		                      	</div>
		                    </form>
	                  	</div>
                  		<!-- /.card-footer-->
                	</div>