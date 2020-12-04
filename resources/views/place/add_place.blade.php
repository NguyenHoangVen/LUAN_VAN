@extends('layouts.index')
@section('content')
<div id="content">
	<div id="add-place">
		<div class="head-title">
			<div class="container">
				<div class="row">
					<div class="col-12"><h1><i class="fas fa-map-marker-alt mr-2"></i>CheckIn chia sẻ địa điểm</h1></div>
				</div>
			</div>
		</div>
		<div class="wp-form-add-place">
			<div class="container">
				<form id="check_in" method="post" action="{{url('post-add-place')}}" >
					{{ csrf_field() }}
					<div class="geneger-info">
						<div class="row">
							<div class="col-2"></div>
							<!-- <div class="name-title">Địa điểm</div> -->
							<div class="col-lg-8 bg-white pt-4 pb-4">
								<div class="name-title">Thông tin nơi bạn muốn chia sẻ</div>
								<div class="form-group mt-4 ralative-live-search">
									<label for="name_place">Tên địa điểm <span style="color: red">*</span></label>
									@error('id_topic')
									<p class="form-error">{{$message}}</p>
									@enderror
									<input type="text" class="form-control" placeholder="Nhập tên địa điểm, chủ đề" id="place_topic" name="name_topic" autocomplete='off' value="{{ old('name_topic') }}">
									<input type="hidden" id="id_topic" name="id_topic" value="{{ old('id_topic') }}">
									<!-- <div  data-toggle="modal" data-target="#addTopicPlace1">dg</div> -->
									<div id="result-topic" class="d-none">
										
									</div>
									<!-- end reult live search -->
								</div>
								
								<div class="form-group mt-4">
									<label for="name_place">Đặt tiêu đề cho bài viết <span style="color: red">*</span></label>
									@error('title')
									<p class="form-error">{{$message}}</p>
									@enderror
									<input type="text" class="form-control" placeholder="Nhập vào tiêu đề" id="name_place" name="title" value="{{ old('title') }}">
								</div>
								
								<div class="introduce-content form-group">
									<label for="name_place">Nội dung của bài viết <span style="color: red">*</span></label>
									@error('content')
									<p class="form-error">{{$message}}</p>
									@enderror
									<textarea name="content" id="content" class="summernote">{{old('content')}}</textarea>
								</div>
								
								<div class="">
									<button class="btn btn-success w-100">Đăng</button>
								</div>
							</div>
							<div class="col-2"></div>	
						</div>
					</div>
					
				</form>
			</div>
		</div>
	</div>
	
	<!-- form upload anh danh cho dia diem -->
	<div id="addTopicPlace" class="modal" >
			<div class="modal-dialog modal-lg">

				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title"><i class="fas fa-edit mr-2"></i>Thêm địa điểm</h4>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>
					<div class="modal-body">
						<div class="wp-form-add-topic">
							<form id="formAddTopic" name="formRating" enctype="multipart/form-data" method="post">
								{{ csrf_field() }}
								<div class="row">
									<div class="col-8">
										<div class="form-group">
											<label for="email">Tên địa điểm của bạn muốn tạo là</label>
											<p class="form-error" id="error-name"></p>
											<input type="text" class="form-control" placeholder="Nhập tên địa điểm" name="name" id="name" disabled="">
											<input type="hidden" id="lat" name="lat">
											<input type="hidden" id="lng" name="lng">
											<!--  -->
											<div id="get-name-topic"></div>
										</div>	
									</div>
									<div class="col-4">
										<div class="form-group">
											<label for="email">Chọn vùng miền</label>
											<p class="form-error" id="error-region"></p>
											<select name="region" class="form-control" id="region">
												<option value="">--Chọn vùng miền--</option>
												@foreach($region as $item)
												<option value="{{$item->id}}">{{$item->region_name}}</option>
												@endforeach
											</select>
										</div>
									</div>
								</div>
								<div class="form-group">
									<label for="email">Cập nhật vị trí<span class="text-danger">(bắt buộc *)</span></label>
									<p class="form-error" id="error-address"></p>
									<input type="text" class="form-control" placeholder="Nhập vị trí, nơi muốn cập nhật" id="address" name="address">
									

								</div>	
								<div class="form-group">
									<input type="text" name="city" class="city form-control">
								</div>
								<div class="map-location form-group" style="width: 100%;height: 350px">
									<div id="map" style="width: 100%;height: 100%"></div>
								</div>
								<div class="form-group">
									<label for="email">Tải ảnh lên</label>
									<p class="form-error" id="error-file"></p>
									<div class="choseFile custom-file">
										<input type="file" class="custom-file-input" multiple="" id="uploadImgAddTopic" name="image[]">
										<div class="icon-image"></div>
										<!-- image delete -->
										<div id="file_hidden"></div>
										<input type="hidden" id="file_name_image_delete" name="file_delete">
									</div>

								</div>
								<div class="row">
									<div id="reviewimg"></div>
								</div>
								<!-- success add -->
								<div class="success-msg mt-2 mb-2 d-none">
									<div class="alert alert-success">Thêm Topic thành công!</div>
								</div>
								
								<div class="form-group">
									<button class="btn btn-success w-100">Send</button>
								</div>
								
							</form>
						</div>
						
					</div>
				</div>
				
			</div>
	</div>
	
</div>

@endsection
<!-- SCRIPT -->
@section('script')
<script src="js/uploadfile.js"></script>

<script>
	var exist = '{{Session::has('checkin_success')}}';
    if(exist){
        Swal.fire({
	        position: 'center',
	        icon: 'success',
	        title: 'Thêm địa điểm thành công !',
	        // showConfirmButton: false,
	        // button:'ok'
	        // timer: 1800
	    })
    }
    // ==== Get topic from input to modal add topic====
    function moveTopic(value){
    	$('#moveTopic').click(function(){
	    	
	    	$('#formAddTopic #name').val(value);
	    	
	    	$('#get-name-topic').html('<input type="hidden" name="name" value="'+value+'" >');
	    	// return false;
	    })
    }
    // ====Live search topic====
	$('#place_topic').keyup(function(){
    	var key_word = $(this).val();
    	$('#id_topic').val('');
    	$.ajax({
    		headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url:'live-search-topic',
            method:'post',
            data:{key_word:key_word},
            dataType:'text',
            success:function(data){
            	// console.log(data);
            	$('#result-topic').removeClass('d-none');
            	$('#result-topic').html(data);
            	selectTopic();
            	moveTopic(key_word);
            	
            	if(key_word == ''){
            		$('#result-topic').addClass('d-none');
            	}
            }
    	})
    })
    // === Select Topic from rasult live search==
    function selectTopic(){
	    $('#result-topic .topic').click(function(){
	    	$('#place_topic').val($(this).find('.name').text());
	    	var id_topic = $(this).find('.id-topic').val();
	    	$('#id_topic').val(id_topic);
	    	$('#result-topic').addClass('d-none');
	    	
	    })
	}

</script>
<script>

	function initMap(){

		var location = {lat:10.036200,lng:105.788033};
        var map = new google.maps.Map(document.getElementById('map'), {
          	mapTypeControl: false,
          	center: location,
          	zoom: 13

        });
        // input text nguoi dung nhap
        var input = document.getElementById("address");
        var autocomplete = new google.maps.places.Autocomplete(input);
		autocomplete.bindTo("bounds", map);
		// Chi xac dinh cac truong du lieu can
		autocomplete.setFields(["place_id", "geometry", "name"]);
		// 
		// map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
		// tao service va infowindow
	    var infowindow = new google.maps.InfoWindow();
		var service = new google.maps.places.PlacesService(map);
		// Bat su kien changed input 
		autocomplete.addListener('place_changed',()=>{
			
			var place = autocomplete.getPlace();
			var place_id = place.place_id;
			var marker = new google.maps.Marker({
	          	position:place.geometry.location,
	          	map:map,
	          	draggable: true
	        });
	        // 
	        if (!place.geometry) {
		    	return;
		    }
		    // =========
		    if (place.geometry.viewport) {
  				map.fitBounds(place.geometry.viewport);
			} else {
			    map.setCenter(place.geometry.location);
			    map.setZoom(17);
			} 
			// ==goi ham lay chi tiet dia diem
			place_detail(place_id,marker);
			 // Bat su kien khi keo tha marker
            google.maps.event.addListener(marker, 'dragend', function(event){
				
				var geocoder = new google.maps.Geocoder;

				latitude=marker.getPosition().lat();               
				longitude=marker.getPosition().lng();
				var latlng = {lat: parseFloat(latitude), lng: parseFloat(longitude)};
				// ==========

				geocoder.geocode({'location':latlng},function(result,status){
					if (status === google.maps.GeocoderStatus.OK){
						console.log(result)
						if (result[1]) {
							
					       	place_detail(result[1].place_id,marker);
					    } else {
					        window.alert('No results found');
					    }
					}else{
						window.alert('Geocoder failed due to: ' + status);
					}
				})
				
			});
		})

		// ========================
	

	
		function place_detail(place_id,marker){
			// request 
       		var request = {
	          	placeId: place_id,
	          	fields: ["name", "formatted_address", "place_id", "geometry"],
	        };
	       
       		// =========
		   	service.getDetails(request,(place,status)=>{
		   		if(status==google.maps.places.PlacesServiceStatus.OK){
		   			
		   			infowindow.setContent(
            			"<div><strong>" +
              			place.name +
              			"</strong><br>" +
              			"Place ID: " +
              			place.place_id +
              			"<br>" +
              			place.formatted_address +
              			"</div>"
              		);
              		// Tra ket qua len form
              		document.getElementById('address').value = place.formatted_address;
              		document.getElementById('lat').value = place.geometry.location.lat();
              		document.getElementById('lng').value = place.geometry.location.lng();
              		console.log(place);
              		$('#formAddTopic .city').val(place.formatted_address);
              		// Goi su kien click vaf dragend marker
		   			google.maps.event.addListener(marker,'click',function(){
			            infowindow.open(map, marker);
		            });
		            google.maps.event.addListener(marker,'dragend',function(){
			            infowindow.open(map, marker);
		            })
		           
		   		}
		   	})
		}
	}
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAooDY7d6iFESb-veaQGNNeSVrb_isnJUI&libraries=places&callback=initMap&sensor=false"
defer></script>
@endsection