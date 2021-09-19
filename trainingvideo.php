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
    <title>Online Courses | Covid</title>
    <link rel="stylesheet" href="menu.css">
         
    <link rel="stylesheet" href="trainingvideo.css">
    <script src="jquery.js"></script><script src="alert.js"></script>
    <link rel="stylesheet" href="alert.css">
    <script src="osFinder.js"></script>
    
    <script src="menu.js"></script>
    <script src="trainvideo.js"></script>
    <script src="loader.js"></script>
    <link rel="stylesheet" href="loader.css">
</head>    
<body >
         
    <?php  require_once('menubar.php'); ?>
    <div class="addVideo">
        <h2 class="title">Online Training Courses</h2>
        <div class="formA">
            <span id="add">+</span>
            <div>
                <form id="form-wrap" action="" method="post">
                    <input type="text" name="" id="category" placeholder="Enter Category">
                    <input type="text" name="" id="url" placeholder="Enter Video URL">
                    <input type="button" onclick="onAddVideo()" value="Add Video">
                </form>
            </div>
        </div>
    </div>
    <div class="videos">
        <div class="sidebar">
            <h3>Categories</h3>
            <ul>
                <li class="list">First Aid Course</li>
                <li class="list">Logistics</li>
                <li class="list">Counselling</li>
            </ul>
        </div>
      
        <div class="sidebar-small">
            <h3>Select Category</h3>
            <select name="" id="selectcategory">
                <option value="Select Category" selected disabled>Select Category</option>
                <option value="First Aid Course">First Aid Course</option>
                <option value="Logistics">Logistics</option>
                <option value="Counselling">Counselling</option>
            </select>
        </div>
        <div class="mainbar" id="mainvideo">
          
        </div>
    </div><br><br>
    <div class="footer">
        <p>Department of Computer Technology &copy; Madras Institute of Technology</p>
    </div>
</body>
</html>
