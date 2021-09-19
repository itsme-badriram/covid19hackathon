var map;
var service;
var infowindow;
function getCurrentLocation(){
    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(function(position){
        var pos = {
          lat: position.coords.latitude,
          lng: position.coords.longitude
        };
        return pos;
      });
    } else {
     //x.innerHTML = "Geolocation is not supported by this browser.";
    }
}
function getLocation(address) {
  var gNum=document.getElementById("googleMap");
  
  map = new google.maps.Map(gNum, {
  // center: {lat: 27.5330, lng: 88.5122},
  center: {lat: 13.0827 ,lng: 80.2707 },
    zoom: 16
  });
  infoWindow = new google.maps.InfoWindow;
  var request = {
      query: address,
      fields: ['name', 'geometry'],
    };

    var service = new google.maps.places.PlacesService(map);

    service.findPlaceFromQuery(request, function(results, status) {
      if (status === google.maps.places.PlacesServiceStatus.OK) {
        for (var i = 0; i < 1; i++) {
          createMarker(results[i]);
          
        }
        map.setCenter(results[0].geometry.location);
      }
    });
}
function callback(results, status) {
if (status == google.maps.places.PlacesServiceStatus.OK) {
for (var i = 0; i < results.length; i++) {
createMarker(results[i]);
}
}
}
var marker;
function createMarker(place) {
marker = new google.maps.Marker({
  map: map,
  position: place.geometry.location,
  draggable : true
});
map.setCenter(place.geometry.location);
console.log(marker.getPosition().lat());
infowindow = new google.maps.InfoWindow;
google.maps.event.addListener(marker, 'click', function() {
  infowindow.setContent(place.name);
  infowindow.open(map, this);
});
}
function returnMarker(){
  return marker;
}

