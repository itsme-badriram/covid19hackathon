<?php
require_once('dbConnect.php');
require_once('functions.php');
if(!checkLogin()){
    header("Location: login"); }
if(isset($_SESSION['homepage']) && $_SESSION['homepage'] != 'volunteerPage'){
    $homepage = $_SESSION['homepage'];
    header("Location: $homepage");
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Volunteer Jobs | Covid</title>
    <link rel="stylesheet" href="menu.css">
    <link rel="stylesheet" href="hosApp.css"> 
    <link rel="stylesheet" href="volunteer_works.css">
    <script src="jquery.js"></script><script src="alert.js"></script>
    <link rel="stylesheet" href="alert.css">
    <script src="osFinder.js"></script>
   
    <script src="menu.js"></script>
    
    <script src="loader.js"></script>
    <link rel="stylesheet" href="loader.css">
</head>    
<script>
    $(document).on('click','#view',function(){
        $(this).parent(".box").children(".content").slideToggle();
    });


</script>
<body>
         
    <?php  require_once('menubar.php'); ?>
    <div class="main" id="main_box">
    <h2 class="filter-head">
            <span>Available Jobs</span>
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
                <option value="select" selected disabled>Select the Field Type</option>
                <option value="Health">Health</option>
                <option value="Communication">Communication</option>
                <option value="Entrepreneurial">Entrepreneurial</option>
                
            </select><br>
            <input type="number" name="" id="radius" min="0" placeholder="Radius (in km)">
            <input type="button" onclick="onFilter()" value="Search"><br>
            <span style="font-size: 0.75em;"> <b>Note : </b> Showing results in range of 4km radius</span>
        </form>
        <br><br>
    <div id='available_jobs'>
        
        </div>
    </div>
    <script>
 var map, infoWindow ,pos;
      $(document).ready(function(){
        $(".form-wrap").slideToggle();
        // Try HTML5 geolocation.
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
              pos = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };
            
            
            $.ajax({
            type: 'post',
            url: "volunteer_worksAction.php?getJobs=true&lat="+pos['lat']+"&lng="+pos['lng'],
            dataType: 'html',
            beforeSend: function(){
                $(document).ajaxStart(function(){
                    $("#loader").fadeIn("fast");
                });
            },
            success: function(response){
                document.getElementById('available_jobs').innerHTML = response;
            },
            error: function(response){

            },
            complete: function(){
                $(document).ajaxComplete(function(){
                $("#loader").fadeOut("slow");
                });

            },});



        


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
        if(specialization == "" || specialization == 'Select the Field Type')
        specialization = "undefined";

        $.ajax({
            type: 'post',
            url: "volunteer_worksAction.php?getJobs=true&lat="+pos['lat']+"&lng="+pos['lng'],
            dataType: 'html',
            data: {
            radius : radius,
            specialization : specialization
            },
            beforeSend: function(){
                $(document).ajaxStart(function(){
                    $("#loader").fadeIn("fast");
                });
            },
            success: function(response){
                document.getElementById('available_jobs').innerHTML = response;
            },
            error: function(response){

            },
            complete: function(){
                $(document).ajaxComplete(function(){
                $("#loader").fadeOut("slow");
                });

            },});


      }
  
        function acceptRequest(jobid,id){
            

            $.post("requestServiceAction.php?changeStatus=true", {
                jobid: jobid,
                id: id

            },
            function(response,status,http){
                console.log(response);
                alertBox("Job Accepted",'You Can view the job status.. Redirecting to Job Status Page',2,'volStatus.php');
               
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