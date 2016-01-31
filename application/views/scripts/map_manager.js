//Global variables
var lastClickPosition;
var map;
var poly;
var road = [];
var pointsOfInterest = [];
var roadIsComplete = false;

function initMap() {
  var mapOptions = {
    zoom: 15,
    mapTypeId: google.maps.MapTypeId.ROADMAP
  };

  map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
  poly = new google.maps.Polyline({ strokeColor: '#000000 ', strokeOpacity: 1.0, strokeWeight: 3 });
  poly.setMap(map);

  // Add a listener for the click event
  map.addListener('click', onMapClick);
  
  // Try HTML5 geolocation
  if(navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function(position) {
      var pos = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
      map.setCenter(pos);
    }, function() {
      handleNoGeolocation(true);
    });

    var contentString = '<div id="content"><div id="siteNotice"></div></div>';

    var infowindow = new google.maps.InfoWindow({
      content: contentString
    });
  } else {
    handleNoGeolocation(false);
  }
}

// Handles click events on a map, and adds a new point to the Polyline.
function onMapClick(event) {
  currentMarker = event.latLng;

  if (!roadIsComplete) {
    var path = poly.getPath();

     // Because path is an MVCArray, we can simply append a new coordinate and it will automatically appear.
    path.push(currentMarker);

    road.push(currentMarker);

    switch (road.length) {
      case 1: $('#titleDiv h5')[0].innerHTML = "OK, where are we going next?"; break;
      case 2:
        $('#titleDiv h5')[0].innerHTML = "Nice! Now, add as many waypoints as you'd like until you're done!";
        $('#titleDiv')[0].innerHTML =
          $('#titleDiv h5').prop('outerHTML') +
          "<br/><br/><a id='roadDoneButton' class='waves-effect waves-light btn' onclick='completeRoad()'>I'm done!</a>";
        break;
    }
  } else {
    lastClickPosition = currentMarker;
    $('#pointOfInterestModal').openModal();
  }
}

function addMarker() {

  var markerName = $('#marker-name').value;
  var markerDescription = $('#marker-desc').value;

  // Add a new marker at the new plotted point on the polyline.
   var marker = new google.maps.Marker({
       position: lastClickPosition,
       title: markerName,
       map: map
   });

   pointsOfInterest.push({'marker': marker, 'name': markerName, 'desc': markerDescription});
}

function completeRoad() {
  $('#titleDiv h5')[0].innerHTML = "Your road is now ready. You can now add some POIs if you wish, or just leave it at that!";
  $('#roadDoneButton')[0].innerHTML = "Save";
  $("#roadDoneButton").attr("onclick","completeWTFAMI()");
  roadIsComplete = true;
}

function completeWTFAMI() {
  alert('Nothing to do here!');
}

function handleNoGeolocation(errorFlag) {
  if (errorFlag) {
    var content = 'Error: The Geolocation service failed.';
  } else {
    var content = 'Error: Your browser doesn\'t support geolocation.';
  }

  var options = {
    map: map,
    position: new google.maps.LatLng(60, 105),
    content: content
  };

  var infowindow = new google.maps.InfoWindow(options);
  map.setCenter(options.position);
}