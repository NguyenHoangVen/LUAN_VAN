@extends('layouts.index')
@section('content')
<div id="content">
	<div class="container">
		<form action="" id="form-map-search" >
			{{ csrf_field() }}
			<div class="row mt-2">
					<div class="col-md-3">
						<div class="form-group">
							<select name="method" class="form-control" id="method">
								<option value="1">Lựa chọn tìm kiếm</option>
								<option value="1">Tìm theo địa điểm</option>
								<option value="2">Tìm xung quanh </option>
							</select>
						</div>
					</div>
					<div class="col-md-6">
						
							<div class="input-group mb-3">
							    <input type="text" class="form-control" placeholder="Nhập từ khóa tìm kiếm" id="search_name">
							    <!-- Tìm xung quanh -->
							    <input type="text" class="form-control d-none" placeholder="Nhập vào một nơi bạn muốn tìm" id="search_around" >
							    <div class="input-group-append">
							      <input type="submit" class="input-group-text bg-warning" value="Tìm kiếm" style="cursor: pointer">
							    </div>
							</div>
						
					</div>
					<div class="col-md-3">
						<input type="hidden" name="lat" id="lat_search">
						<input type="hidden" name="lng" id="lng_search">
					</div>
				<!-- <div class="col-md-4 col-md-push-8 bg-info">df</div> -->
				
			</div>	
		</form>
	</div>
	<div id="map-place-info" style="height: 600px" ></div>
</div>
@endsection
@section('script')

<script>
	
	function initMap(){
		var location = {lat: 10.784803, lng: 106.626314};
		var myOption = {
			// mapTypeId:'satellite',
			mapTypeControl: false,
          	center: location,
          	zoom: 6,

		}
		
		var map = new google.maps.Map(document.getElementById('map-place-info'),myOption);
		var input = document.getElementById("search_around");

		// var input = document.getElementById("addresss");
		var autocomplete = new google.maps.places.Autocomplete(input);
		
		autocomplete.bindTo("bounds", map);
		// Chi xac dinh cac truong du lieu can
		autocomplete.setFields(["place_id", "geometry", "name"]);

		var service = new google.maps.places.PlacesService(map);
		autocomplete.addListener('place_changed',()=>{
			var place = autocomplete.getPlace();
			
			document.getElementById('lat_search').value=place.geometry.location.lat();
			document.getElementById('lng_search').value=place.geometry.location.lng();
			
		})
	
		
		
		
		
		
	}
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAooDY7d6iFESb-veaQGNNeSVrb_isnJUI&libraries=places&callback=initMap"
defer></script>
@endsection