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
  
    <script src="menu.js"></script>
    <script src="migrantMap.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC35zuevufB1F8oHJ-JwXJMHxc0k3fCbfE&libraries=geometry,places&callback=initMap"
    async defer></script>
    <!--<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBQGctSfJElLgutbtHHnPct4JkGzdxg_GA&callback=initMap"></script> -->
    
   
</head>

<body>
    
    <?php  require_once('menubar.php'); ?>
    <div class="main">
        <div id="googleMap"></div>
        <script>
            
        </script>
        
        <script>
        </script>
        <div class="cont-form">
            <h2>Labour Tracking And Mapping </h2><hr>
            <h3>Select the Type</h3>
            <div id="rad1" class="radio">
                <span class="rad-button"></span>
                <span class="rad-text">Labour Shelter</span>
            </div>
            <div id="rad2" class="radio">
                <span class="rad-button"></span>
                <span class="rad-text">Migrant Workers</span>
            </div>
            <h3>Maximum Distance from current location</h3>
            <input type="text" name="" id="distance" placeholder="In Kilometers"><br>
            <input id="work" type="button" value="Get Workers" >
        </div>
        <div class="workAvail">
            <span id="workHead">
                <h2>Labour Shelter Mapping</h2>
                <button id="goBack">Go Back</button><hr>
                
            </span>
            <div id="rad-map" class="radio map-show">
                <span class="rad-text">Show all Migrant workers in map</span>
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
   <script>
       
var radVal = "";
function disableAll(){
    $("[id^= 'rad']").children(".rad-button").css("border","1px solid grey");
    $("[id^= 'rad']").children(".rad-button").css("backgroundColor","rgba(0,0,0,0.2)");
}
$(document).ready(function(){
    $(document).on('click','#rad1, #rad2, #rad3, #rad4',function(){
        var id = $(this).attr("id");
       
        disableAll();
        radVal = $(this).children(".rad-text").html();
        console.log(radVal);
        $(this).children(".rad-button").css("border","5px solid rgb(49,110,164)");
        $(this).children(".rad-button").css("backgroundColor","white");
    });
});
/*
    function findValue usage---
    -> It returns the currently selected value in the radio box
    -> It actually returns the innerHTML of the selected box(ie. rad-text)
    -> Check if it doesn't return null!!
*/
function findValue(){
if(radVal != ""){
    return radVal;
}
else return "undefined";
}
$(document).on('click','#work',function(){
    $(".cont-form").hide();
    $(".workAvail").css("display","block");
    $("#workHead").show();
});
$(document).on('click','#goBack',function(){
    location.reload();
    $(".cont-form").show();
    $(".workAvail").css("display","none");
    $("#workHead").hide();
});
</script>    
</script>
</body>
</html>