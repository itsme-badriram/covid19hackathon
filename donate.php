<?php
require_once('dbConnect.php');
require_once('functions.php');


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Donate | Covid</title>
    <link rel="stylesheet" href="menu.css">
    <script src="jquery.js"></script><script src="alert.js"></script>
    <link rel="stylesheet" href="alert.css">
    <script src="menu.js"></script>
    <script src="osFinder.js"></script>
    <link rel="stylesheet" href="donate.css">
    <script src="loader.js"></script>
    <link rel="stylesheet" href="loader.css">
</head>
<body>
         
    <?php  require_once('menubar.php') ?>
    <div class="quick-bar">
        <div class="qbox don">
            <a href="onlineDonate">
                <span class="img donate"></span>
                <h3>Donate Funds</h3>
                <h5>People live when people give!</h5>
            </a>
        </div>
        <div class="qbox relief">
            <a href="collection">
                <span class="img rel"></span>
                <h3>Donate Relief Funds</h3>
                <h5>People live when people give!</h5>
            </a>
        </div>
    </div>
</body>
</html>