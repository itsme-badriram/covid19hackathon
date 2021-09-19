<?php
require_once('dbConnect.php');
require_once 'functions.php';
if(!checkLogin()){
  header("Location: login"); }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Appointment | Covid</title>
    <link rel="stylesheet" href="menu.css">
         
    <link rel="stylesheet" href="hosApp.css">
    <script src="jquery.js"></script><script src="alert.js"></script>
    <link rel="stylesheet" href="alert.css">
    <script src="osFinder.js"></script>
    <script src="hosApp.js"></script>
    <script src="menu.js"></script>
    <script src="loader.js"></script>
    <link rel="stylesheet" href="loader.css">
    

</head>
<body>
         
    <?php require_once('menubar.php'); ?>
    <div class="main">
        <h2 class="filter-head">
            <span>Online Doctor Appointment</span>
            <span class="filter" title="Click here to apply filter"></span>
        </h2>
        <form action="" class="form-wrap">
            <h3 style="margin: 0; text-align: left;">Filter</h3><br>
            <!--<select name="" id="">
                <option value="select" selected disabled>Select Consulting Hours</option>
                <option value="">24/7</option>
                <option value="">9:00AM - 12:00PM</option>
                <option value="">12:00PM - 9:00PM</option>
                <option value="">Only Afternoon</option>
                <option value="">Only Morning</option>
                <option value="">Only Night</option>
            </select> -->
            <select name="specialization" id="specialization">
                <option value="select" selected disabled>Select Doctor's Type</option>
                <option value="Emergency">Emergency</option>
                <option value="Pediatrician">Pediatrician</option>
                <option value="ENT">ENT Specialist</option>
                <option value="Dermatologist">Dermatologist</option>
                <option value="Neurologist">Neurologist</option>
                <option value="Cardiologist">Cardiologist</option>
                <option value="Psychiatrist">Psychiatrist</option>
                <option value="Physical Therapist">Physical Therapist</option>
            </select><br>
            <input type="number" name="" id="radius" min="0" placeholder="Radius (in km)">
            <input type="button" onclick="onFilter()" value="Search"><br>
            <span style="font-size: 0.75em;"> <b>Note : </b> Showing results in range of 4km radius</span>
        </form>
        <!--<input type="text" name="" id="docSearch" placeholder="Search available doctors">-->
        <div class="note">
            <div class="normal"><span class="round red"></span>Emergency</div>
            <div class="normal"><span class="round"></span>Normal</div>
        </div>
        <div class="doc-list" id="doclist">
            
        </div>
    </div><br><br>
    <script>
        function onBookAppointment(name,qualification,spec,work,contact,address,hours){
            

        }

            

        
      // Note: This example requires that you consent to location sharing when
      // prompted by your browser. If you see the error "The Geolocation service
      // failed.", it means you probably did not give permission for the browser to
      // locate you.
      var map, infoWindow ,pos;
      $(document).ready(function(){
           
        // Try HTML5 geolocation.
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
              pos = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };
            
            $.post("hospitalAction.php?lat="+pos['lat']+"&lng="+pos['lng'],function(response){
                if(response == "")
            response = '<h2 class="filter-head"><span>No Results Are Available Within Your Area</span></h2>';
                document.getElementById("doclist").innerHTML = response
            });



          }, function() {
            //handleLocationError(true, infoWindow, map.getCenter());
          },{
    enableHighAccuracy: true
          });
        } else {
          // Browser doesn't support Geolocation
          //handleLocationError(false, infoWindow, map.getCenter());
        }
      });

      function onFilter(){
        var radius = document.getElementById('radius').value;
        if(radius=="")
        radius = 4;
        var specialization = $('#specialization').find(":selected").text();
        if(specialization == "" || specialization == 'Select Doctor\'s Type')
        specialization = "undefined";
        $.post("hospitalAction.php?lat="+pos['lat']+"&lng="+pos['lng'],{
            radius : radius,
            specialization : specialization
        }
        ,function(response){
            if(response == "")
            response = '<h2 class="filter-head"><span>No Results Matching Your Requirements</span></h2>';
                document.getElementById("doclist").innerHTML = response
            });

      }

      
      



</script>
    <div class="footer">
        <p>Department of Computer Technology &copy; Madras Institute of Technology</p>
    </div>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC35zuevufB1F8oHJ-JwXJMHxc0k3fCbfE&libraries=places"
    async defer></script>
</body>
</html>