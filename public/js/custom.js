$(document).ready(function(){

	// =========== LIGHT BOX IMAGE========
	$(function () {
	    $(document).on('click', '[data-toggle="lightbox"]', function(event) {
	      event.preventDefault();
	      $(this).ekkoLightbox({
	        alwaysShowClose: true
	      });
	    });

	    // $('.filter-container').filterizr({gutterPixels: 3});
	    $('.btn[data-filter]').on('click', function() {
	      $('.btn[data-filter]').removeClass('active');
	      $(this).addClass('active');
	    });
	})
	// =========== Validate form add place (Topic)========
	
	$('#formAddTopic').on('submit',function(e){
		
		var data = new FormData(this);
		var region = document.getElementById('region').value;

		var name = document.getElementById('name').value;
		var address = document.getElementById('address').value;
		$('#error-file').html('');
		$('#error-name').html('');
		$('#error-address').html('');
		if(!$('#uploadImgAddTopic').val()|| address == "" || name==""||region==""){
			if(!$('#uploadImgAddTopic').val()){
				$('#error-file').html('ban can chon file');
			}
			if(name == ""){
				$('#error-name').html('Bạn cần nhâp tên địa điểm (chủ đề)');
			}
			if(address == ""){
				$('#error-address').html('Bạn cần chọn địa chỉ');
			}
			if(region == ""){
				$('#error-region').html('Bạn cần chọn vùng miền');
			}
			
		}else{
			$.ajax({
				headers: {
	                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	            },
				url:'add-topic-ajax',
				type:'post',
				dataType:'json',
				data:data,
				cache:false,
				contentType: false,
	            processData: false,
	            success:function(data){
	            	console.log(data);

	            	if(data.success){
	            		$('#formAddTopic input').val('');
	            		$('').insertAfter('#reviewimg')
	            		$('.success-msg').removeClass('d-none');
						var a = setInterval(function(){ 
				            $('.success-msg').addClass('d-none');
				            $('#addTopicPlace').modal('hide');
				            location.reload();
				            clearInterval(a);
				        }, 2500);
				        
	            	}
	            }
			})
		}
		e.preventDefault();
		
		
		
	});


	// =============================================
	$('.info-user-content .input-text').click(function(){
		// alert('ok');
		$(this).css({height:'150px'});
		$(this).parents('form').find('.show-btn').css({display:'block'});
		// $('.info-user-content .show-btn').css({display:'block'});
	})
	$('.info-user-content .btn-destroy').click(function(){
		
		$(this).parent('.show-btn').css({display:'none'});
		$(this).parents('form').find('.input-text').css({height:'25px'});
		// $('.info-user-content .input-text').css({height:'25px'});
		return false;
	})
	// ============Review Image Avatar before upoad =============

	function readURL_ImageAvatar(input,classShowFile) {
	  	if (input.files && input.files[0]) {
	    	var reader = new FileReader();
	    
	    	reader.onload = function(e) {
	      		// $('.changeSrc').attr('src', e.target.result);
	      		$('.'+classShowFile).attr('src', e.target.result);

	    	} 
	    	
	    	$('#image_avatar').val(input.files[0].name);
	    	
	    	reader.readAsDataURL(input.files[0]); // convert to base64 string
	  	}
	}
	$('.file-avatar-group').on('change',function(){
		$('<div id="reviewimg"><img src="" class="imgAvatarGroup" alt="">'
			+'</div>').insertAfter('#ven');
		readURL_ImageAvatar(this,'imgAvatarGroup');
	})
	$(".input-file-avatar").on('change',function(){

		readURL_ImageAvatar(this,'changeSrc');
	})
	$(".input-file-imgcover").on('change',function(){
		
		readURL_ImageAvatar(this,'changeSrcImgCover');
	})
	$('.input-file-add-place').on('change',function(){
		$('#imgPlaceReview').html(
			'<div class="review pt-4"><img src="" class="imgPlace"></div>'
			);
		$('#btn-save-image-add-place').removeClass('d-none');
		readURL_ImageAvatar(this,'imgPlace');
	})

	
	// ==============
	$('.category-select').on('change',function(){
		$('#file_name_image_delete').val('');
		$('.wp_input_hidden .f_hidden').remove();
		// $('.img-wrap').remove();
		var category = $(this).val();
		
		if(category != " "){
			if(category == 'travel'){
				$('.img-price').removeClass('d-none');
				$('.hotel-res').addClass('d-none');
			}else{
				$('.img-price').removeClass('d-none');
				$('.hotel-res').removeClass('d-none');	
			}
		}else{
			$('.img-price').addClass('d-none');
		}
		

	})
	// ========UPLOAD MULTI FILE=========
	

	
})
	