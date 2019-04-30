@extends('layouts.app')
@section('content')
	<form method="POST" action="/freelancer/add" enctype="multipart/form-data">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<h3 class="text-uppercase">ADD FREELANCER</h3>
				</div>
			</div>
			<div class="row mt-4">
				<div class="col-12">
					<ul class="nav nav-tabs" id="myTab" role="tablist">
					  	<li class="nav-item">
					    	<a class="nav-link active show" id="professional-tab" data-toggle="tab" href="#freelancer" role="tab" aria-controls="freelancer" aria-selected="true">Freelancer Info</a>
					  	</li>
					  	<li class="nav-item">
					    	<a class="nav-link" id="personal-tab" data-toggle="tab" href="#personal" role="tab" aria-controls="personal" aria-selected="false">Personal</a>
					  	</li>
					</ul>
					<div class="tab-content" id="myTabContent">
					  	<div class="tab-pane fade show active in" id="freelancer" role="tabpanel" aria-labelledby="professional-tab">
					  		<div class="row mt-4">
					  			<div class="col-12">
					  				<label class="mt-2">Profession Category</label>
					  					<select class="form-control" name="profession">
					  						<option value="0">Choose</option>
					  						@forelse($categories as $category)
					  							<option value="{{$category->id}}">{{$category->name}}</option>
					  							@empty{{''}}
					  						@endforelse
					  					</select>
					  			</div>
					  			<div class="col-6">
					  				<label class="mt-4">Name</label>
					  				
					  				<input type="text" name="name" value="{!! !empty($partner)?$partner[0]->name:'' !!}" placeholder="Name" class="form-control">
					  				
					  			</div>
								<div class="col-6">				  				
					  				<label class="mt-4">Associated with</label>
					  				<input type="text" name="company" placeholder="Company/Organization" class="form-control">
					  			</div>
					  			<div class="col-12">
					  				<label class="mt-4">Search your Address</label>
					  				<div class="form-group">
		                				<input type = "text" id="pac-input" class="form-control controls" placeholder="Search area" value="{!! !empty($partner)?$partner[0]->address:'' !!}" name="location">
		                				<div id = "map-canvas"></div>
		            				</div>
		            				<a href="#" onclick="calc_lat()" class="btn btn-outline-primary">Calculate Latitude and longitude</a>
		            				<input type="hidden" name="lat" value="" id="lat">
		            				<input type="hidden" name="long" value="" id="long">
		            				<input type="hidden" name="requestid" value="{!! !empty($id)?$id:'' !!}">
					  			</div>
					  			<div class="col-6">
					  				<label class="mt-4">Serving Distance</label>
					  				<select class="form-control" name="serving_distance">
										<option value="0">Choose</option>
										<option value="0-2">0-2kms</option>				  					
										<option value="2-5">2-5kms</option>
										<option value="5-10">5-10kms</option>
										<option value=">10">more than 10kms</option>
					  				</select>
					  			</div>
					  			<div class="col-6">
					  				<label class="mt-4">Experience (in years)</label>
					  				<select class="form-control" name="experience">
					  					@for($i = 0; $i<=10; $i++)
					  						<option value="{{$i}}">{{$i}}</option>
					  					@endfor
					  				</select>
					  			</div>
					  			<div class="col-12">
					  				<label class="mt-4">Serving Locations</label>
					  				<textarea class="form-control" name="serving_locations" placeholder="(Eg. Pitampura, Lajpat Nagar)" rows="2"></textarea>
					  			</div>
					  		</div>	
					  	</div>
					  	<div class="tab-pane fade" id="personal" role="tabpanel" aria-labelledby="personal-tab">
					  		<div class="row mt-4">
					  			<div class="col-12">
					  				<label class="mt-4">Contact Number</label>
					  				<input type="text" name="phoneno" placeholder="Contact No." class="form-control" value="{!! !empty($partner)?$partner[0]->phoneno:'' !!}">
					  				<label class="mt-4">Email Id</label>
					  				<input type="text" name="emailid" placeholder="emailid" class="form-control" value="{!! !empty($partner)?$partner[0]->emailid:'' !!}">
					  				<label class="mt-4">Permanent Address</label>
					  				<textarea name="address" placeholder="Permanent Address" class="form-control" rows="2"></textarea>
					  				<label class="mt-4">Qualification</label>
					  				<textarea name="qualification" placeholder="Qualifications" class="form-control"></textarea>
									<label class="mt-4">Upload Photo</label>
					  				<input type="file" name="profile_img" accept="image/*" data-target="#profile_img" value="">
					  				<label class="mt-4">Upload Documents</label>
					  				<input type="file" name="doc_img" accept="image/*" data-target="#doc_img" value="">	  				
					  			</div>
					  		</div>
					  	</div>
					</div>
				</div>
			</div>
			{{csrf_field()}}
			<button class="btn btn-primary mt-4" type="submit">Add Freelancer</button>
		</div>
	</form>
@endsection
@section('js')
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAG8pAD_J2u-EXxHf7RflEPRWpW9hsqL7s&libraries=places&callback=initAutocomplete" async defer type="text/javascript"></script>
	<script type="text/javascript">
		function initAutocomplete() {
	        var markers = [];
	        var map = new google.maps.Map(document.getElementById('map-canvas'), {
	                center: {lat: 28.6139391, lng: 77.20902120000005},
	                zoom: 13,
	                mapTypeId: 'roadmap'
	        });

	        var input = document.getElementById('pac-input');
	        var searchBox = new google.maps.places.SearchBox(input);
	        map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

	         map.addListener('bounds_changed', function() {
	         searchBox.setBounds(map.getBounds());
	        });

	        var markers = [];
	        // Listen for the event fired when the user selects a prediction and retrieve
	        // more details for that place.
	        searchBox.addListener('places_changed', function() {
	          var places = searchBox.getPlaces();

	          if (places.length == 0) {
	            return;
	          }

	            
	        markers.forEach(function(marker) {
	            marker.setMap(null);
	          });
	          markers = [];


	            var bounds = new google.maps.LatLngBounds();
	          places.forEach(function(place) {
	            if (!place.geometry) {
	              console.log("Returned place contains no geometry");
	              return;
	            }
	            var icon = {
	              url: place.icon,
	              size: new google.maps.Size(71, 71),
	              origin: new google.maps.Point(0, 0),
	              anchor: new google.maps.Point(17, 34),
	              scaledSize: new google.maps.Size(25, 25)
	            };

	              
	              markers.push(new google.maps.Marker({
	              map: map,
	              icon: icon,
	              title: place.name,
	              position: place.geometry.location
	            }));


	            if (place.geometry.viewport) {
	              // Only geocodes have viewport.
	              bounds.union(place.geometry.viewport);
	            } else {
	              bounds.extend(place.geometry.location);
	            }
	          	});
	          	map.fitBounds(bounds);
	        });
      	}

      	function calc_lat()
		{
		    var loc = document.getElementById("pac-input").value;
		    var geocoder = new google.maps.Geocoder();
		    geocoder.geocode( { 'address': loc}, function(results, status) {            
		        if (status == google.maps.GeocoderStatus.OK) {
		            latitude = results[0].geometry.location.lat();
		            longitude = results[0].geometry.location.lng();
		            $('#lat').val(latitude);
		            $('#long').val(longitude);
		            alert("latitude: "+latitude+" & longitude: "+longitude+" are set for your current location");
		  		} 
			});  
		}
	</script>
@endsection