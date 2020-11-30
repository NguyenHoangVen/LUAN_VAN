@extends('layouts.index')
@section('content')
@include('layouts.profile.head_profile')

<div class="col-lg-9 col-md-12 diary mt-0 p-0">
	<div class="bg-padding">
		<div class="card direct-chat direct-chat-warning">
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
                      <button type="button" class="btn btn-tool" data-card-widget="remove">
                        <i class="fas fa-times"></i>
                      </button>
                    </div>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">
                    <!-- Conversations are loaded here -->
                    <div class="direct-chat-messages">
                      <!-- Message. Default to the left -->
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

                      <!-- Message. Default to the left -->
                      <div class="direct-chat-msg">
                        <div class="direct-chat-infos clearfix">
                          <span class="direct-chat-name float-left">Alexander Pierce</span>
                          <span class="direct-chat-timestamp float-right">23 Jan 5:37 pm</span>
                        </div>
                        <!-- /.direct-chat-infos -->
                        <img class="direct-chat-img" src="{{asset('Admin/dist/img/user1-128x128.jpg')}}" alt="message user image">
                        <!-- /.direct-chat-img -->
                        <div class="direct-chat-text">
                          Working with AdminLTE on a great new app! Wanna join?
                        </div>
                        <!-- /.direct-chat-text -->
                      </div>
                      <!-- /.direct-chat-msg -->

                      <!-- Message to the right -->
                      <div class="direct-chat-msg right">
                        <div class="direct-chat-infos clearfix">
                          <span class="direct-chat-name float-right">Sarah Bullock</span>
                          <span class="direct-chat-timestamp float-left">23 Jan 6:10 pm</span>
                        </div>
                        <!-- /.direct-chat-infos -->
                        <img class="direct-chat-img" src="{{asset('Admin/dist/img/user1-128x128.jpg')}}" alt="message user image">
                        <!-- /.direct-chat-img -->
                        <div class="direct-chat-text">
                          I would love to.
                        </div>
                        <!-- /.direct-chat-text -->
                      </div>
                      <!-- /.direct-chat-msg -->

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
                        <!-- End Contact Item -->
                        <li>
                          <a href="#">
                            <img class="contacts-list-img" src="{{asset('Admin/dist/img/user1-128x128.jpg')}}" alt="User Avatar">

                            <div class="contacts-list-info">
                              <span class="contacts-list-name">
                                Nadia Jolie
                                <small class="contacts-list-date float-right">2/20/2015</small>
                              </span>
                              <span class="contacts-list-msg">I'll call you back at...</span>
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
                                Nora S. Vans
                                <small class="contacts-list-date float-right">2/10/2015</small>
                              </span>
                              <span class="contacts-list-msg">Where is your new...</span>
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
                                John K.
                                <small class="contacts-list-date float-right">1/27/2015</small>
                              </span>
                              <span class="contacts-list-msg">Can I take a look at...</span>
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
                                Kenneth M.
                                <small class="contacts-list-date float-right">1/4/2015</small>
                              </span>
                              <span class="contacts-list-msg">Never mind I found...</span>
                            </div>
                            <!-- /.contacts-list-info -->
                          </a>
                        </li>
                        <!-- End Contact Item -->
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
	</div>
</div>
@include('layouts.profile.bottom_profile')
@endsection
@section('script')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.3.0/socket.io.dev.js"></script>
<script  type="text/javascript">
	// 	=== LAY ID CUA NGUOI DUNG===
	var user_id_login = "{{$user->id}}";

	// === AJAX SETTIN HEADER ==
	$.ajaxSetup({
	    headers: {
	        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	    }
	});
	// === CLICK LAY TAT CA TRANG THAI THEO TAB===
		// 1. Tab all friend
	$('.tab-friend').on('click',function(){
		var status = $(this).find('.status').val();
		
		$.ajax({
            url: "{{url('user/get-tab-friend')}}",
	      	dataType:'json',
	      	data: {status:status},
	      	type:'post',
	      	success:function(data){
	      		if(status == 'request'){
	      			$('#received-request .list-friends .row').html(data.html_result);
	      			receiveReuqest();
	      		}
	      		if(status == 'sended'){
	      			$('#sended-request .list-friends .row').html(data.html_result);
	      			deleteRequest();
	      		}
	      		if(status == 'all-friend'){
	      			$('#all-friends .list-friends .row').html(data.html_result);
	      			deleteFriend()
	      			// console.log(data)
	      		}
	      		
	      		
	      	}
		})
		
	})
	// == TIM KIEM TAT CA BAN BE ==
	$('#form-search-all-friends').on('submit',function(e){
		e.preventDefault();
		var key = $(this).find('.key').val();
		
		if(key != ""){
			$.ajax({
	            url: "{{url('user/search-all-friend')}}",
		      	dataType:'json',
		      	data: {key:key},
		      	type:'post',
		      	success:function(data){
		      		console.log(data)
		      		if(data.success){
		      			$('#search-all-friend .list-friends').html(data.user);
		      			sendRequest();
		      		}
		      	}
			})	
		}
		
	})
	

	// == SOCKET LANG NGE SU KIEN KET BAN ====
	// var socket = io('http://localhost:6001');

	// == GUI YEU CAU KET BAN AJAX ==
	sendRequest();
	function sendRequest(){
		$('.send-request').click(function(){
			var receive_id = $(this).find('.receive_id').val();
			$.ajax({
	            url: "{{url('user/send-request-add-friend')}}",
		      	dataType:'json',
		      	data: {receive_id:receive_id},
		      	type:'post',
		      	success:function(data){
		      		$('#suggestions-friend .friend-'+receive_id).remove();
		      		deleteRequest();
		      	}
			})	
			
		})
	}
	// == XOA YEU CAU KET BAN ===
	deleteRequest();
	function deleteRequest(){
		$('.delete-request').click(function(){
			var receive_id = $(this).find('.receive_id').val();
			
			$.ajax({
	            url: "{{url('user/delete-request-add-friend')}}",
		      	dataType:'json',
		      	data: {receive_id:receive_id},
		      	type:'post',
		      	success:function(data){
		      		
		      		$('#sended-request .friend-'+data.result).remove();
		      		console.log(data)
		      		
		      	}
			})	
		})
	}
	// == CHAP NHAN YEU CAU KET BAN AJAX ===
	receiveReuqest();
	function receiveReuqest(){
		$('.received-request').click(function(e){
			e.preventDefault();
			// 1. Chap nhan yeu cau cua ai, send_id
			var send_id = $(this).find('.send_id').val();
			$.ajax({
	            url: "{{url('user/accept-request-add-friend')}}",
		      	dataType:'json',
		      	data: {send_id:send_id},
		      	type:'post',
		      	success:function(data){
		      		
		      		$('#received-request .friend-'+send_id).remove()
		      		console.log(data)
		      	}
			})
			
		})
	}
	// == XOA BAN BE ===
	deleteFriend()
	function deleteFriend(){
		$('.delete-friend').on('click',function(){
			var friend_id = $(this).find('.friend-id').val();
			
			$.ajax({
	            url: "{{url('user/delete-friend')}}",
		      	dataType:'json',
		      	data: {friend_id:friend_id},
		      	type:'post',
		      	success:function(data){
		      		
		      		$('#all-friends .friend-'+friend_id).remove()
		      		console.log(data)
		      	}
			})
		})
	}
</script>
@endsection