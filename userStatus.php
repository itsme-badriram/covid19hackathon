<?php
require_once('dbConnect.php');
require_once('functions.php');
if(!checkLogin()){
    header("Location: login"); }

$uname = $_SESSION['uname'];




?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Jobs Status | Covid</title>
    <link rel="stylesheet" href="menu.css">
         
    <link rel="stylesheet" href="volStatus.css">
    <link rel="stylesheet" href="userStatus.css">
    <script src="jquery.js"></script><script src="alert.js"></script>
    <link rel="stylesheet" href="alert.css">
    <script src="osFinder.js"></script>
    <script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
  
    <script src="menu.js"></script>
    <script src="osFinder.js"></script>
    
    <script src="loader.js"></script>
    <link rel="stylesheet" href="loader.css">
</head>    
<script>
    $(document).on('click','#view',function(){
        $(this).parent(".box").children(".content").slideToggle();
    });
    $(document).on('click',".qrButton",function(){
        $(this).siblings(".jobSlide").slideToggle();
    });
    $(document).ready(function(){
        $.post('requestServiceAction.php?userstatus=true',function(response){
            if(response==""){
                response = '<h2 class="filter-head"><span>--You Have Not Requested Any Volunteer Assistance--</span></h2>'
            }
            document.getElementById("ongoing_jobs").innerHTML = response
        });

    });
</script>
<body>
         
    <?php  require_once('menubar.php'); ?>
    <div class="main">
        <h2>Ongoing Job Status</h2>
    <div id="ongoing_jobs">
    </div>

        
       
    </div>
    <div id="popup" class="popup">
        <video id="preview"></video>
    </div>
    <div class="scan-head">
        <span id="back" onclick="hide()">X</span>
        <h3>Scan QR-Code</h3>
    </div>
    <script>
    var scanner;
    function hide(){
        $("#popup").css("display","none");
        $(".scan-head").css("display","none");
        $("body").removeClass("scroll-stop");
        scanner.stop();
    }
    function onScan(jobid,uname,id){
        var popup = document.getElementById('popup');
        popup.style.display = 'block';
        $(".scan-head").css("display","flex");
        $("body").addClass("scroll-stop");
        scanner = new Instascan.Scanner({ 
            video: document.getElementById('preview'), mirror: false 
        });
        scanner.addListener('scan', function (content) {
            var content = JSON.parse(content);
            console.log(content);
            if(content['username'] == uname && content['jobid'] == jobid && content['id'] == id){
               
                $.post('requestServiceAction.php?changeQrcodeStatus=true',{
                    jobid : jobid,
                    id : id,
                },function(response){
                    alertBox("Verification Successful",'',2);
                    $.post('requestServiceAction.php?userstatus=true',function(response){
            document.getElementById("ongoing_jobs").innerHTML = response
        });
                });
                

            }
            else
            alertBox("Verification Failed",'',1);

            hide();
            scanner.stop();
        });
        Instascan.Camera.getCameras().then(function (cameras) {
            if (cameras.length > 0) {
                var selectedCam = cameras[0];
                $.each(cameras, (i, c) => {
                    if (c.name.indexOf('back') != -1) {
                        selectedCam = c;
                        return false;
                    }
                });
                scanner.start(selectedCam);
            } 
            else {
                console.error('No cameras found.');
            }
        }).catch(function (e) {
            console.error(e);
        });
        }
</script>
    <br><br>
    <div class="footer">
        <p>Department of Computer Technology &copy; Madras Institute of Technology</p>
    </div>
</body>
</html>
