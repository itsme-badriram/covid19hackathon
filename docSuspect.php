<?php
require_once('dbConnect.php');
require_once('functions.php');
if(!checkLogin()){
    header("Location: login"); }

    if(isset($_GET['logout'])){
        removeAll();
        header("Location: doctor");
    }
    if(isset($_SESSION['homepage']) && $_SESSION['homepage'] != 'doctor'){
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
    <title>Covid Reports | Covid</title>
    <link rel="stylesheet" href="menu.css">
         
    <link rel="stylesheet" href="docSuspect.css">
    <script src="jquery.js"></script><script src="alert.js"></script>
    <link rel="stylesheet" href="alert.css">
    <script src="osFinder.js"></script>
  
    <script src="menu.js"></script>
    <script src="loader.js"></script>
    <link rel="stylesheet" href="loader.css">
</head>    


<script>

    $(document).ready(function(){
        $.post('doctorAction.php?patientSymptomsFilter=true',function(response){
            document.getElementById('patient-info').innerHTML = response;
            getProgressBar();
        });
        $("#selection").on("change",function(){
        var filter = $("#selection").find(":selected").text();
        if(filter == 'Report Time')
        filter = 'date';
        else if(filter == 'Probability')
        filter = 'weightage';
        else if(filter == 'Age')
        filter = 'age';
      
        $.post('doctorAction.php?patientSymptomsFilter=true&filter='+filter,function(response){
            document.getElementById('patient-info').innerHTML = response;
            getProgressBar();
        });



    });
    });
    
 
   


</script>
<body>
         
    <?php  require_once('menubar.php'); ?>
    <div class="main">
        <h2 class="main-head">
            <span>Covid-19 Patient Reports</span>
            <span class="head-icon"></span>
        </h2>
        <div class="filter">
            <select name="" id="selection" >
                <option value="" selected disabled>Sort using</option>
                <option value="Probability">Probability</option>
                <option value="Report Time">Report Time</option>
                <option value="Age">Age</option>
            </select>
        </div>
        <div class="rep-box" id="patient-info">
            <div class="report">
                <div class="details">
                    <h3>Vignesh A</h3>
                    <span class="gender">
                        <b>M</b>
                    </span>
                    <span class="age">22 Yrs</span><br>
                    <span class="time">02-05-2020</span>
                    <div class="download">
                        <span class="down"></span>
                        <b>Download PDF</b>
                    </div>
                </div>
                <div class="progress">
                    <h4>Probability : 
                        <span class="bar-value">85</span>%
                    </h4>
                    <span class="bar">
                        <span class="value"></span>
                    </span>
                </div>
            </div>
            <div class="report">
                <div class="details">
                    <h3>Ramanujan V</h3>
                    <span class="gender">
                        <b>M</b>
                    </span>
                    <span class="age">20 Yrs</span><br>
                    <span class="time">05-05-2020</span>
                    <div class="download">
                        <span class="down"></span>
                        <b>Download PDF</b>
                    </div>
                </div>
                <div class="progress">
                    <h4>Probability : 
                        <span class="bar-value">45</span>%
                    </h4>
                    <span class="bar">
                        <span class="value"></span>
                    </span>
                </div>
            </div>
            <div class="report">
                <div class="details">
                    <h3>Prabhakay</h3>
                    <span class="gender">
                        <b>M</b>
                    </span>
                    <span class="age">60 Yrs</span><br>
                    <span class="time">01-05-2020</span>
                    <div class="download">
                        <span class="down"></span>
                        <b>Download PDF</b>
                    </div>
                </div>
                <div class="progress">
                    <h4>Probability : 
                        <span class="bar-value">25</span>%
                    </h4>
                    <span class="bar">
                        <span class="value"></span>
                    </span>
                </div>
            </div>
            <div class="report">
                <div class="details">
                    <h3>Surya A</h3>
                    <span class="gender">
                        <b>M</b>
                    </span>
                    <span class="age">40 Yrs</span><br>
                    <span class="time">03-05-2020</span>
                    <div class="download">
                        <span class="down"></span>
                        <b>Download PDF</b>
                    </div>
                </div>
                <div class="progress">
                    <h4>Probability : 
                        <span class="bar-value">65</span>%
                    </h4>
                    <span class="bar">
                        <span class="value"></span>
                    </span>
                </div>
            </div>
        </div>
    </div><br><br>
    <div class="footer">
        <p>Department of Computer Technology &copy; Madras Institute of Technology</p>
    </div>
    <script>
        function getProgressBar(){
        var color = "";
        $(".bar-value").each(function(i){
            var width = $(this).html();
            if(width < 50) color = "seagreen";
            else if(width < 80) color = "orange";
            else color = "rgb(150,0,0)"; 
            width = width + "%";
            $(this).parents(".progress").children(".bar").children(".value").css("width",width);
            $(this).parents(".progress").children(".bar").children(".value").css("background-color",color);
        });
    }
    </script>
</body>
</html>