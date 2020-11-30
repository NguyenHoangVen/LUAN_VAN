$(document).ready(function(){

	// ==== MODULE POST SHARE ===
	// 1. Click xem hinh anh bai viet chia se
	$('.image-review').click(function(){
		alert('ok')
	})
	// 2. Binh luan bai viet chia se
	commentPostShare();
	function commentPostShare(){
		$('.input-coment-post-share').on('keyup',function(e){
			
			if(e.key === 'Enter'){
				if($(this).val() != ""){
					var content = $(this).val();
					var post_share_id =  $(this).next('.post-share').val();
					
					var data = {content:content,post_share_id:post_share_id}
					$.ajax({
				        headers: {
				          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				        },
				        url: 'team/comment-post-share',
				        dataType:'json',
				        data: data,
				        type: "post",
				        success: function(data) {
				        	$('#post-share-id-'+post_share_id+' .card-comments').append(data.html)
				        	// scrollToBottomFunc()
				            // console.log(data)
				        },
				        
				    });
				    $(this).val('');
				}

			}
		})
	}
	// 3. Cap nhat bai post share
	


	// === SOCKET KET NOI ====
	var send_id = $('#id_user_login').val();
	
	var socket = io('http://localhost:6001');
	// 1. Tao secket lang nge su tu tin nhan gui 
	socket.on('laravel_database_chat:chat',function(data){
		console.log(data.messages.to)
		if(data.messages.to == send_id){
			$('#wp-box-messages .direct-chat-messages').append(data.messages.content)
			scrollToBottomFunc();
		}
		// Nhan du lieu ve, hien thi len html
		// console.log(data)
		
	})
	// === SCROLL KHI GUI NHAN TIN NHAN==
	function scrollToBottomFunc() {
        $('.direct-chat-messages').animate({
            scrollTop: $('.direct-chat-messages').get(0).scrollHeight
        }, 50);
    }
	// === CHAT MESSAGES ===
	function chatMessage(){
		$('#wp-box-messages .input-message').on('keyup',function(e){
			
			if(e.key === 'Enter'){
				if($(this).val() != ""){
					var content = $(this).val();
					var receive_id = $('#wp-box-messages .receive_id').val();
					var send_id = $('#wp-box-messages .send_id').val();
					var data = {send_id:send_id,receive_id:receive_id,content:content}
					$.ajax({
				        headers: {
				          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				        },
				        url: 'chat/send-message-ajax',
				        dataType:'json',
				        data: data,
				        type: "post",
				        success: function(data) {
				        	$('#wp-box-messages .direct-chat-messages').append(data.html)
				        	scrollToBottomFunc()
				            console.log(data)
				        },
				        
				    });
				    $(this).val(' ');
				}

			}
		})
	}
	// =========== GET BOX CHAT MESSAGES ====
	$('.listfriend .user').on('click',function(){
		$('.listfriend .user').removeClass('active-user');
		var user_id = $(this).find('.user-id').val();
        $(this).addClass('active-user');
        $.ajax({
            type: "get",
            url: "chat/get-box-messages/"+user_id, // need to create this route
            data: "",
           
            cache: false,
            success: function (data) {
                $('#wp-box-messages').html(data);
         		chatMessage();
         		scrollToBottomFunc();
            }
        });
	})
	// =========== MODULE GROUP POST ======= 
	// Tìm và tạo group post
	$('#formCreateGroupPost').on('submit',function(e){
		var name = $('#name_group').val();
		
		var file = $('.file-avatar-group').val();
		var data = new FormData(this);
		$('.error-file-group').html(' ');
		$('.error-name-group').html(' ');
		if(name == "" || file == ""){
			if(name == ""){
				$('.error-name-group').html('Bạn chưa chọn tên nhóm');
			}
			if(file == ""){
				$('.error-file-group').html('Bạn chưa chọn ảnh đại diện cho nhóm');
			}
			
		}else{
			$.ajax({
				headers: {
	                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	            },
				url:'group-post/create-ajax',
				type:'post',
				dataType:'json',
				data:data,
				cache:false,
				contentType: false,
	            processData: false,
	            success:function(data){
	            	$('#name_group').val('');
					$('.file-avatar-group').val('');
					$('.avatar-group #reviewimg').remove();
					$('#createNewGroup').modal('hide');
					// -----group member-----
					$('.group-member ul').prepend('<li class="group-item d-flex">'
					+'<a href="group-post/detail/'+data.group_id+'" class="d-flex">'
					+'<div class="avatar-group avatar mr-3">'
					+'<img src="upload/avatar_group/'+data.file+'" alt="">'
					+'</div><div class="name-group">'
					+'<h2>'+data.name_group+'</h2></div></a></li>');
					// ---group manage---
					$('.group-manage ul').prepend('<li class="group-item d-flex">'
					+'<a href="group-post/admin/'+data.group_id+'" class="d-flex">'
					+'<div class="avatar-group avatar mr-3">'
					+'<img src="upload/avatar_group/'+data.file+'" alt="">'
					+'</div><div class="name-group">'
					+'<h2>'+data.name_group+'</h2></div></a></li>');

				        
	            }
			})
		}
		e.preventDefault();
		
	})
	
	$('.form-search-group').on('submit',function(e){
		var key = $(this).find('.key').val();
		if(key == ""){
			alert('Chưa có dữ liệu tìm kiếm')
			e.preventDefault();
		}
		// alert('ok')
		// e.preventDefault();
		
	})
	// 
	// === TRINH SOAN THAO SUMMERNOTE====
	$('.summernote').summernote({
    	// height: ($(window).height() - 10),
	    callbacks: {
	        onImageUpload: function(image) {
	        	
	          uploadImage(image[0]);
	        }
	    }
	});
	function uploadImage(image) {
	    var data = new FormData();
	    data.append("image", image);
	    $.ajax({
	        headers: {
	          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	        },
	        url: 'group-post/ajax-upload-images',
	        cache: false,
	        contentType: false,
	        processData: false,
	        dataType:'text',
	        data: data,
	        type: "post",
	        success: function(url) {
	            console.log(url);
	            var image = $('<img>').attr('src',url);
	            $('.summernote').summernote("insertNode", image[0]);
	        },
	        // error: function(data) {
	        //     console.log(data);
	        // }
	    });
	  }

	// =========== /.MODULE GROUP POST ======= 

	// ===========SEARCH PLACE ON MAP ======
	// 1. Những thay đổi phương thức tìm kiếm
	$('#method').on('change',function(){
		var method = $(this).val();
		if(method == '1'){
			$('#search_around').addClass('d-none');
			$('#search_name').removeClass('d-none');
		}else{
			$('#search_name').addClass('d-none');
			$('#search_around').removeClass('d-none');
		}
		$('#search_name').val('');
		$('#search_around').val('');

	})
	// 2. Xử lý form, ajax

	// =========== INSERT MAGE =============
	$('#image-add-place').on('submit',function(e){
		e.preventDefault();
		var data = new FormData(this);

		$.ajax({
			headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
			url:'add-place-image-ajax',
			type:'post',
			dataType:'json',
			data:data,

			cache:false,
			contentType: false,
            processData: false,
            success:function(data){
            	console.log(data);
            	if(data.error){
            		$('#error-file-image').html(data.error.file_image[0]);
            	}

            	if(data.success){
            		$('#get_file_name_image').val(data.file_name);
            		$('.success-msg').removeClass('d-none');
					setInterval(function(){ 
						
                        $('.success-msg').addClass('d-none');
                    }, 3000);
            	}
            }
		})
	})
	// ===========IMAGE ==========
	$('#formEditAvatarImageCover').on('submit',function(e){

		e.preventDefault();//Trở về mặc định như chưa xảy ra sự kiện
		var data = new FormData(this);
		console.log(data);
		$.ajax({
			headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
			url:'update-image-ajax',
			type:'post',
			dataType:'json',
			data:data,
			cache:false,
			contentType: false,
            processData: false,
			success:function(data){
				console.log(data);
				if(data.error){
					console.log(data);
					if(data.error.file_avatar){
						$('#error-file-avatar').attr('src',data.error.file_avatar[0]);
					}
					if(data.error.file_cover){
						$('#error-file-cover').attr('src',data.error.file_cover[0]);
					}
				}
				
				// 
				if(data.success){
					if(data.result.file_avatar){
						console.log('chi file_avatar');
						console.log(data.user_id);
						// Cap nhat lai anh
						$('.avatar'+data.user_id).attr('src','image/image_avatar/'+data.result.file_avatar);
					}
					if(data.result.file_cover){
						console.log('chi file_cover');
						$('.img_cover'+data.user_id).attr('src','image/image_avatar/'+data.result.file_cover);
					}
					// =======================
					$('.success-msg').removeClass('d-none');
					setInterval(function(){ 
						
                        $('.success-msg').addClass('d-none');
                    }, 3000);
				}
			}
		})

	})
	// ============ PROFILE =========

	$("#editProfile").on('shown.bs.modal', function (e) {
 		$.ajax({
 			headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
 			url:'view-profile-ajax',
 			dataType:'json',
 			type:'post',
 			success:function(data){
 				$('#fullname').val(data.result.fullname);
 				$('#username').val(data.result.username);
 				$('#email').val(data.result.email);
 				$('#address').val(data.result.address);
 				$('#introduce').val(data.result.introduce);
 				$('#birthday').val(data.result.date_of_birth)
 				if(data.result.gender == 'male'){
 					$('#male').attr('checked',true);
 				}else{
 					$('#female').attr('checked',true);
 				}
 			}
 		})
	})
	// 1. update info profile
	$('#form-update-profile').on('submit',function(e){
		e.preventDefault();
		var data = new FormData(this);
		$('#error-fullname').html('');
		$('#error-username').html('');
		$('#error-email').html('');
		$('#error-address').html('');
		$('#error-birthday').html('');
		console.log(data);
		$.ajax({
			headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
			url:'update-profile-ajax',
			dataType:'json',
			type:'post',
			data:data,
			cache:false,
			contentType: false,
            processData: false,
			success:function(data){
				
				
				if(data.errors){
					if(data.errors.username){
						$('#error-username').html(data.errors.username[0]);
					}
					if(data.errors.fullname){
						$('#error-fullname').html(data.errors.fullname[0]);
					}
					if(data.errors.email){
						$('#error-email').html(data.errors.email[0]);
					}
					if(data.errors.address){
						$('#error-address').html(data.errors.address[0]);
					}
					if(data.errors.file_avatar){
						$('#error-file-avatar').html(data.errors.file_avatar[0]);
					}
					console.log(data.errors);
				}
				if(data.success){
					console.log(data);
					if(data.file){
						console.log(data);
						$('.avatar'+data.user_id).attr('src','image/image_avatar/'+data.file);
					}
					$('#success-msg').removeClass('d-none');
					setInterval(function(){
                        $('#success-msg').addClass('d-none');
                    }, 3000);
				}
			}
		})
	})


	// ============CHANGE PASSWORD=============
	$('#btn-change-pass').click(function(){
		var a = $('#form-register').serialize();
		// var data = {name:'hoangven',password:'mypassword'};
		console.log(a);
		$('#error-password').html('');
		$('#error-newpass').html('');
		$('#error-password-comfirm').html('');
		$.ajax({
			headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
			url:'change-pass-ajax',
			dataType:'json',
			type:'post',
			data:a,
			success:function(data){
				if(data.status == 'ok'){
				
					if(data.errors){
						if(data.errors.password){
							$('#error-password').html(data.errors.password[0]);
						}
						if(data.errors.new_password){
							$('#error-newpass').html(data.errors.new_password[0]);
						}
						if(data.errors.password_comfirm){
							$('#error-password-comfirm').html(data.errors.password_comfirm[0]);
						}
					}
				}else{
					$('#error-password').html('Mật khẩu cũ không đúng');
				}
				// ============
				if(data.success){
					$('#success-msg').removeClass('d-none');
					$('#password,#new_password,#password_comfirm').val('');
					setInterval(function(){ 
						// $('.modal-backdrop,#changePassword').addClass('d-none');
                        $('#success-msg').addClass('d-none');
                    }, 3000);
				}
				
			
				
			}

		})
		return false;
	})
})