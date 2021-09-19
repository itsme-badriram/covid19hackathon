<?php require_once 'dbConnect.php';
require_once 'functions.php';
if(!checkLogin()){
  header("Location: login"); }

  if(isset($_GET['logout'])){
    removeAll();
    header("Location: generalUser");
}
if(isset($_SESSION['homepage']) && $_SESSION['homepage'] != 'generalUser'){
    $homepage = $_SESSION['homepage'];
    header("Location:".$homepage);
}
$today = "2020-02-04";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | User</title>
      <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC35zuevufB1F8oHJ-JwXJMHxc0k3fCbfE&libraries=geometry,places"
    async defer></script>
    <script src="jquery.js"></script><script src="alert.js"></script>
    <link rel="stylesheet" href="alert.css">
   
    <script src="menu.js"></script>
    <script src="osFinder.js"></script>
   
    <link rel="stylesheet" href="menu.css">
    <link rel="stylesheet" href="userDashboard.css">
    <script src="userDashboard.js"></script>
    <script src="slick/slick.min.js"></script>
    <link rel="stylesheet" href="slick/slick.css">
    <link rel="stylesheet" href="slick/slick-theme.css">
    <link rel="stylesheet" href="no-result-box.css">
    <script src="loader.js"></script>
    <link rel="stylesheet" href="loader.css">
  
</head>
<script>
    $(document).ready(function(){
        $(".carousel").slick({
            autoplay:true,
            autoplaySpeed:5000,
            dots:true,
            slidesToShow:1,
            slidesToScroll:1
        });
    });
</script>
<body>
         
    <?php require_once('menubar.php'); ?>
    <div class="carousel">
        <div class="box show">
            <div class="volunteer">
                <h2>Request Volunteer Services</h2>
                <p>Great support is forthcoming from people who want to help!</p>
                <div class="button"><a href="request_service">Request</a></div>
            </div>
            <span class="back-image"></span>
        </div>
        <div class="box show">
            <div class="volunteer">
                <h2>Contact Essential Worker</h2>
                <p>Contact them if you are in need of essential services like food, water, transportation, etc.</p>
                <div class="button"><a href="conEssential">Contact</a></div>
            </div>
            <span class="back-image cont-ess"></span>
        </div>
        <div class="box show">
            <div class="volunteer">
                <h2>Doctor's Appointment</h2>
                <p>Book an appointment with your nearby doctors for emergency cases.</p>
                <div class="button"><a href="hosApp">Book Now</a></div>
            </div>
            <span class="back-image doct-img"></span>
        </div>
        <div class="box show">
            <div class="volunteer">
                <h2>View GeoFences</h2>
                <p>Be aware of Red-Zones near you. Stay Home Stay Safe!</p>
                <div class="button"><a href="geofencing.html">View Red-Zones</a></div>
            </div>
            <span class="back-image no-entry"></span>
        </div>
    </div>
    <div class="main-first" >
        <div class="box request">
            <span class="req-back"></span>
            <h2 class="req-title">
                <span class="head">Request Volunteer Services</span>
                <span class="icon req"></span>
            </h2>
            <p><b>Volunteers</b> are people who offer themselves for any service or wish to contribute their time, effort and do not expect any monetary gains in return.</p>
            <div class="ser-category">
                <h3>
                    <span>Service Category</span>
                    <span>Count</span>
                </h3>
                <div class="checkbox">
                    <span class="check checked"></span>
                    <span class="check-title">Health</span>
                    <span class="count" id="healthcount">3</span>
                </div>
                <div class="checkbox">
                    <span class="check"></span>
                    <span class="check-title" >Communication</span>
                    <span class="count" id="commcount">11</span>
                </div>
                <div class="checkbox">
                    <span class="check"></span>
                    <span class="check-title">Entrepreneurial</span>
                    <span class="count" id="entrecount">7</span>
                </div>
            </div>
            
            <button class="button" id="request_service_click">Request Service</button>
        </div>
        <div class="box req-status" >
            <div class="box status" id="userStatus">
                
                <div class="status-box">
                    
                </div>
            </div>
            <h2 class="sub-heading">
                <span>Around You!</span>
            </h2>
            <div class="box near-hosp">
                <div class="box red-zone" id="redzone">
                    <span class="red-dist" >15<span>kms</span> </span>
                    <!--In case of red zone add 'red' class to above class red-dist-->
                    <span class="red-title">Away from <b>Red</b> Zone</span>
                    <span class="icon map-zone"></span>
                    <div class="button maps"><a href="geofencing.html">View GeoFences</a></div>
                </div>
                <div class="box nearby" id="nearest">
                    <h3 class="req-title hos">
                        <span>Nearest Hospitals / Health Centers</span>
                        <span class="icon hosp"></span>
                    </h3>
                    
                    <div class="hosp-box">
                        <h4 class="hos-title">
                            <span>ABC Hospital</span>
                            <span class="dist">0.5 km</span>
                        </h4><br>
                        <span class="contact">
                            <span class="icon cont"></span>
                            <a href="tel:+99940595423">9940959423</a>
                            <span class="icon map" onclick="onNearest()"></span>
                        </span>
                    </div>
                    <div class="hosp-box">
                        <h4 class="hos-title">
                            <span>DEF Cares - Pvt. Ltd</span>
                            <span class="dist">1 km</span>
                        </h4><br>
                        <span class="contact">
                            <span class="icon cont"></span>
                            <a href="tel:+99940595423">9952021499</a>
                           <span class="icon map" onclick="onNearest()"></span>
                        </span>
                    </div>

                </div>
            </div>
        </div>
    </div><br>
    <h3 class="second-title">Essential Services</h3><br>
    <div class="main-second">
        <div class="box ess">
            <span class="icon workers"></span>
            <h3 class="essential-title">
                <span>Contact Essential Workers</span>
            </h3>
            <p><b>Essential workers</b> are the personnel needed to maintain essential services like food, water, transportation, etc.</p>
            <div class="button"><a href="conEssential">Contact</a></div>
        </div>
        <div class="box ess">
            <span class="icon msme"></span>
            <h3 class="essential-title">
                <span>MSME Products</span>
            </h3>
            <p>The Indian Government has made an act for <b>MSME</b>, applicable on manufacturers and service providers.</p>
            <div class="button"><a href="products">View More</a></div>
        </div>
        <div class="box ess">
            <span class="icon prod"></span>
            <h3 class="essential-title">
                <span>Request Services</span>
            </h3>
            <p>We extend our support for <b>Unorganized workers</b> by providing them relief funds and materials.</p>
            <div class="button"><a href="request_items">Request</a></div>
        </div>
    </div><br>
    <h3 class="second-title">Health Care Services</h3><br>
    <div class="main-third">
        <div class="box doctor appoint">
            <h2 class="req-title side">
                <span class="icon doc-book"></span>
                <span>Doctor's Appointment</span>
                <span class="button"><a href="hosApp">Book Now!</a></span>
            </h2>
            <div class="appoint-details" id="doctorAppointment">
                
            </div>
        </div>
        <div class="box doctor" id="todayAppointment">
            <h2 class="req-title doc-title">
                <span>Today's Appointments</span>
                <span class="icon doc"></span>
            </h2>
            <span class="date-time"><b>Date</b> : 20-05-2020</span>
            <div class="doc-details">
                <div>
                    <span class="doc-name">Dr. Vignesh A, MBBS</span>
                    <span class="contact">
                        <span class="icon cont"></span>
                        <a href="tel:+99940595423">9952021499</a>
                    </span>
                </div>
                <span class="doc-time">11:00 AM</span>
            </div>
            <div class="button"><a href="userdoc">Check Status!</a></div>
        </div>
        <div class="box doctor lab-results" id="labReport">
            <h3 class="req-title doc-title lab-title">
                <span>Lab Results</span>
                <span class="icon result"></span>
            </h3>
            <div class="lab-col">
                <div class="lab">
                    <span class="lab-details">
                        <span>Blood Test Results</span>
                        <span class="time">20-05-2020</span>
                    </span>
                    <span class="doc-name">Dr. Prabhakay R - MBBS, DLO</span>
                    <span class="contact">
                        <span class="icon cont"></span>
                        <a href="tel:+99940595423">9952021499</a>
                    </span>
                    <span class="doc-msg">
                        Get well soon..
                    </span>
                </div>
            </div>
            <div class="button"><a href="userdoc">View Results</a></div>
        </div>
        <div class="box doctor report">
            <div class="box suspect">
                <span class="icon symp"></span>
                <h3>Report Covid Symptoms</h3>
                <p>If you notice someone with these symptoms? Report asap.</p>
                <div class="button"><a href="report_patient">Report</a></div>
            </div>
            <div class="box suspect">
                <span class="icon symp rep-hosp"></span>
                <h3>Report Covid Hospital</h3>
                <p>Help us locate Covid Hospitals and Health-Cares.</p>
                <div class="button"><a href="report_hospital">Report</a></div>
            </div>
        </div>
    </div><br>
    <h3 class="second-title">Online Services</h3><br>
    <div class="main-fourth">
        <div class="box service">
            <span class="icon help"></span>
            <h3>Helpline Numbers</h3>
            <p>We always care for your safety</p>
            <div class="button"><a href="helpline">Contact</a></div>
        </div>
        <div class="box service">
            <span class="icon gov"></span>
            <h3>Government Online Services</h3>
            <p>Get your essential services online</p>
            <div class="button"><a href="govt">View More</a></div>
        </div>
        <div class="box service">
            <span class="icon video"></span>
            <h3>Online Training Courses</h3>
            <p>Get info about safety measures</p>
            <div class="button"><a href="trainingvideo">Watch</a></div>
        </div>
        <div class="box service">
            <span class="icon donate"></span>
            <h3>Donate</h3>
            <p>People live when people give</p>
            <div class="button"><a href="donate">Donate</a></div>
        </div>
    </div>
    <br><br>
    <script>
var div;
$(document).ready(function(){
     div=document.createElement('div');
    
    $.ajax({
        url:'generalUserAction.php?userStatus=true',
        type: 'post',
        dataType: 'html',
        beforeSend: function(){
            $(document).ajaxStart(function(){
    $("#loader").fadeIn("fast");
});
        },
        complete: function(){
    $(document).ajaxComplete(function(){
    $("#loader").fadeOut("slow");
});
},  
        success: function(response){
        if(response == "")
        response = '<h2 class="status-title"><span>Requested Volunteer status</span><span class="info">i</span></h2><div class="job-status"><div class="job-desc"><h4><span class="job-icon">0</span><span>Currently Ongoing Jobs</span></h4><span class="legend"><span class="on"></span>Ongoing<span class="off"></span>Completed</span></div></div><div class="no-result"><span>You Have Not Requested Any Volunteer Services</span> </div>';
        document.getElementById('userStatus').innerHTML = response;

    }, error: function(response){

    },
});

    $.ajax({
        type: 'post',
        dataType: 'html',
        beforeSend: function(){
            $(document).ajaxStart(function(){
    $("#loader").fadeIn("fast");
});
        },
        complete: function(){
        $(document).ajaxComplete(function(){
    $("#loader").fadeOut("slow");
});
    },
        url:'generalUserAction.php?todayAppointment=true',
        success: function(response){
        if(response=="")
        response = '<h2 class="req-title doc-title"><span>Today\'s Appointments</span><span class="icon doc"></span></h2><span class="date-time"><b>Date</b> : 02-04-2020</span><div class="no-result"><span>You Have Not Booked Any Volunteer Services</span> </div>';
        document.getElementById('todayAppointment').innerHTML = response;
    },
    error: function(){

    },
    });

    $.ajax({
        type: 'post',
        dataType: 'html',
        beforeSend: function(){
            $(document).ajaxStart(function(){
    $("#loader").fadeIn("fast");
});

        },
        complete: function(){
    $(document).ajaxComplete(function(){
$("#loader").fadeOut("slow");
});
},
        url:'generalUserAction.php?labReport=true',
        success: function(response){
        if(response == "")
            response = '<h3 class="req-title doc-title lab-title"><span>Lab Results</span> <span class="icon result"></span> </h3><div class="no-result"><span>You Have No Lab Results Yet!</span> </div><div class="button" ><a href="userdoc">View Results</a></div>';
        document.getElementById('labReport').innerHTML = response;
        runFunction();
    },error: function(){

},
});

    
    $('#request_service_click').click(function(){
        window.location = 'request_service?field='+field;
    });

});
var pos,service;
function runFunction() {
    if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
              pos = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };
            
            $.ajax({
                type: 'post',
                dataType: 'html',
                beforeSend: function(){
                    $(document).ajaxStart(function(){
                        $("#loader").fadeIn("fast");
                    });

                },
                complete: function(){
    $(document).ajaxComplete(function(){
$("#loader").fadeOut("slow");
});
},
                url:"generalUserAction.php?doctorAppointment=true&lat="+pos['lat']+"&lng="+pos['lng'],
                success: function(response){
                if(response == "")
            response = '<h3>Available Doctors near you (within 4 km)</h3><div class="avail-info"><span class="count">0</span><span>Normal Doctors</span></div><div class="avail-info"><span class="count red">0</span><span>Emergency Doctors</span></div><div class="no-result"><span>No Doctors Near Your Area</span> </div>';
                document.getElementById("doctorAppointment").innerHTML = response
            },error: function(){

},
});

            var flag = 1;
            var prev = {
              lat : 0,
              lng : 0
            };
            var points = [];
            var distanceFromRedZone = 100000;
            downloadUrl('xml.php?table_name=essentialworker&type=shop_name', function(data) {
            var xml = data.responseXML;
            var markers = xml.documentElement.getElementsByTagName('marker');
            Array.prototype.forEach.call(markers, function(markerElem) {
              var lat = (parseFloat(markerElem.getAttribute('lat')));
              var lng = (parseFloat(markerElem.getAttribute('lng')));
              var point = {
                  lat: lat,
                  lng: lng,
                  radius: 500
              };
              points.push(point);
      
            });

            
            var flag = 0;
            while(flag != 1) {
            flag = 1;
            for(var i=0; i<points.length;i++ ){
                if(flag == 0)
                  break;
                for(var j=0;j<points.length;j++){
                    if(i!=j){
                        if(flag == 0)
                        break;
                        distanceInMeters = google.maps.geometry.spherical.computeDistanceBetween(
                new google.maps.LatLng(points[i]['lat'],points[i]['lng']),
                new google.maps.LatLng(points[j]['lat'],points[j]['lng']));
                        if(distanceInMeters < 1000) {
                            var radius = (distanceInMeters + 1000)/2;
                            var point = {
                                lat : (points[i]['lat'] + points[j]['lat'])/2 ,
                                lng : (points[i]['lng'] + points[j]['lng'])/2 ,
                                radius : radius
                            };
                            points = points.filter(function(item) {
                                return item !== points[i] && item !== points[j]
                            });
                           points.push(point);
                           flag = 0;
                        }   
                    }
                }   
            }
        }
        var safe = 1;
        var userpoint = new google.maps.LatLng(
                  pos['lat'],
                  pos['lng']);
            for(var i = 0;i<points.length ; i++) {

                

                var point = new google.maps.LatLng(
                  points[i]['lat'],
                  points[i]['lng']);

                  

                  var distanceInMeters = google.maps.geometry.spherical.computeDistanceBetween(
                point,
                userpoint
);
if(distanceInMeters < points[i]['radius'] ) {
    console.log("Yaaaas");
    safe = 0;
  }
  
  if(distanceFromRedZone > (distanceInMeters - points[i]['radius']))
      distanceFromRedZone = (distanceInMeters - points[i]['radius']) ;

                


            }
            if( safe == 1){
    //infoWindow.setContent('You Are Safe<br> You are '+(0.001*distanceFromRedZone).toPrecision(2)+'km away from Red Zone');
    document.getElementById('redzone').innerHTML='<span class="red-dist" >'+(0.001*distanceFromRedZone).toPrecision(2) +'<span>kms</span> </span> <span class="red-title">Away from <b>Red</b> Zone</span> <span class="icon map-zone"></span>  <div class="button maps"><a href="geofencing.html">View GeoFences</a></div> ';
                    

  
      }
        else{    
          //infoWindow.setContent('You Are In Dangerzone');
          document.getElementById('redzone').innerHTML='<span class="red-dist red" >'+(0.001*distanceFromRedZone*(-1)).toPrecision(2) +'<span>kms</span> </span> <span class="red-title">Inside the <b>Red</b> Zone</span> <span class="icon map-zone"></span>  <div class="button maps"><a href="geofencing.html">View GeoFences</a></div> ';
                    

          
        }  
            /*distanceInMeters = google.maps.geometry.spherical.computeDistanceBetween(
                new google.maps.LatLng(
                  parseFloat(markerElem.getAttribute('lat')),
                  parseFloat(markerElem.getAttribute('lng'))),
                new google.maps.LatLng(prev['lat'],prev['lng'])
);*/

        });

        var health=0,communication=0,entre=0;
        var radius = 4000;
        downloadUrl('xml.php?table_name=volunteer&type=apartment', function(data) {
            var xml = data.responseXML;
            var markers = xml.documentElement.getElementsByTagName('marker');
                
            
                Array.prototype.forEach.call(markers, function(markerElem) {
                var id = markerElem.getAttribute('id');
                var lat_t = (parseFloat(markerElem.getAttribute('lat')));
                var lng_t = (parseFloat(markerElem.getAttribute('lng')));
                var field = (markerElem.getAttribute('field'));
                var distanceInMeters = google.maps.geometry.spherical.computeDistanceBetween(
                    new google.maps.LatLng(lat_t,lng_t),
                    new google.maps.LatLng(pos.lat,pos.lng));
                    if(distanceInMeters < radius){
                        if(field == 'Health')
                        health++;
                        else if(field == 'Communication')
                        communication++;
                        else
                        entre++;

                   
                }

        });
        document.getElementById('healthcount').innerHTML = health;
        document.getElementById('commcount').innerHTML = communication;
        document.getElementById('entrecount').innerHTML = entre;

    });
    


        var request = {
            location: pos,
            //rankBy: google.maps.places.RankBy.DISTANCE,
            radius:2000,
            fields: ['name'],
            type: ['hospital'],
            
  };

  service = new google.maps.places.PlacesService(div);
  service.nearbySearch(request, callback);


          }, function() {
            //handleLocationError(true, infoWindow, map.getCenter());
          },{
    enableHighAccuracy: true
          });
        } else {
          // Browser doesn't support Geolocation
          //handleLocationError(false, infoWindow, map.getCenter());
        }

}

var nearest='<h3 class="req-title hos"><span>Nearest Hospitals / Health Centers</span><span class="icon hosp"></span></h3>';
function callback(results, status) {
  if (status == google.maps.places.PlacesServiceStatus.OK) {
    for (var i = 0; i < 2; i++) {
      
        nearest+='<div class="hosp-box"><h4 class="hos-title"><span>'+results[i].name+'</span><span class="dist"> &lt; 2 km</span></h4><br><span class="contact"><span class=""></span><a >Nearest Hospital</a><span class="icon map" onclick="onNearest()"></span></span></div>';
                                   
                    

    }
    document.getElementById('nearest').innerHTML=nearest;
  }
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

                        function onNearest(){
                            window.location = 'nearest';
                        }
                        function ondocAppointment(uname){
                            window.location = 'hosAppform.php?username='+uname;
                        }

</script>
    <div class="footer">
        <p>Department of Computer Technology &copy; Madras Institute of Technology</p>
    </div>
    
</body>
</html>