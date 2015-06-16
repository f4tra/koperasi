<!--<script type="text/javascript"
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC3djcoUUJUsI7MkrZarlq8kUBdu3Axorc&sensor=true">
    </script>-->
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
	<div class="row">
		<div class="col-md-12">
			<!-- BOX -->
			<div class="box border green">
				<div class="box-title">
					<h4><i class="fa fa-table"></i>Maps</h4> 					
				</div>
				<div class="box-body">
					<div id="map-canvas" style="min-width: 310px; height: 400px; margin: 0px auto; position: relative;"></div>
					<div id="infoPanel">
    <b>Marker status:</b>
    <div id="markerStatus"><i>Click and drag the marker.</i></div>
    <b>Current position:</b>
    <div id="info"></div>
    <b>Closest matching address:</b>
    <div id="address"></div>
  </div>
				</div>
			</div>
		</div>
	</div>
	
		
	
	</div>
</div>
<script type="text/javascript">
$(document).ready(function() {
	initialize();
	 var i = 0;
	interval = setInterval("initialize()", 500);
	clearInterval(interval)
	
});
var infowindow = null;
/*
 * Inisialiasis Google Maps
 *
 */
function initialize() {
	var centerMap = new google.maps.LatLng(-0.7893,113.9213);
	var mapOptions = {
		zoom: 5,
		center: centerMap,
		scaleControl: true,
		mapTypeId: google.maps.MapTypeId.ROADMAP
	}
	var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
	var sites = [		
			<?php foreach($e as $r){
				echo "['".$r->name."','".$r->gpsx."','".$r->gpsy."','".$r->name."','".$r->id."'],";
			};?>
			];
	setMarkers(map,sites);
	infowindow = new google.maps.InfoWindow({
		content: "loading...", maxWidth: 250
	});
	
}
function setMarkers(map, markers) {
	//start
	/* var shadow = {
			url	: '<?php echo base_url()?>images/gmap/beachflag_shadow.png',
			size: new google.maps.Size(37, 32),
			origin: new google.maps.Point(0,0),
			anchor: new google.maps.Point(0, 32)
	};*/
	var shape = {
		coord: [1, 1, 1, 20, 18, 20, 18 , 1],
		type: 'poly'
	}; 
	//end
	var i= 0;
    for (i = 0; i < markers.length; i++) {
		var sites = markers[i];
        var siteLatLng = new google.maps.LatLng(sites[1], sites[2]);		
		var marker = new google.maps.Marker({
			position: siteLatLng,
            map: map,
        	shape: shape,
            title: sites[0],            
			html: sites[3],
			draggable: true,
			idx:sites[4]
			//icon: sites[4],
        });
		// text array ke 3
        google.maps.event.addListener(marker, "click", function () {
			infowindow.setContent(this.html);			
            infowindow.open(map, this);
            	 //alert(this.html);
        });
        // Update current position info.
  		updateMarkerPosition(siteLatLng);
  		geocodePosition(siteLatLng);
  
  		// Add dragging event listeners.
  		google.maps.event.addListener(marker, 'dragstart', function() {
    		updateMarkerAddress('Dragging...');    		
  		});
  		google.maps.event.addListener(marker, 'drag', function() {
    		updateMarkerStatus('Dragging...');
   			updateMarkerPosition(marker.getPosition());
  		});
  
		google.maps.event.addListener(marker, 'dragend', function() {
		    //alert('sdf');
		    //console.log(data.latLng);getTitle()
		    var ll = marker.getPosition();
		    //alert(this.idx);
		    updateMarkerStatus('Drag ended');
		    geocodePosition(marker.getPosition());
		    $.ajax({
		        url: "<?php echo site_url('organization/nodemap/maps_push');?>", //http://localhost/auf_pmt/",
		        type:"POST",
		        data: {
		          id : this.idx,
		          gpsx :ll['k'],
		          gpsy :ll['B'],
		          //zipcode: 97201
		        },
		        success: function( data ) {
		          //alert(marker.getPosition())
		          //alert(data.title);
		          //$( "#weather-temp" ).html( "<strong>" + data + "</strong> degrees" );
		        },
		        error:function(){
		          //alert(marker.getPosition())
		        }
		      });
		  });
    }
}


var geocoder = new google.maps.Geocoder();

function geocodePosition(pos) {
  geocoder.geocode({
    latLng: pos
  }, function(responses) {
    if (responses && responses.length > 0) {
      updateMarkerAddress(responses[0].formatted_address);
    } else {
      updateMarkerAddress('Cannot determine address at this location.');
    }
  });
}

function updateMarkerStatus(str) {
  document.getElementById('markerStatus').innerHTML = str;
}

function updateMarkerPosition(latLng) {
  document.getElementById('info').innerHTML = [
    latLng.lat(),
    latLng.lng()
  ].join(', ');
}

function updateMarkerAddress(str) {
  document.getElementById('address').innerHTML = str;
}

</script>
