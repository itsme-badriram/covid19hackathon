<?php require_once 'dbConnect.php';
require_once 'functions.php';
if(!checkLogin()){
  header("Location: login.php"); }

  if(isset($_GET['logout'])){
    removeAll();
    header("Location: essentialWorkerPage");
}
if(isset($_SESSION['homepage']) && $_SESSION['homepage'] != 'essentialWorkerPage'){
    $homepage = $_SESSION['homepage'];
    header("Location:".$homepage);
}
  

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Essential Worker | Covid</title>
    <link rel="stylesheet" href="menu.css">
         
    <link rel="stylesheet" href="generalUser.css">
    <script src="jquery.js"></script><script src="alert.js"></script>
    <link rel="stylesheet" href="alert.css">
    <script src="osFinder.js"></script>
    
    <script src="menu.js"></script>
</head>   
<script>
  
    function displayDoc(){
        $(".box").each(function(i){
            $(this).css("display","none");
        });
        $("#docApp, #docStatus").css("display","flex");
        $("#back").css("display","block");
    }
    function hide(){
        $(".box").each(function(i){
            $(this).css("display","flex");
        });
        $("#status,#request,#docApp,#docStatus").css("display","none");
        $("#back").css("display","none");
    }
</script>     
<body>
    
   <?php  require_once('menubar.php'); ?>
    <h3 class="heading">Stay home! Stay safe!</h3>
    <div class="main">
    
        <div class="box">
            <h3>Report symptoms</h3>
            <span class="icon-wrap">
                <span class="icon"></span>
                <div class="content">
                    <h3>Info</h3><hr>
                    <p>The most common symptoms of COVID-19 are fever, tiredness, and dry cough. If you suffer with these symptoms? Report asap.</p>
                </div>
            </span>
            <p>Report symptoms</p>
            <a href="report_patient.php"> <button>View More</button></a>
        </div>
        <div class="box">
            <h3>Transport Pass</h3>
            <span class="icon-wrap">
                <span class="icon"></span>
                <div class="content">
                    <h3>Info</h3><hr>
                    <p>View Transport Pass.</p>
                </div>
            </span>
            <p>Essential Service Transport Pass.</p>
            <a href="essPass.php"><button>View More</button></a>
        </div>
        <div class="box">
            <h3>Report Nearest Health Facility</h3>
            <span class="icon-wrap">
                <span class="icon"></span>
                <div class="content">
                    <h3>Info</h3><hr>
                    <p>The Union Health Ministry proposed classification of health facilities into three categories COVID Care Centre, Dedicated COVID Health Centre and Dedicated COVID Hospital.</p>
                </div>
            </span>
            <p>Provide info about nearest health center.</p>
            <a href="report_hospital.php"><button>View More</button></a>
        </div>
        <div class="box">
            <h3>Doctor's Appointment</h3>
            <span class="icon-wrap">
                <span class="icon"></span>
                <div class="content">
                    <h3>Info</h3><hr>
                    <p>You can book an appointment with any doctors available within certain radius. Keep a note on the appointment status too! </p>
                </div>
            </span>
            <p>Book an appointment with the doctor!</p>
            <button onclick="displayDoc()">View More</button>
        </div>
        <div class="box" id="docApp">
            <h3>Book an Appointment</h3>
            <span class="icon-wrap">
                <span class="icon"></span>
                <div class="content">
                    <h3>Info</h3><hr>
                    <p>You can book an appointment with any doctors available within certain radius. Keep a note on the appointment status too! </p>
                </div>
            </span>
            <p>Book an appointment with the doctor!</p>
            <a href="hosApp.php"><button>View More</button></a>
        </div>
        <div class="box" id="docStatus">
            <h3>Appointment Status</h3>
            <span class="icon-wrap">
                <span class="icon"></span>
                <div class="content">
                    <h3>Info</h3><hr>
                    <p>You can book an appointment with any doctors available within certain radius. Keep a note on the appointment status too! </p>
                </div>
            </span>
            <p>Check your Appointment status</p>
            <a href="userdoc"><button>View More</button></a>
        </div>
    </div><button id="back" onclick="hide()">Back</button>
    <br><br>
    <div class="footer">
        <p>Department of Computer Technology &copy; Madras Institute of Technology</p>
    </div>
</body>
</html>
