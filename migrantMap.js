var map;
var service;
var infowindow;
var radius = 100000;
var pos;
var image = "Images/pin.png";
var latArray = [], lngArray = [];
var markers = [];
var check = [];


function search(mark){
  for(var i = 0; i < check.length; i++){
      if(mark.lat == check[i].position.lat() && mark.lng == check[i].position.lng()){
          return check[i];
      }
  } 
}
function hidePlaces(){
  $("body").on('click', function(event){
      if (!$(event.target).closest('.avail-box, #googleMap, #rad-map, .cont-form').length) {
          for (var i = 0; i < markers.length; i++) {
              markers[i].setAnimation(null);
          }
          markers = [];
          for (var i = 0; i < check.length; i++) {
              check[i].setMap(null);
          }
          check = []; 
          latArray = []; 
          lngArray = [];
          latArray.push(pos.lat); lngArray.push(pos.lng);
          map.setCenter(pos);
          map.setZoom(13);
          $("#rad-map").trigger('click');
      }
  });
}
function showPlaces(){
 
  var marker, tLat, tLong;
  $(".avail-box").click(function(){
      tLat = $(this).children(".avail-loc").children(".lat").html();
      tLong = $(this).children(".avail-loc").children(".lng").html();
      name = $(this).children(".avail-info").children(".name").html();
      address = $(this).children(".avail-info").children(".address").html();
      
      $("body").trigger('click');
      if(window.matchMedia("(max-width: 1000px)").matches)
          window.scrollTo(0,0);
      var marker_pos = {
          lat: parseFloat(tLat),
          lng: parseFloat(tLong)
      };
      marker = search(marker_pos);
      var infowincontent = document.createElement('div');
      var strong = document.createElement('strong');
      strong.textContent = name;
      infowincontent.appendChild(strong);
      infowincontent.appendChild(document.createElement('br'));
      var text = document.createElement('text');
      text.textContent = address;
      infowincontent.appendChild(text);
      infoWindow.setContent(infowincontent);
              infoWindow.open(map, marker);
        
      marker.setAnimation(google.maps.Animation.BOUNCE);
      markers.push(marker);
      
      map.setCenter(new google.maps.LatLng(
          (( pos['lat'] + marker_pos['lat']) / 2.0),
          (( pos['lng'] + marker_pos['lng']) / 2.0)
      ));
      map.fitBounds(new google.maps.LatLngBounds(
      new google.maps.LatLng(Math.min(pos['lat'],marker_pos['lat']), Math.min(pos['lng'],marker_pos['lng'])),
      new google.maps.LatLng(Math.max(pos['lat'],marker_pos['lat']), Math.max(pos['lng'],marker_pos['lng']))
      ));
      }
  );
}
function showAll(){
  var markAll, minLat, maxLat, minLng, maxLng;
  $("#rad-map").click(function(){
      $(".avail-loc").each(function(i){
          tLat = $(this).children(".lat").html();
          tLong = $(this).children(".lng").html();
          var marker_all = {
              lat: parseFloat(tLat),
              lng: parseFloat(tLong)
          };
          latArray.push(marker_all.lat);
          lngArray.push(marker_all.lng);
          
        
          
          map.setCenter(new google.maps.LatLng(
              (( pos['lat'] + marker_all['lat']) / 2),
              (( pos['lng'] + marker_all['lng']) / 2)
          ));
          map.fitBounds(new google.maps.LatLngBounds(
          new google.maps.LatLng(Math.min(...latArray), Math.min(...lngArray)),
          new google.maps.LatLng(Math.max(...latArray), Math.max(...lngArray))
          ));
      });
      latArray = latArray.filter(function(item, posi) {
        return latArray.indexOf(item) == posi;
    });
    lngArray =  lngArray.filter(function(item, posi) {
        return  lngArray.indexOf(item) == posi;
    });
    for(var i=0;i<lngArray.length;i++){
        if(lngArray[i] != pos.lng){
        var marker_all = {
            lat: latArray[i],
            lng: lngArray[i]
        };
        markAll = new google.maps.Marker({
            map: map,
            position: marker_all,
            icon: image
        });
        check.push(markAll);
    
    }}
  });


}

function initMap() {
  $(document).ready(function () {
  map = new google.maps.Map(document.getElementById('googleMap'), {
    // center: {lat: 27.5330, lng: 88.5122},
    center: {lat: 13.0827 ,lng: 80.2707 },
     zoom: 16
   });
   infoWindow = new google.maps.InfoWindow;
   var userimage = "Images/lo.png";
   // Try HTML5 geolocation.
   if (navigator.geolocation) {
     navigator.geolocation.getCurrentPosition(function(position) {
       var pyrmont = new google.maps.LatLng(position.coords.latitude,position.coords.longitude);
        pos = {
         lat: position.coords.latitude,
         lng: position.coords.longitude
       }
    infoWindow.setPosition(pos);
    var userMarker = new google.maps.Marker({position: pos, map: map, icon: userimage});
       infoWindow.setContent('You Are Here');
       infoWindow.open(map,userMarker);
       
       map.setCenter(pos);


       
       $("#work").click(function(){
     
        var str='';
        var type = findValue();
        radius = document.getElementById("distance").value;
        if(type == 'Labour Shelter')
        type = 'No';
        else type='Yes'
        var str='';
        if(radius == "") {  radius = 1000000;  }
        else { radius = parseFloat(radius) * 1000; }
        //xml.php?table_name=volunteer&type=apartment&field=
        //xml.php?table_name=essentialworker&type=shop_name&field=
        //type='Entrepreneurial';
        downloadUrl('migrantXml.php?type='+type, function(data) {
          var xml = data.responseXML;
          var markers = xml.documentElement.getElementsByTagName('marker');
          Array.prototype.forEach.call(markers, function(markerElem) {
            var id=1;
            var name = markerElem.getAttribute('name');
            var address = markerElem.getAttribute('address');
            var state = markerElem.getAttribute('state');
            var city = markerElem.getAttribute('city');
            var transportation = markerElem.getAttribute('transportation');
            var food = markerElem.getAttribute('food');
            var place = markerElem.getAttribute('place');
            //var state="s"; var city="c";
            var lat = parseFloat(markerElem.getAttribute('lat'));
            var lng = parseFloat(markerElem.getAttribute('lng'));

            latArray.push(parseFloat(markerElem.getAttribute('lat')));
            lngArray.push(parseFloat(markerElem.getAttribute('lng')));

            var point = new google.maps.LatLng(
                parseFloat(markerElem.getAttribute('lat')),
                parseFloat(markerElem.getAttribute('lng')));
                var contact = markerElem.getAttribute('contact');
                
            var distanceInMeters = google.maps.geometry.spherical.computeDistanceBetween(
              new google.maps.LatLng(
                parseFloat(markerElem.getAttribute('lat')),
                parseFloat(markerElem.getAttribute('lng'))),
            userMarker.getPosition()
            );
            if(distanceInMeters < radius) {
              distanceInKm = (distanceInMeters * 0.001).toPrecision(2);
            console.log("Distance in Kilometers: ", (distanceInMeters * 0.001),address);
            var foodstr="";
            if(food == 'Yes') foodstr="<b>Food Required</b>" ;
            else foodstr="<b>Food Not Required</b>"
            if(transportation == 'Yes'){
          str = str + '<div class="avail-box"> <div class="avail-info"> <h3 class="name">' + name + '</h3><h5>Hometown: ' + state + ', ' + city  +'</h5><p class="address">'+address+'</p>'+ foodstr +' <br> <b> Transportation Required </b> <div class="contact"> <span class="cont-img"></span> <span class="cont-num">'+contact+'</span></div></div><div class="avail-loc"><span class="away">'+ distanceInKm+' Km</span><span class="lat">'+ lat +'</span><span class="lng">'+ lng +'</span><span class="location"></span></div></div>';   
          
            }
            else {
                str = str + '<div class="avail-box"> <div class="avail-info"> <h3 class="name">' +place+'</h3><h5> Labours On Duty</h5><p class="address">'+address+'</p> <div class="contact"> '+ foodstr +'</div> <b>Transportation Not Required </b> </div><div class="avail-loc"><span class="away">'+ distanceInKm+' Km</span><span class="lat">'+ lat +'</span><span class="lng">'+ lng +'</span><span class="location"></span></div></div>';   

            }

            document.getElementById("avail").innerHTML = str;
            var marker = new google.maps.Marker({
              map: map,
              position: point,
              icon: image
            });
            check.push(marker);

            /*var infowincontent = document.createElement('div');
            var strong = document.createElement('strong');
            strong.textContent = name;
            infowincontent.appendChild(strong);
            infowincontent.appendChild(document.createElement('br'));
            var text = document.createElement('text');
            text.textContent = address;
            infowincontent.appendChild(text);
            marker.addListener('click',function(){
                 infoWindow.setContent(infowincontent);
              infoWindow.open(map, marker);
            });*/
          }
          });
          latArray = latArray.filter(function(item, pos) {
            return latArray.indexOf(item) == pos;
        });
        lngArray =  lngArray.filter(function(item, pos) {
            return  lngArray.indexOf(item) == pos;
        });
      
          map.fitBounds(new google.maps.LatLngBounds(
            new google.maps.LatLng(Math.min(...latArray), Math.min(...lngArray)),
            new google.maps.LatLng(Math.max(...latArray), Math.max(...lngArray))
            ));

            showPlaces();
        showAll();
        hidePlaces();
        if(str==""){
          str= '<h2 class="filter-head"><span>--No Search Results Near Your Location--</span></h2>';
          document.getElementById("avail").innerHTML = str;
         }
        });

      
       


      });
      
     }, function() {
       handleLocationError(true, infoWindow, map.getCenter());
     }, {
    enableHighAccuracy: true
  });
   

}
else {
  handleLocationError(false, infoWindow, map.getCenter());
}
});
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
  }

  function downloadUrl(url, callback) {
    var request = window.ActiveXObject ?
        new ActiveXObject('Microsoft.XMLHTTP') :
        new XMLHttpRequest;

    request.onreadystatechange = function() {
      if (request.readyState == 4) {
        request.onreadystatechange = doNothing;
        callback(request, request.status);
      }
    };
    request.open('GET', url, true);
    request.send(null);
  }

  function doNothing() {}
  function handleLocationError(browserHasGeolocation, infoWindow, pos) {
    infoWindow.setPosition(pos);
    infoWindow.setContent(browserHasGeolocation ?
                          'Error: The Geolocation service failed.' :
                          'Error: Your browser doesn\'t support geolocation.');
    infoWindow.open(map);
  }