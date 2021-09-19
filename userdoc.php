<?php
require_once('dbConnect.php');
require_once 'functions.php';
if(!checkLogin()){
  header("Location: login"); }

$uname = $_SESSION['uname'];

$today = "2020-02-04";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>View Status | Covid</title>
    <link rel="stylesheet" href="menu.css">
         
    <link rel="stylesheet" href="userdoc.css">
    <script src="jquery.js"></script><script src="alert.js"></script>
    <link rel="stylesheet" href="alert.css">
    <script src="osFinder.js"></script>
    
    <script src="menu.js"></script>
    <script src="osFinder.js"></script>
    <script src="userdoc.js"></script>
</head>  
<body>
         
    <?php   require_once('menubar.php');?>
    <div class="main">
        <div class="app-box">
            <div class="app-head">
                <h2>
                    <span>Your Appointment Status</span>

                    <span class="app-time"><?php  echo $today; ?></span>
                </h2>
                <span class="app-icon"></span>
            </div>
            <div class="app-tab">
                <ul>
                    <li class="list today-list">Today's</li>
                    <li>|</li>
                    <li class="list up-list">Upcoming</li>
                </ul>   
            </div>
            <h3 class="status">Today's Appointments</h3>
            <div class="acc-can">
                <h5>
                    <span class="acc-icon"></span>
                    <span>Accepted</span>
                </h5>
                <h5>
                    <span class="acc-icon cancel"></span>
                    <span>Cancelled</span>
                </h5>
            </div>
            <div class="today-wrap">
            <?php
            $sql = "SELECT * FROM patienttable WHERE uname ='".$uname."' AND appointment_date = '".$today."'";
           
            $result = $conn->query($sql); 
            if(!$result || mysqli_num_rows($result) == 0){
                echo '<h2 class="filter-head"><span>You Have Not Booked Any Appointment</span></h2>';
            }
            while($row = $result->fetch_assoc()){
                $status = $row['status'] == 'Cancelled' ? "cancelBack" : "";
                $docid = $row['doc_id'];
                $docsql = "SELECT * FROM doctor WHERE email = '".$docid."'";
                $docresult = $conn->query($docsql);
                $doc = $docresult->fetch_assoc();
                $inputvalue = $row['status'] == 'Cancelled' ? 'Book again' : 'Accepted';
                $inputclass = $row['status'] == 'Cancelled' ? 'canc-book' : '';
                $iconclass = $row['status'] == 'Cancelled' ? 'cancel' : '';
               $job_location = $doc['street']."\n ".$doc['area']."\n ".$doc['city']."\n ".$doc['state']."\n ".$doc['pincode'];
                echo '
                <div class="today">
                    <div class="details  '.$status.'">
                        <h3>
                            <span>'.$doc['name'].'</span>
                            <span class="degree">'.$doc['qualification'].','.$doc['specialization'].'</span>
                        </h3>
                        <span class="acc-icon '.$iconclass.'"></span>
                    </div>
                    <div class="date">
                        <span class="date-icon"></span>
                        <span>'.$row['appointment_date'].'</span>
                    </div>
                    <div class="date">
                        <span class="time-icon"></span>
                        <span>'.$row['appointment_time'].'</span>
                    </div>
                    <div class="date">
                        <span class="cont-icon"></span>
                        <span><a href="tel:+'.$doc['contact'].'">'.$doc['contact'].'</a></span>
                    </div>
                    <textarea name="" id="" rows="5" disabled>'.$doc['hospital_name'].',
                    '.$job_location.'</textarea>
                    ';
                    if($row['status'] == 'Cancelled'){
                        echo'
                        <a href="hosAppform.php?username='.$docid.'">
                        <input type="button" value="Book again" class="canc-book">
                    </a>
                        ';
                    }
                    else {
                    echo '
                    <input type="button" value="Accepted">
                ';
                    }
                    echo '</div>';
            }
            
            ?>
            </div>
            <div class="upcome-wrap">
            <?php
            $sql = "SELECT * FROM patienttable WHERE uname ='".$uname."' AND appointment_date != '".$today."' ORDER BY appointment_date ASC";
            $result = $conn->query($sql);
            if(!$result || mysqli_num_rows($result) == 0){
                echo '<h2 class="filter-head"><span>You Have Not Booked Any Appointment</span></h2>';
            }
            while($row = $result->fetch_assoc()){
                $status = $row['status'] == 'Cancelled' ? "cancelBack" : "";
                $docid = $row['doc_id'];
                $docsql = "SELECT * FROM doctor WHERE email = '".$docid."'";
                $docresult = $conn->query($docsql);
                $doc = $docresult->fetch_assoc();
                $inputvalue = $row['status'] == 'Cancelled' ? 'Book again' : 'Accepted';
                $iconclass = $row['status'] == 'Cancelled' ? 'cancel' : '';
                $job_location = $doc['street']."\n ".$doc['area']."\n ".$doc['city']."\n ".$doc['state']."\n ".$doc['pincode'];
                echo '
                <div class="today">
                    <div class="details  '.$status.'">
                        <h3>
                            <span>'.$doc['name'].'</span>
                            <span class="degree">'.$doc['qualification'].','.$doc['specialization'].'</span>
                        </h3>
                        <span class="acc-icon '.$iconclass.'"></span>
                    </div>
                    <div class="date">
                        <span class="date-icon"></span>
                        <span>'.$row['appointment_date'].'</span>
                    </div>
                    <div class="date">
                        <span class="time-icon"></span>
                        <span>'.$row['appointment_time'].'</span>
                    </div>
                    <div class="date">
                        <span class="cont-icon"></span>
                        <span><a href="tel:+'.$doc['contact'].'">'.$doc['contact'].'</a></span>
                    </div>
                    <textarea name="" id="" rows="5" disabled>'.$doc['hospital_name'].',
                    '.$job_location.'</textarea>
                    
                    ';
                    if($status == 'Cancelled'){
                        echo'
                        <a href="hosAppform.html">
                        <input type="button" value="Book again" class="canc-book">
                    </a>
                        ';
                    }
                    else {
                    echo '
                    <input type="button" value="Accepted">
                ';
                    }
                    echo '</div>';


            }
            
            ?>
        </div>
        </div>
        <div class="lab-box">
            <div class="app-head">
                <h2>
                    <span>Lab Reports</span>
                    <span class="app-time">Get well soon!</span>
                </h2>
                <span class="app-icon lab"></span>
            </div>
            <?php

            $sql = "SELECT doc_id,remarks,file_name,date,subject,DATE_FORMAT(`t`.`date`,'%h:%i %p') AS `time` FROM labreport AS t WHERE username = '".$uname."'";
            $result = $conn->query($sql);
            if(!$result || mysqli_num_rows($result) == 0){
                echo '<h2 class="filter-head"><span>You Do Not Have Any Lab Results</span></h2>';
            }
            while($row = $result->fetch_assoc()){
                $docid=$row['doc_id'];
                $docsql = "SELECT * FROM doctor WHERE email = '".$docid."'";
                $docresult = $conn->query($docsql);
                $doc = $docresult->fetch_assoc();
                $filename = $row['file_name'];
                echo '
                <div class="lab-report">
                <div class="lab-time">
                    <h3>
                        <span>'.$row['subject'].'</span>
                        <div class="doc-details">
                            <h4 title="vigneshantony5@gmail.com">'.$doc['name'].', '.$doc['qualification'].'</h4>
                            <div class="date cont">
                                <span class="cont-icon"></span>
                                <span><a href="tel:+'.$doc['contact'].'">'.$doc['contact'].'</a></span>
                            </div>
                        </div>
                    </h3>
                    <div>
                        <div class="date-lab">
                            <span class="date-icon"></span>
                            <span>'.explode(" ",$row['date'])[0].'</span>
                        </div>
                        <div class="date-lab">
                            <span class="time-icon"></span>
                            <span>'.$row['time'].'</span>
                        </div>
                    </div>
                </div>
                <div class="doc-content">
                    <h5>'.$row['remarks'].'</h5>
                    <div class="download">
                        <span class="down-icon"></span>
                        <form id="downloadpdf" action="embedpdf" method="post">
                <input type="text" name="name" value="lab_result/'.$filename.'" hidden>
                <input type="submit" name="download"><a><span>Download</span></a>
                </form>
                       
                    </div>
                </div>
            </div> 

                ';


            }

?>
            
        </div>
    </div>
    <br><br>
    <div class="footer">
        <p>Department of Computer Technology &copy; Madras Institute of Technology</p>
    </div>
</body>
</html>  