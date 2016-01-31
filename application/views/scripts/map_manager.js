//Global variables
var lastClickPosition;
var map;
var poly;
var initialCount = 0;
var road = [];
var pointsOfInterest = [];
var roadIsComplete = false;

function initView() {
  if (routeName != "") {
    initMap();
  } else {
    $('#routeInfoModal').openModal();
  }  
}

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
  if (loadedRoute.length > 0) {
    initialCount = loadedRoute.length;
    nbLoadedRoutes = loadedRoute.length;
    for (var i = 0; i < nbLoadedRoutes; i++) {
      road.push(new google.maps.LatLng(parseFloat(loadedRoute[i]['marker_lat']), parseFloat(loadedRoute[i]['marker_long'])));
    }
    compileRoad();
    
        $('#titleDiv h5')[0].innerHTML = "Rebienvenue! Tu peux ajouter des points &agrave; ta route, laisse moi savoir quand tu auras fini!";
        $('#titleDiv')[0].innerHTML =
          $('#titleDiv h5').prop('outerHTML') +
          "<br/><br/><a id='roadDoneButton' class='waves-effect waves-light btn' onclick='completeRoad()'>Ma route est prête!</a>";
  }  
}

function updateRouteInfo() {
  routeName = $("#route-name")[0].value;
  routeDescription = $("#route-desc")[0].value;
  initMap();
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
      case 1: $('#titleDiv h5')[0].innerHTML = "Choisi un autre point pour tracer la route!"; break;
      default:
        $('#titleDiv h5')[0].innerHTML = "Good job! Ajoute autant de points que tu le veux et dit moi quand tu auras terminé!";
        $('#titleDiv')[0].innerHTML =
          $('#titleDiv h5').prop('outerHTML') +
          "<br/><br/><a id='roadDoneButton' class='waves-effect waves-light btn' onclick='completeRoad()'>Ma route est prête!</a>";
        break;
    }
  } else {
    lastClickPosition = currentMarker;
    $('#pointOfInterestModal').openModal();
  }
}

function addMarker() {
  var markerName = $('#marker-name')[0].value;
  var markerDescription = $('#marker-desc')[0].value;
  $('#marker-name')[0].value = '';
  $('#marker-desc')[0].value = '';

  // Add a new marker at the new plotted point on the polyline.
  var marker = new google.maps.Marker({
    position: lastClickPosition,
    title: markerName,
    map: map,
    draggable: true,
    markerName: markerName
  });

  pointsOfInterest.push({'marker': marker, 'name': markerName, 'desc': markerDescription});

  marker.addListener('click', function() {
    var nbPointsOfInterest = pointsOfInterest.length;
    for (var i = 0; i < nbPointsOfInterest; i++) {
      if (pointsOfInterest[i].marker.position == marker.position) {
        break;
      }
    }
    var contentString ='<div id="content"><h6>Point d\'int&eacute;r&ecirc;t #' + (i + 1) + '</h6><a onclick="deleteMarker(' + marker.position.lat() + ', ' + marker.position.lng() + ')"><i class="small material-icons" style="position: absolute;top: 1px;right: 15px;font-size: 13px;">delete</i></a>Name: ' + marker.markerName + '<br>Location : (' + marker.position.lat().toFixed(4) + ', ' + marker.position.lng().toFixed(4) + ')</div>';
    var infowindow = new google.maps.InfoWindow({
       content: contentString
    });
    infowindow.open(map, marker);
  });
}

function deleteMarker(lat, lng) {
  //debugger;
  var nbPointsOfInterest = pointsOfInterest.length;
  for (var i = 0; i < nbPointsOfInterest; i++) {
    if (pointsOfInterest[i].marker.position.lat() == lat && pointsOfInterest[i].marker.position.lng() == lng) {
      pointsOfInterest[i].marker.setMap(null);
      pointsOfInterest.splice(i, 1);
      break;
    }
  }
  //compilePointsOfInterest();
}

function deleteRoadPoint(idx) {
  road.splice(idx,1);
  poly.setPath(road);
}

function completeRoad() {
  $('#titleDiv h5')[0].innerHTML = "Maintenant que ta route est prête, tu peux ajouter autant de points d'intérêt que tu le veux, ou simplement en rester là.";
  $('#roadDoneButton')[0].innerHTML = "Enregistrer";
  $("#roadDoneButton").attr("onclick","completeWTFAMI()");
  roadIsComplete = true;
}

function completeWTFAMI() {
  console.log(road[0], pointsOfInterest);
  var road_markers = [];
  var pois = [];
  for(var i = 0; i < road.length; i++) {
    road_markers.push(
        {
          lat: road[i].lat(),
          long: road[i].lng()
        }
    );
  }
  for(var i = 0; i < pointsOfInterest.length; i++) {
    pois.push(
        {
            name: pointsOfInterest[i].name,
            description: pointsOfInterest[i].desc,
            lat: pointsOfInterest[i].marker.position.lat(),
            long: pointsOfInterest[i].marker.position.lng()
        }
    );

  }
  var routes = {
    'routes_markers': road_markers,
    'route_markers_descriptions': pois,
    'route_id': $('#route_id').val()
  };

  $.ajax({
    type:    'POST',
    url:     $('#uglyurlpatch').val(),
    data:    routes,
    dataType:'JSON',
    success: function(data) {
        console.log("succeess");
    }
  });
}

function compileRoad() {
  var path = poly.getPath();
  nbRoadPoints = road.length;
  for (var i = 0; i < nbRoadPoints; i++) {
     // Because path is an MVCArray, we can simply append a new coordinate and it will automatically appear.
    path.push(road[i]);
  }
}

function compilePointsOfInterest() {
  setMapOnAll(null);
  nbPointsOfInterest = pointsOfInterest.length;
  for (var i = 0; i < nbPointsOfInterest; i++) {
    // Add a new marker at the new plotted point on the polyline.
    var marker = new google.maps.Marker({
      position: lastClickPosition,
      title: markerName,
      map: map,
      draggable: true,
      markerName: markerName
    });

    pointsOfInterest.push({'marker': marker, 'name': markerName, 'desc': markerDescription});

    marker.addListener('click', function() {
      var nbPointsOfInterest = pointsOfInterest.length;
      for (var i = 0; i < nbPointsOfInterest; i++) {
        if (pointsOfInterest[i].marker.position == marker.position) {
          break;
        }
      }
      var contentString ='<div id="content"><h6>Point d\'int&eacute;r&ecirc;t #' + (i + 1) + '</h6><a onclick="deleteMarker(' + marker.position.lat() + ', ' + marker.position.lng() + ')"><i class="small material-icons" style="position: absolute;top: 1px;right: 15px;font-size: 13px;">delete</i></a>Name: ' + marker.markerName + '<br>Location : (' + marker.position.lat().toFixed(4) + ', ' + marker.position.lng().toFixed(4) + ')</div>';
      var infowindow = new google.maps.InfoWindow({
         content: contentString
      });
      infowindow.open(map, marker);
    });
  }
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
