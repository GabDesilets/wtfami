
<?php if(isset($usr_route)):?>
    <script>
    	var editMode = false;
        var loadedRoute = <?php echo json_encode($usr_route) ?>;
        var routeName = loadedRoute.name;
        var routeDescription = loadedRoute.description;
        var descriptionMarkers = <?php  echo json_encode($desc_markers);?>;
    </script>
<?php else: ?>
    <script>
    	var editMode = false;
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
<input type="hidden" id="route_id" value="<?php echo $route_id?>">
<div class="row">
    <div id="map-wrapper" class="col s12" style="position:relative;">
        <div id="map-canvas" style="width: 100%; height: 600px; margin: 20px 0 0 0; padding: 15px;"></div>
    </div>
</div>