$(document).ready(function(){
	// $(window).resize(function(){
	// 	if($(document).width() >= 768){
	// 		$('#main-menu-respon').css('display', 'none');
	// 	}
		
	// });
	$('#nav-respon').click(function(){
		// alert('ok');
		$('#site-page').toggleClass('open-menu-respon');
		$('#nav-respon i').toggleClass('fa-bars fa-times');
	})
	$('.has-sub-menu').click(function(){
		$(this).children('.sub-menu').slideToggle();
		$('.has-sub-menu i').toggleClass('fa-angle-right fa-angle-down');
		return false;
	})

	$('.modal-content .owl-carousel .item img').click(function(){
		
		var src = $(this).attr('src');
		console.log($('.mainThumbReviewImg img').attr('src'));
		$('.mainThumbReviewImg img').attr('src',src);
		
	})
	// =====TAO TEAM PHUOT===
	// 1. tao team phuot
	$('#create-team').on('submit',function(e){
		var title = $('#create-team .title-team').val();
		$('#create-team #error-title').html(' ');
		if(title == ""){
			$('#create-team #error-title').html('Tiêu đề nhóm không được trống!');
		}else{
			$.ajax({
				headers: {
	                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	            },
	            url: 'team/create-team',
		      	dataType:'json',
		      	data: {title:title},
		      	type:'post',
		      	success:function(data){
		      		console.log(data)
		      		if(data.success){
	            		
	            		$('.alert-default-info').removeClass('d-none');
						var a = setInterval(function(){ 
				            $('.alert-default-info').addClass('d-none');
				            $('#createTeam').modal('hide');
				            
							clearInterval(a);
							location.reload()
				        }, 2500);
				        
	            	}
		      	}
			})
		}
		
		e.preventDefault();
		
	})
	// 2. Tim kiem team phuot
	$('#search-team').on('submit',function(e){
		var key = $('#search-team .key').val();
		if(key == ""){
			alert('Bạn chưa nhập từ khóa tìm kiếm');
			e.preventDefault();
		}
	})
	
	
})