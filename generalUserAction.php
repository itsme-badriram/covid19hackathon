<?php
require_once 'dbConnect.php';
require_once 'functions.php';

if(isset($_GET['userStatus'])){

    $uname = $_SESSION['uname'];
    $sql = "SELECT * FROM jobpool WHERE username ='".$uname."' ORDER BY date DESC ";
   
    $result = $conn->query($sql);
    $count = mysqli_num_rows($result);
    $row = $result->fetch_assoc();
   

    if($count !=0){

    echo '
   
    <h2 class="status-title">
    <span>Volunteer Job status</span>
    <span class="info">i</span>
</h2>
<div class="job-status">
    <div class="job-desc">
        <h4>
            <span class="job-icon">'.$count.'</span>
            <span>Currently Ongoing Jobs</span>
        </h4>
        <span class="legend">
            <span class="on"></span>Ongoing
            <span class="off"></span>Completed
        </span>
    </div>
</div>
                <div class="status-box">
                    <h3>
                        <span>'.$row['job_title'].'</span>
                        <span class="category">'.$row['field_name'].'</span>
                        <span class="on-off"></span>
                        <!--To indicate completed status add off-status class to above class-->
                    </h3>
                    <div class="job-overview">
                        <div>
                            <span class="jobID">JOB-ID:'.$row['jobid'].'</span>
                            <table class="jobDetails">
                                <tr>
                                    <th>Volunteers count</th>
                                    <td>'.$row['no_of_volunteers'].'</td>
                                </tr>
                                <tr>
                                    <th>Request date</th>
                                    <td>'.explode(' ',$row['date'])[0].'</td>
                                </tr>
                                <tr>
                                    <th>Job category</th>
                                    <td>'.$row['field_type'].'</td>
                                </tr>
                            </table>
                        </div>
                        <span class="button job-view"><a href="userStatus">Check it out!</a></span>
                    </div>
                
    
    
    
    
    
    ';
    }

}

if(isset($_GET['volPass'])){
    
    $uname = $_SESSION['uname'];
    $sql = "SELECT * FROM qrcode WHERE uname='".$uname."'";
    $result = $conn->query($sql);
    $count = mysqli_num_rows($result);
    
    if($count !=0)
    echo 'Pass Has Been Generated';
    else
    echo 'Pass Has Not Been Generated';

}
if(isset($_GET['volStatus'])){

    $uname = $_SESSION['uname'];
    $volsql = "SELECT * FROM jobvolunteers WHERE uname = '".$uname."'";
    $volresult = $conn->query($volsql);
    if(mysqli_num_rows($volresult) != 0){
    $vol = $volresult->fetch_assoc();
    $jobid = $vol['jobid'];
    $sql = "SELECT * FROM jobpool WHERE jobid = $jobid ";
   
    $result = $conn->query($sql);
    $count = mysqli_num_rows($result);
    $row = $result->fetch_assoc();
   

    if($count !=0){

    echo '
   
    <h2 class="status-title">
    <span>View Job Status</span>
    <span class="info">i</span>
</h2>
<div class="job-status">
    <div class="job-desc">
        <h4>
            <span class="job-icon">'.$count.'</span>
            <span>Currently Ongoing Jobs</span>
        </h4>
        <span class="legend">
            <span class="on"></span>Ongoing
            <span class="off"></span>Completed
        </span>
    </div>
</div>
                <div class="status-box">
                    <h3>
                        <span>'.$row['job_title'].'</span>
                        <span class="category">'.$row['field_name'].'</span>
                        <span class="on-off"></span>
                        <!--To indicate completed status add off-status class to above class-->
                    </h3>
                    <div class="job-overview">
                        <div>
                            <span class="jobID">JOB-ID:'.$row['jobid'].'</span>
                            <table class="jobDetails">
                                <tr>
                                    <th>Volunteers count</th>
                                    <td>'.$row['no_of_volunteers'].'</td>
                                </tr>
                                <tr>
                                    <th>Request date</th>
                                    <td>'.explode(' ',$row['date'])[0].'</td>
                                </tr>
                                <tr>
                                    <th>Job category</th>
                                    <td>'.$row['field_type'].'</td>
                                </tr>
                            </table>
                        </div>
                        <span class="button job-view"><a href="userStatus">Check it out!</a></span>
                    </div>
                
    
    
    
    
    
    ';
    }
    }
}
if(isset($_GET['labourShelter'])){
    $sql = "SELECT * FROM migrantworker WHERE transportation = 'No'";
    $radius = 4;
    if(isset($_GET['lat']) && isset($_GET['lng'])){
        $lat=$_GET['lat'];
        $lon=$_GET['lng'];
    }
    $result = $conn->query($sql);
$count = mysqli_num_rows($result);
if($count!=0){

    while($row = $result->fetch_assoc()){
        $lat2 = $row['lat'];
        $lon2 = $row['lng'];
        $lat1 = $lat;
        $lon1 = $lon;
        $pi80 = M_PI / 180; 
        $lat1 *= $pi80; 
        $lon1 *= $pi80; 
        $lat2 *= $pi80; 
        $lon2 *= $pi80; 
        $r = 6372.797; // mean radius of Earth in km 
        $dlat = $lat2 - $lat1; 
        $dlon = $lon2 - $lon1; 
        $a = sin($dlat / 2) * sin($dlat / 2) + cos($lat1) * cos($lat2) * sin($dlon / 2) * sin($dlon / 2); 
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a)); 
        $km = $r * $c; 
        if($km <= $radius ){
            echo '
            <h2 class="req-title doc-title lab-title">
                    <span class="head">Nearest Labour Shelter</span>
                    <span class="icon migrant"></span>
                </h2>
                <div class="hosp-box">
                    <h4 class="hos-title">
                        <span>'.$row['place_name'].'</span>
                        <span class="dist">'.round($km,2).' km</span>
                    </h4>
                    <span class="contact">
                        <span>Nearest Shelter Available</span>
                        <span class="icon map" onclick="onNearestMigrant()"></span>
                    </span>
                </div>
                <div class="button"><a href="migrant">Report Labourers</a></div>
            </div>

            ';


        break;
        }
    }


}


}
if(isset($_GET['doctorAppointment'])){
    $uname = $_SESSION['uname'];
$radius = 4;
    if(isset($_GET['lat']) && isset($_GET['lng'])){
        $lat=$_GET['lat'];
        $lon=$_GET['lng'];
    }

$sql = "SELECT * FROM doctor WHERE  email != '".$uname."' ";
$result = $conn->query($sql);
$count = mysqli_num_rows($result);
if($count!=0){

$emer = "SELECT * FROM doctor WHERE email != '".$uname."' AND specialization='Emergency' ";
$emerresult = $conn->query($emer);
$emercount = mysqli_num_rows($emerresult);
while($row = $result->fetch_assoc()){
$lat2 = $row['lat'];
$lon2 = $row['lng'];
$lat1 = $lat;
$lon1 = $lon;
$pi80 = M_PI / 180; 
$lat1 *= $pi80; 
$lon1 *= $pi80; 
$lat2 *= $pi80; 
$lon2 *= $pi80; 
$r = 6372.797; // mean radius of Earth in km 
$dlat = $lat2 - $lat1; 
$dlon = $lon2 - $lon1; 
$a = sin($dlat / 2) * sin($dlat / 2) + cos($lat1) * cos($lat2) * sin($dlon / 2) * sin($dlon / 2); 
$c = 2 * atan2(sqrt($a), sqrt(1 - $a)); 
$km = $r * $c; 
if($km <= $radius ){
$classname="";
    if($row['specialization'] == 'Emergency'){
        $classname = "emer";
    }

    $job_location = $row['street']."\n ".$row['area']."\n ".$row['city']."\n ".$row['state']."\n ".$row['pincode'];



    echo'
    <h3>Available Doctors near you (within 4 km)</h3>
                <div class="avail-info">
                    <span class="count">'.(int)($count-$emercount).'</span>
                    <span>Normal Doctors</span>
                </div>
                <div class="avail-info">
                    <span class="count red">'.$emercount.'</span>
                    <span>Emergency Doctors</span>
                </div>
                <div class="hosp-box">
                    <h4 class="hos-title">
                        <span>Dr. '.$row['name'].' - '.$row['qualification'].'</span>
                        <span class="dist">'.round($km,2).' km</span>
                    </h4>
                    <span class="prof">'.$row['specialization'].'</span>
                    <span class="contact">
                        <span class="icon cont"></span>
                        <a href="tel:+91'.$row['contact'].'">'.$row['contact'].'</a>
                        <span class="icon map go" onclick="ondocAppointment(\''.$row['email'].'\')"></span>
                    </span>
                </div>

    ';
break;
}
}
}
}
if(isset($_GET['todayAppointment'])){
    $uname = $_SESSION['uname'];
    $today = "2020-02-04";
    $sql = "SELECT * FROM patienttable WHERE uname ='".$uname."' AND appointment_date='".$today."' ";

    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $count = mysqli_num_rows($result);
if($count!=0){

        $doc_id = $row['doc_id'];
    $sql = "SELECT * FROM doctor WHERE  email = '".$doc_id."' ";
    $result = $conn->query($sql);
    $doc = $result->fetch_assoc();
   
    echo '
    <h2 class="req-title doc-title">
    <span>Today\'s Appointments</span>
    <span class="icon doc"></span>
</h2>
<span class="date-time"><b>Date</b> : '.$today.'</span>
<div class="doc-details">
    <div>
        <span class="doc-name">Dr. '.$doc['name'].', '.$doc['qualification'].'</span>
        <span class="contact">
            <span class="icon cont"></span>
            <a href="tel:+91'.$doc['contact'].'">'.$doc['contact'].'</a>
        </span>
    </div>
    <span class="doc-time">'.$row['appointment_time'].'</span>
</div>
<div class="button"><a href="userdoc">Check Status!</a></div>
    
    
    ';
}
}



if(isset($_GET['labReport'])){
    $uname = $_SESSION['uname'];

    $sql = "SELECT * FROM labreport WHERE username='".$uname."' ORDER BY date DESC LIMIT 1";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
   
    $count = mysqli_num_rows($result);
if($count!=0){
    $doc_id = $row['doc_id'];
    $sql = "SELECT * FROM doctor WHERE  email = '".$doc_id."' ";
    $result = $conn->query($sql);
    $doc = $result->fetch_assoc();
    echo'
    <h3 class="req-title doc-title lab-title">
                <span>Lab Results</span>
                <span class="icon result"></span>
            </h3>
            <div class="lab-col">
                <div class="lab">
                    <span class="lab-details">
                        <span>'.$row['subject'].'</span>
                        <span class="time">'.explode(' ',$row['date'])[0].'</span>
                    </span>
                    <span class="doc-name">Dr. '.$doc['name'].' - '.$doc['qualification'].' </span>
                    <span class="contact">
                        <span class="icon cont"></span>
                        <a href="tel:+91'.$doc['contact'].'">'.$doc['contact'].'</a>
                    </span>
                    <span class="doc-msg">
                        '.$row['remarks'].'
                    </span>
                </div>
            </div>
            <div class="button"><a href="userdoc">View Results</a></div>
    
    
    ';
}
}
?>