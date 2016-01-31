
<?php if(isset($usr_route)):?>
    <script>
        var loadedRoute = <?php echo json_encode($usr_route) ?>;
        var routeName = loadedRoute.name;
        var routeDescription = loadedRoute.description;
        var descriptionMarkers = <?php  echo json_encode($desc_markers);?>;
    </script>
<?php else: ?>
    <script>
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
<div class="row">
    <div id="map-wrapper" class="col s12" style="position:relative;">
		<div id="floating-panel">
		   <!--<input onclick="clearMarkers();" type=button value="Hide Markers">
		   <input onclick="showMarkers();" type=button value="Show All Markers">
		   <input onclick="deleteMarkers();" type=button value="Delete Markers">-->
		   <div id="titleDiv"><h5 >Clique sur la carte pour commencer!</h5></div>
		</div>
        <div id="map-canvas" style="width: 100%; height: 600px; margin: 20px 0 0 0; padding: 15px;"></div>
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