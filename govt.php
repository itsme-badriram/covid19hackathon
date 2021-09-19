<?php
require_once('dbConnect.php');
require_once('functions.php');


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="menu.css">
         
    <link rel="stylesheet" href="govt.css">
    <script src="jquery.js"></script><script src="alert.js"></script>
    <link rel="stylesheet" href="alert.css">
     <script src="osFinder.js"></script>
    
    <script src="menu.js"></script>
    <script src="helpline.js"></script>
    <title>Government Services | Covid</title>
    <script src="loader.js"></script>
    <link rel="stylesheet" href="loader.css">
</head>
<body>
         
    <?php require_once('menubar.php'); ?>
    <div class="main">
        <div class="box">
            <span class="img"></span>
            <h3>Government of Sikkim</h3>
            <a href="https://sikkim.gov.in/">View More</a>
        </div>
        <div class="box">
            <span class="img ann"></span>
            <h3>Official News and Announcements</h3>
            <a href="https://sikkim.gov.in/media/news-announcement">View More</a>
        </div>
        <div class="box">
            <span class="img fire"></span>
            <h3>Sikkim Fire Brigade Service</h3><a href="http://www.sikkimfire.nic.in/Public_Service.htm">View More</a>
        </div>
        <div class="box">
            <span class="img gas"></span>
            <h3>Online Gas Connection</h3>
            <a href="https://www.gascompany.co.in/centre-state/sikkim/">View More</a>
        </div>
        <div class="box">
            <span class="img light"></span>
            <h3>Online Electricity Bills Payment</h3>
            <a href="http://www.sikkimpower.in/webdynpro/dispatcher/local/SikkimOnlinePayment/OnlinePaymentSikkim">View More</a>
        </div>
        
        <div class="box">
            <span class="img ser"></span>
            <h3>State Online Services</h3>
            <a href="http://www.sikkimservice.in/">View More</a>
        </div>
    </div>
    <div class="footer">
        <p>Department of Computer Technology &copy; Madras Institute of Technology</p>
    </div>
</body>
</html>