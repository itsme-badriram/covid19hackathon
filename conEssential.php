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
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Contact | Covid</title>
    <link rel="stylesheet" href="menu.css">
         
    <link rel="stylesheet" href="conEssential.css">
    
    <script src="jquery.js"></script><script src="alert.js"></script>
    <link rel="stylesheet" href="alert.css">
    <script src="osFinder.js"></script>
    <script src="conEss.js"></script>
    <script src="menu.js"></script>
    <script src="conEssMap.js"></script>
   
    <!--<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBQGctSfJElLgutbtHHnPct4JkGzdxg_GA&callback=initMap"></script> -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC35zuevufB1F8oHJ-JwXJMHxc0k3fCbfE&libraries=geometry,places&callback=initMap"
    async defer></script>
    <script src="loader.js"></script>
    <link rel="stylesheet" href="loader.css">
   
</head>

<body>
    
    <?php  require_once('menubar.php'); ?>
    <div class="main">
        <div id="googleMap"></div>
        <script>
            
        </script>
        <div class="cont-form">
            <h2>Contact Essential Worker</h2><hr>
            <h3>Select Type of Essential Worker</h3>
            <div id="rad1" class="radio">
                <span class="rad-button"></span>
                <span class="rad-text">Assisting District administration in Quarantine</span>
            </div>
            <div id="rad2" class="radio">
                <span class="rad-button"></span>
                <span class="rad-text">Disinfection and Cleaning Services</span>
            </div>
            <div id="rad3" class="radio">
                <span class="rad-button"></span>
                <span class="rad-text">Door to door Info and Service management</span>
            </div>
            <div id="rad4" class="radio">
                <span class="rad-button"></span>
                <span class="rad-text">Food and Grocery Services</span>
            </div>
            <h3>Maximum Distance from current location</h3>
            <input type="text" name="" id="distance" placeholder="In Kilometers"><br>
            <input id="work" type="button" value="Get Workers" >
        </div>
        <script>
        </script>
        <div class="workAvail">
            <span id="workHead">
                <h2>Available Essential Workers</h2>
                <button id="goBack">Go Back</button><hr>
            </span>
            <div id="rad-map" class="radio map-show">
                <span class="rad-text">Show all workers in map</span>
                <span class="rad-button"></span>
            </div>
            <div class="available" id="avail">
                
                <!--Display only the records whose distance is less than
                    or equal to the specified distance in the previous form
                    <div class="avail-loc">
                        <span class="away">0kms</span>
                        <span class="lat">13.066</span><span class="lng">80.199023</span>
                        <span class="location"></span>
                    </div>
                -->
            
            </div>
        </div>
    </div>
    <br><br>
    <div class="footer">
        <p>Department of Computer Technology &copy; Madras Institute of Technology</p>
    </div>
</body>
</html>