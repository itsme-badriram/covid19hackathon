<?php
require_once('dbConnect.php');
$radius = 4;
$filter = "1";
if(isset($_GET['lat']) && isset($_GET['lng'])){
    $lat=$_GET['lat'];
    $lon=$_GET['lng'];
if(isset($_POST['radius']) && isset($_POST['specialization']) ){
    $radius = $_POST['radius'];
    if($_POST['specialization']!='undefined')
    $filter = "specialization = '".$_POST['specialization']."'";
}

$sql = "SELECT * FROM doctor WHERE $filter";
$result = $conn->query($sql);

while($row = $result->fetch_assoc()){
if( $row['email']!=$_SESSION['uname']){

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

    <div class="doc-box">
    
    <div class="doc-info">
        <div>
            <h3>'.$row['name'].'</h3>
            <h6>'.$row['qualification'].'</h6>
            <span class="type">'.$row['specialization'].'</span>
        </div>
        <span class="doc-icon '.$classname.'"></span>
    </div>
    <table>
        <tr>
            <th>Hospital</th>
            <td>'.$row['hospital_name'].'</td>
        </tr>
        <tr>
            <th>Consulting Hours</th>
            <td>'.$row['working_hours'].'</td>
        </tr>
        <tr>
            <th>Contact</th>
            <td><a href="tel:+91'.$row['contact'].'">'.$row['contact'].'</a></td>
        </tr>
        <tr>
            <th>Location</th>
            <td class="locate">
            <a href="mapdisplay.php?lat='.$row['lat'].'&lng='.$row['lng'].'"> <span class="map-icon" ></span></a>
                <span class="away">'.round($km,2).' km</span>
            </td>
        </tr>
    </table>
    <textarea name="" id="" cols="30" rows="6" disabled>'.$job_location.'
    </textarea>
    <a href="hosAppform?username='.$row['email'].'"><button>Book an Appointment</button></a> 
    <!--<input type="button" class="submit" name="form_submit" onclick="onBookAppointment()" value="Book an Appointment">-->
   
</div>

';
}
}
}
}
?>