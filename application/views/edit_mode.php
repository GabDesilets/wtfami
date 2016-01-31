
<?php if(isset($usr_route)):?>
    <script>
    	var editMode = true;
        var loadedRoute = <?php echo json_encode($usr_route) ?>;
        var routeName = loadedRoute[0].name;
        var routeDescription = loadedRoute[0].description;
        var descriptionMarkers = <?php  echo json_encode($desc_markers);?>;
    </script>
<?php else: ?>
    <script>
    	var editMode = true;
        var loadedRoute = [];
        var routeName = "";
        var routeDescription = "";
        var descriptionMarkers = [];
    </script>
<?php endif; ?>

<script async defer
       src="http://maps.googleapis.com/maps/api/js?key=AIzaSyBu9AE8MvT526Yv37X05wdlT6qAdCXrnUQ&signed_in=true&callback=initView"></script>
<script src="<?php echo base_url();?>application/views/scripts/map_manager.js" ></script>

<input type="hidden" id="uglyurlpatch" value="<?php echo site_url('edit_mode/save');?>">
<input type="hidden" id="route_id" value="<?php echo isset($route) ? $route->id : '' ?>">
<div class="row">
    <div id="route-info-box" class="col s12">
	    <h5 id="route-name-disp"><?php echo isset($route) ? $route->name : ''; ?></h5>
	    <div><p id="route-desc-disp"><?php echo isset($route) ? $route->description : ''?></p></div>
	</div>
    <div id="map-wrapper" class="col s12" style="position:relative;">
		<div id="floating-panel">
		   <div id="titleDiv"><h5 >Clique sur la carte pour commencer!</h5></div>
		</div>
        <div id="map-canvas" style="width: 100%; height: 500px; margin: 20px 0 0 0; padding: 15px;"></div>
    </div>
</div>
<div id="pointOfInterestModal" class="modal">
	<div class="modal-content">
		<h4>Ajouter un marqueur</h4>
		<form name="frmNewMarker">
			<div class="row">
				<div class="input-field col s12">
					<input name="marker-name" id="marker-name" type="text" class="validate">
					<label for="marker-name">Nom</label>
				</div>
			</div>
			<div class="row">
				<div class="input-field col s12">
					<input name="marker-desc" id="marker-desc" type="text" class="validate">
					<label for="marker-desc">Description</label>
				</div>
			</div>
		</form>
	</div>
	<div class="modal-footer">
		<a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat" onclick="addMarker();">OK</a>
	</div>
</div>
<div id="routeInfoModal" class="modal">
	<div class="modal-content">
		<h4>Ajouter une route</h4>
		<form name="frmNewRoute">
			<div class="row">
				<div class="input-field col s12">
					<input name="route-name" id="route-name" type="text" class="validate">
					<label for="route-name">Nom</label>
				</div>
			</div>
			<div class="row">
				<div class="input-field col s12">
					<input name="route-desc" id="route-desc" type="text" class="validate">
					<label for="route-desc">Description</label>
				</div>
			</div>
		</form>
	</div>
	<div class="modal-footer">
		<a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat" onclick="updateRouteInfo();">OK</a>
	</div>
</div>
<script>
	var lineSymbol = {
		path: google.maps.SymbolPath.FORWARD_CLOSED_ARROW,
		scale: 4,
		strokeColor: '#ee6e73'
	};
	var road_markers_SIM = [];
	for(var i = 0; i < road.length; i++) {
		road_markers_SIM.push(
				{
					lat: road[i].lat(),
					lng: road[i].lng()
				}
		);
		find_closest_marker(road[i].lat(), road[i].lng());
	};
	// Create the polyline and add the symbol to it via the 'icons' property.
	var line = new google.maps.Polyline({
		path: road_markers_SIM,
		icons: [{
			icon: lineSymbol,
			offset: '100%'
		}],
		map: map
	});

	animateCircle(line);

	// Use the DOM setInterval() function to change the offset of the symbol
	// at fixed intervals.
	function animateCircle(line) {
		var count = 0;

		var totalLatLong = road_markers_SIM.length;
		var tot = 0;
		window.setInterval(function() {
			count = (count + 1) % 200;
			tot++;
			var icons = line.get('icons');
			icons[0].offset = (count / 2) + '%';
			line.set('icons', icons);
			console.log(totalLatLong, tot);

		}, 15);
	}

	function rad(x) {return x*Math.PI/180;}

	function find_closest_marker(la, ln) {
		var lat = la;
		var lng = ln;
		var R = 0.00005; // radius of earth in km
		var distances = [];
		var closest = -1;

		for(var i = 0; i < pointsOfInterest.length; i++) {
			var mlat = pointsOfInterest[i].marker.position.lat();
			var mlng = pointsOfInterest[i].marker.position.lng();
			var dLat  = rad(mlat - lat);
			var dLong = rad(mlng - lng);
			var a = Math.sin(dLat/2) * Math.sin(dLat/2) +
					Math.cos(rad(lat)) * Math.cos(rad(lat)) * Math.sin(dLong/2) * Math.sin(dLong/2);
			var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a));
			var d = R * c;
			distances[i] = d;
			if ( closest == -1 || d < distances[closest] ) {
				closest = i;
			}
		}

		var contentString ='' +
				'<div id="content"><h6>Point d\'int&eacute;r&ecirc;t #' + (i + 1) +
				'</h6><a onclick="deleteMarker(' + pointsOfInterest[closest].marker.position.lat() + ', '
				+ pointsOfInterest[closest].marker.position.lng() + ')">' +
				'<i class="small material-icons" style="position: absolute;top: 1px;right: 15px;font-size: 13px;">delete</i>' +
				'</a>Name: ' + pointsOfInterest[closest].markerName +
				'<br>Location : (' + pointsOfInterest[closest].marker.position.lat().toFixed(4) + ', ' + pointsOfInterest[closest].marker.position.lng().toFixed(4) + ')' +
				'</div>';
		var infowindow = new google.maps.InfoWindow({
			content: contentString
		});
		infowindow.open(map, pointsOfInterest[closest].marker);
	}
	function simulate()
	{

	}
</script>