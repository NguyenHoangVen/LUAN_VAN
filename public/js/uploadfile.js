$(document).ready(function(){
	// ====CAP NHAT BAI POST SHARE====
	$('#form-update-post-share').on('submit',function(e){
		e.preventDefault();
		var data = new FormData(this);
		$.ajax({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			url: 'team/update-post-share',
			type: 'post',
			dataType: 'json',
			data: data,
			cache: false,
			contentType: false,
			processData: false,
			success: function(data) {
				// console.log(data);
				$('#form-update-post-share .alert-default-primary')
					.removeClass('d-none');
				var a = setInterval(function() {
					$('#form-update-post-share .alert-default-primary')
						.addClass('d-none');
					location.reload();
				}, 2000);
			},
			error: function (error) {
				alert('error; ' + eval(error))
			}
		})
	})
	// ====SUBMIT FORM POST SHARE ======
	$('#form-post-share').on('submit',function(e){
		e.preventDefault();
		var numselect = $('#form-post-share .numselect').val();
		var numdelete = $('#form-post-share .numdelete').val();
		var content = $('#form-post-share .content').val();
		if(content == "" && numselect == numdelete){
			alert('Khong co du lieu');
		}else{
			// alert('Co du lieu');
			var data = new FormData(this);
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: 'team/chek-in',
                type: 'post',
                dataType: 'json',
                data: data,
                cache: false,
                contentType: false,
                processData: false,
                success: function(data) {
                    // console.log(data);
                    $('#form-post-share .alert-default-primary')
                        .removeClass('d-none');
                    var a = setInterval(function() {
						$('#form-post-share .alert-default-primary')
                            .addClass('d-none');
                        location.reload();
                    }, 2000);
                }
            })
		}
	})

	// 
	// 3. Cap nhat bai chia se, su kien mo modal
	$('.edit-post-share').click(function(){
		var post_share_id = $(this).find('.post-share-id').val();
		$.ajax({
			url: 'team/get-view-content-post-share/' + post_share_id,
			type: "get",
			success: function(data) {
				$('#form-update-post-share .content-post-share').html(data);
				DeleteFile1();
			},
		});
	})
	
	// Upload images add Place (topic)
	$('#uploadImgAddTopic').on('change',function(e){
		
		var files = e.target.files,
		filesLength = files.length;
		console.log(filesLength);
		for(var i = 0, f; (f = files[i]); i++){
			var f = files[i];
    		var fileReader = new FileReader();
    		fileReader.onload = (function(readerEvt){
				return function(e){	
					ApplyFileValidationRules(readerEvt);
        			RenderThumbnail(e, readerEvt);
				};
    			
    		})(f);
    	
    		fileReader.readAsDataURL(f);
		}
		
	})
	function RenderThumbnail(e, readerEvt){
		
		$('<div class="col-md-6">'
		+'<div class="img-wrap"><span class="delete">x</span><div class="thumb-img" style="height: 232px">'
		+'<img src="'+e.target.result+'" data-id="'+readerEvt.name+'">'
		+'</div></div></div>'
		).insertAfter('#reviewimg');
		$('<input type="hidden" class="f_hidden" name="file_name_image[]" value="'+readerEvt.name+'" >').insertAfter('#file_hidden');
		var numselect = 1;
		
		numselect = $('#reviewimg .numselect').val();
		$('#reviewimg .numselect').val(parseInt(numselect) +1 );
		DeleteFile();
	}
	
	// Delete File
	function DeleteFile(){
		$(".delete").click(function(){
			
			$(this).parents(".col-md-6").remove();
			var numdelete = 1;
            var name_old = [];
            var name = $(this).parent(".img-wrap").find('img').attr('data-id');
            if($('#file_name_image_delete').val() != ""){
				name_old.push($('#file_name_image_delete').val());
				
		
				numdelete = $('#reviewimg .numdelete').val();
				$('#reviewimg .numdelete').val(parseInt(numdelete) +1 );
				DeleteFile();
            }
            name_old.push(name);
            console.log(name_old);
            $('#file_name_image_delete').val(name_old);
        });
        
	}
	// ============DANH CHO UPALOD FILE SU DUNG CAC CLASS, TRONG POST SHARE=============
	DeleteFile1();
	$('#uploadImgPostShare').on('change',function(e){
		
		var files = e.target.files,
		filesLength = files.length;
		console.log(filesLength);
		for(var i = 0, f; (f = files[i]); i++){
			var f = files[i];
    		var fileReader = new FileReader();
    		fileReader.onload = (function(readerEvt){
				return function(e){
					
					ApplyFileValidationRules(readerEvt);
        			RenderThumbnail1(e, readerEvt);
        			
				};
    			
    		})(f);
    	
    		fileReader.readAsDataURL(f);
		}
		
	})
	function RenderThumbnail1(e, readerEvt){
		
		$('<div class="col-md-6">'
		+'<div class="img-wrap"><span class="delete">x</span><div class="thumb-img" style="height: 232px">'
		+'<img src="'+e.target.result+'" data-id="'+readerEvt.name+'">'
		+'</div></div></div>'
		).insertAfter('#reviewimg1');
		$('<input type="hidden" class="f_hidden" name="file_name_image[]" value="'+readerEvt.name+'" >').insertAfter('#file_hidden1');
		var numselect = 1;
		
		numselect = $('#reviewimg1 .numselect').val();
		$('#reviewimg .numselect').val(parseInt(numselect) +1 );
		DeleteFile1();
	}
	
	// Delete File
	function DeleteFile1(){
		$(".delete").click(function(){
			// alert('ok')
			$(this).parents(".col-md-6").remove();
			var numdelete = 1;
			var name_old = [];
			// Xoa file cu
			var file_id = $(this).parent(".img-wrap").find('.filename_db').val();
			var list_file_id_db = $('.list_file_id_db').val();
			if(list_file_id_db == ""){
				$('.list_file_id_db').val(file_id)
			}else{
				$('.list_file_id_db').val(list_file_id_db+','+file_id)
			}
			// Xoa file moi
			var name = $(this).parent(".img-wrap").find('img').attr('data-id');

            if($('#file_name_image_delete1').val() != ""){
				name_old.push($('#file_name_image_delete1').val());
				numdelete = $('#reviewimg1 .numdelete').val();
				$('#reviewimg1 .numdelete').val(parseInt(numdelete) +1 );
				DeleteFile1();
            }
            name_old.push(name);
            // console.log(name_old);
            $('#file_name_image_delete1').val(name_old);
        });
        
	}
	//Apply the validation rules for attachments upload
	function ApplyFileValidationRules(readerEvt){
		//To check file type according to upload conditions
		if (CheckFileType(readerEvt.type) == false) {
		    alert(
		      "Ảnh (" +
		        readerEvt.name +
		        ") không nằm trogn điều kiện upload, File ảnh phải thuộc định dạng  jpg/png/gif "
		    );
		    e.preventDefault();
		    return;
		}

		//To check file Size according to upload conditions
		if (CheckFileSize(readerEvt.size) == false) {
		    alert(
		      "Kích thước ảnh (" +
		        readerEvt.name +
		        ") quá lớn, Bạn nên chọn ảnh không vượt quá 300 KB"
		    );
		    e.preventDefault();
		    return;
		}

	}
	// 
	//To check file type according to upload conditions
	function CheckFileType(fileType) {
	  	if (fileType == "image/jpeg") {
	    	return true;
	  	} else if (fileType == "image/png") {
	    	return true;
	  	} else if (fileType == "image/gif") {
	    	return true;
	  	} else {
	    	return false;
	  	}
		return true;
	}
	//To check file Size according to upload conditions
	function CheckFileSize(fileSize) {
	  	if (fileSize < 30000000) {
	    	return true;
	  	} else {
	    	return false;
	  	}
  		return true;
	}
	
})
