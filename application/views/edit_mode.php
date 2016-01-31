<?php
if (count($route) > 0) {
	echo '<script>var loadedRoute = ' . json_encode($route) . ';</script>';
} else {
	echo '<script>var loadedRoute = [];</script>';
}
?>
<script src="<?php echo base_url();?>application/views/scripts/map_manager.js" ></script>

<input type="hidden" id="uglyurlpatch" value="<?php echo site_url('edit_view/save');?>">
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
					<label for="login">Nom</label>
				</div>
			</div>
			<div class="row">
				<div class="input-field col s12">
					<input name="marker-desc" id="marker-desc" type="text" class="validate">
					<label for="password">Description</label>
				</div>
			</div>
		</form>
	</div>
	<div class="modal-footer">
		<a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat" onclick="addMarker();">OK</a>
	</div>
</div>