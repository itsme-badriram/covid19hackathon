<?php
$radius = 0.5;

$query = "pharmacy";


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="nearest.css">
    <script src="jquery.js"></script><script src="alert.js"></script>
    <link rel="stylesheet" href="alert.css">
    <script src="osFinder.js"></script>
    <script src="nearest.js"></script>
    <title>Nearest Medical Centers | Covid</title>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC35zuevufB1F8oHJ-JwXJMHxc0k3fCbfE&libraries=places&callback=initMap"
    async defer></script>
    <script src="loader.js"></script>
    <link rel="stylesheet" href="loader.css">
</head>
<script>
    var radius = <?php  echo $radius  ?>;
    var query = '<?php echo $query ?>' ;
    function onQueryHandler(place){
        query = place;
    }
</script>
<body>
    <div class="main">
        <div>
            <span class="search"></span>
            <div class="form-wrap">
                <label for="hospital">
                    <input type="radio" name="near" id="hospital" <?php if($query == 'hospital') echo 'checked = checked';   ?> onclick="onQueryHandler('hospital')" >
                    <span>Nearest Hospitals</span>
                </label>
                <label for="pharmacy">
                    <input type="radio" name="near" id="pharmacy" <?php if($query == 'pharmacy') echo 'checked = checked';   ?>  onclick="onQueryHandler('pharmacy')">
                    <span>Nearest Medical Stores</span>
                </label>
                <input type="text" name="radius" id="radius"   placeholder="Enter Radius (in km)">
                <span style="font-size: 0.75em;"> <b>Note : </b> Showing results in range of 500m radius</span>
                <input type="submit" value="Filter" onclick="hideIcon(),onSubmit()">
            </div>
            <div id="googleMap" onclick="hideIcon()" onmousewheel="hideIcon()"></div>
        </div>
    </div>
   
   
    <script>
      // This example requires the Places library. Include the libraries=places
      // parameter when you first load the API. For example:
      // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

        var map, infoWindow,image = "Images/pin.png";
      function initMap() {

        map = new google.maps.Map(document.getElementById('googleMap'), {
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
           
            var request = {
            location: pyrmont,
           radius: radius*1000,
           //rankBy: google.maps.places.RankBy.DISTANCE,
            fields: ['name','formatted_address'],
            type: [query]
  };
  service = new google.maps.places.PlacesService(map);
  service.nearbySearch(request, callback);
           

         
            var marker = new google.maps.Marker({position: pos, map: map,icon : image});
            infoWindow.setPosition(pos);
            infoWindow.setContent('You Are Here');
            infoWindow.open(map,marker);
            map.setCenter(pos);



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
      function callback(results, status) {
  if (status == google.maps.places.PlacesServiceStatus.OK) {
    for (var i = 0; i < results.length; i++) {
      createMarker(results[i]);
    }
  }
}
function createMarker(place) {
        var marker = new google.maps.Marker({
          map: map,
          position: place.geometry.location
        });
        infowindow = new google.maps.InfoWindow;
        google.maps.event.addListener(marker, 'click', function() {
          infowindow.setContent(place.name);
          
          infowindow.open(map, this);
        });
      /*  var request = { placeId: place.place_id };
service.getDetails(request, function(details, status) {
  google.maps.event.addListener(marker, 'click', function() {
    infoWindow.setContent(details.name + "<br />" + details.formatted_address +"<br />" + details.website + "<br />" + details.rating + "<br />" + details.formatted_phone_number);
    infoWindow.open(map, this);
   });
 });*/
      }

      function handleLocationError(browserHasGeolocation, infoWindow, pos) {
        infoWindow.setPosition(pos);
        infoWindow.setContent(browserHasGeolocation ?
                              'Error: The Geolocation service failed.' :
                              'Error: Your browser doesn\'t support geolocation.');
        infoWindow.open(map);
      }


        function onSubmit(){
          
            var temp = document.getElementById("radius").value;
            if(temp == "") temp = radius;
            else temp = parseFloat(temp);
         
            $.ajax({
              url : "reportAction.php?nearestMedic=true",
              data: {
                radius : temp,
                query : query
              },
              type: "post",
              dataType: 'json',
              success: function(data){
               radius = parseFloat(data[0]);
               query = data[1];
               initMap();
              }
            });
        }
    </script>
</body>
</html>