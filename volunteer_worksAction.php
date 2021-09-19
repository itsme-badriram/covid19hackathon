<?php

require_once 'dbConnect.php';
require_once 'functions.php';

if(isset($_GET['getJobs'])){
    if(isset($_GET['lat']) && isset($_GET['lng'])){
        $lat=$_GET['lat'];
        $lon=$_GET['lng'];
        $filter = "no_of_volunteers > curr_num ";
        $radius = 4;
        if(isset($_POST['radius']) && isset($_POST['specialization']) ){
            $radius = $_POST['radius'];
            if($_POST['specialization']!='undefined')
            $filter.= "AND field_name = '".$_POST['specialization']."'";
        }

$id = $_SESSION['uname'];

$temp = "SELECT * FROM jobvolunteers WHERE uname = '".$id."' AND status = 'Accepted' ";
$result = $conn->query($temp);
$flag = 1;
if(!$result || mysqli_num_rows($result)!=0){
    $flag = 0;
}
$sql = "SELECT * FROM jobpool WHERE $filter";

$result = $conn->query($sql);
$count = mysqli_num_rows($result);
if($count != 0){
while($row = $result->fetch_assoc()){
if( $row['username']!=$_SESSION['uname']){
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
    $jobid = $row['jobid'];
    $user_sql = "SELECT name, contact FROM generaluser WHERE email = '".$row['username']."' ";
    $user_result = $conn->query($user_sql);
    $user = $user_result->fetch_assoc();
    $classname = $flag ? "accept":"notaccept";
    echo '
    <div class="box" id="work1">
    <div class="job">
        <div class="jobTitle">
            <span>'.$row['job_title'].'</span><br>
            <h5>'.$row['field_name'].'</h5>
            <h5>'.$row['field_type'].'</h5>
        </div>
        <a href="mapdisplay.php?lat='.$row['lat'].'&lng='.$row['lng'].'" style="text-decoration: none;"><span class="dist">'.round($km,2).' km</span><span class="mapView" title="Open in Maps"></span></a>
    </div>
    <hr>
    <div class="jobDiv">
        <table class="jobDetails">
            
            <tr>
                <th>Requested by</th>
                <td>'.$user['name'].'</td>
            </tr>
            <tr>
                <th>Contact</th>
                <td><a href="tel:+91'.$user['contact'].'">'.$user['contact'].'</a></td>
            </tr>
            <tr>
                <th>Time of Request</th>
                <td>'.$row['date'].'</td>
            </tr>
        </table>
        <div class="'.$classname.'"><span  onclick="acceptRequest('.$jobid.',\''.$id.'\')">'; if($flag) echo 'Accept'; echo '</span></div>
    </div>
    <hr>
    <div class="content">
        <h4>Full Address</h4>
        <textarea name="" id=""disabled>'.$row['address'].'
        </textarea><br><br>
        <h4>Job Description</h4>
        <p>'.$row['job_desc'].'</p>
    </div>
    <input type="button" value="View Details" id="view">
</div>
    ';






}
}
}
    }
}

}


?>