<?php

require_once 'dbConnect.php';
require_once 'functions.php';
if(!checkLogin()){
  header("Location: login"); }


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report Hospital | Covid</title>
    <link rel="stylesheet" href="menu.css">
         
    <link rel="stylesheet" href="report_hospital.css">
    <script src="https://code.jquery.com/jquery-3.5.0.js" integrity="sha256-r/AaFHrszJtwpe+tHyNi/XCfMxYpbsRg2Uqn0x3s2zc=" crossorigin="anonymous"></script>
    <script src="jquery.js"></script><script src="alert.js"></script>
    <link rel="stylesheet" href="alert.css">
    <script src="osFinder.js"></script>
    <script src="menu.js"></script>
    <script src="request_service.js"></script>
    
   
    <script src="loader.js"></script>
    <link rel="stylesheet" href="loader.css">
</head>
<body>
         
    <?php  require_once('menubar.php')  ?>
    <div class="form-wrap" id="main-box">
        <div class="heading">
            <h2>Report a location as a Corona virus<br> Hospital/Medical Shop</h2>
        </div>
        <br>
        <div class="formReq" >
        <form id="myform" method="post" action="reportAction.php?hospital=true">
        <label for="hospital_name">Enter Hospital Name </label><br>
            <input type="text" name="hospital_name" id="hospital_name" placeholder="Hospital Name"><br>
            <label for="field">Select an option to report the location as: </label><br>
            <select id="field" name="field">
                <option value="hospital">Corona virus Hospital</option>
                <option value="pharmacy">Medical Store</option>
                
            </select><br>
            <label for="job_location">Enter Location: </label><br>
            <input type="text" name="job_location" id="job_location" placeholder="Location"><br>
            <div id="map-all">
                <span id="mapShow" name="get_loc" onclick="getLocation(job_location.value)"></span>
                <div id="googleMap">
                </div>
            </div>
            <br>
            <input type="submit" value="Submit">
            </form>
        </div>
    </div>
    <script>

$(document).ready(function(e){
    var form = $("#myform");
    
    $("#myform").on('submit',function(e){
        e.preventDefault();
        var marker = returnMarker();
        var lat = marker.getPosition().lat();
var lng = marker.getPosition().lng();
        var formData = new FormData();
        var conceptName = $('#field').find(":selected").text();
        formData.append('fieldtype',conceptName);
        formData.append('address',document.getElementById("job_location").value);
        formData.append('hospital_name',document.getElementById("hospital_name").value);
        formData.append('lat',lat);
        formData.append('lng',lng);
        $.ajax({
          url: form.attr('action'),
          type: form.attr('method'),
          data: formData,
          contentType: false,
          cache: false,
          processData:false,
          success: function (data) {
            alertBox(data,'',2);
          },
          error: function (data) {
            alertBox("Some Problem.. Try Again Later",'',1);

          }
        });
        $("#myform").trigger("reset");
       
        

    });
});
    </script>
    <div class="footer">
        <p>Department of Computer Technology &copy; Madras Institute of Technology</p>
    </div>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC35zuevufB1F8oHJ-JwXJMHxc0k3fCbfE&libraries=places"
    async defer></script>
</body>
</html>