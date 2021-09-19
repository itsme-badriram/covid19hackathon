<?php

if(isset($_GET['lat']) && isset($_GET['lng'])){
$lat = $_GET['lat'];
$lng = $_GET['lng'];
}
else 
header("Location: volStatus.php");


?>
<!DOCTYPE html>
<html>
  <head>
    <title>Location Details</title>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 100%;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
    </style>
    <script>
      var image = "Images/pin.png"
      var lat = <?php echo $lat; ?>;
      var lng = <?php echo $lng; ?>;

      // This example requires the Places library. Include the libraries=places
      // parameter when you first load the API. For example:
      // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

        var map, infoWindow;
      function initMap() {

        map = new google.maps.Map(document.getElementById('map'), {
         // center: {lat: 27.5330, lng: 88.5122},
         center: {lat: 13.0827 ,lng: 80.2707 },
          zoom: 16
        });
        infoWindow = new google.maps.InfoWindow;

        // Try HTML5 geolocation.
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
            var pyrmont = new google.maps.LatLng(position.coords.latitude,position.coords.longitude);
            var pos = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };


         
            var marker = new google.maps.Marker({position: pos, map: map});
            infoWindow.setPosition(pos);
            infoWindow.setContent('You Are Here');
            infoWindow.open(map,marker);
         

            var place = {
              lat : lat,
              lng : lng

            }
            createMarker(place);
            map.fitBounds(new google.maps.LatLngBounds(
      new google.maps.LatLng(Math.min(pos['lat'],lat), Math.min(pos['lng'],lng)),
      new google.maps.LatLng(Math.max(pos['lat'],lat), Math.max(pos['lng'],lng))
      ));


          }, function() {
            handleLocationError(true, infoWindow, map.getCenter());
          }, {
    enableHighAccuracy: true
});
        } else {
          // Browser doesn't support Geolocation
          handleLocationError(false, infoWindow, map.getCenter());
        }
      }
    
function createMarker(place) {
        var marker = new google.maps.Marker({
          map: map,
          position: place,
          icon: image
        });
        infowindow = new google.maps.InfoWindow;
  
          infowindow.setContent("Searched Location");
          infowindow.open(map, marker);
     
      }

      function handleLocationError(browserHasGeolocation, infoWindow, pos) {
        infoWindow.setPosition(pos);
        infoWindow.setContent(browserHasGeolocation ?
                              'Error: The Geolocation service failed.' :
                              'Error: Your browser doesn\'t support geolocation.');
        infoWindow.open(map);
      }


   /*   
   
    
      var map;
      var service;
      var infowindow;
    function initMap() {
        var sydney = new google.maps.LatLng(-33.867, 151.195);

        infowindow = new google.maps.InfoWindow();

        map = new google.maps.Map(
            document.getElementById('map'), {center: sydney, zoom: 15});

        var request = {
          query: 'Museum of Contemporary Art Australia',
          fields: ['name', 'geometry'],
        };

        service = new google.maps.places.PlacesService(map);

        service.findPlaceFromQuery(request, function(results, status) {
          if (status === google.maps.places.PlacesServiceStatus.OK) {
            for (var i = 0; i < results.length; i++) {
              createMarker(results[i]);
            }

            map.setCenter(results[0].geometry.location);
          }
        });
      }

      function createMarker(place) {
        var marker = new google.maps.Marker({
          map: map,
          position: place.geometry.location
        });

        google.maps.event.addListener(marker, 'click', function() {
          infowindow.setContent(place.name);
          infowindow.open(map, this);
        });
      }

      */
    </script>
  </head>
  <body>
    <div id="map"></div>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC35zuevufB1F8oHJ-JwXJMHxc0k3fCbfE&libraries=places&callback=initMap"
    async defer></script></body>
</html>