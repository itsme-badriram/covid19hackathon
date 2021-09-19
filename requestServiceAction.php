<?php
require_once('dbConnect.php');
require_once('functions.php');
$date="";
$uname = $_SESSION['uname'];
if(isset($_GET['requestStatus'])){
$date = date("Y-m-d H:i:s");

$lat = $_POST['lat'];
$lng = $_POST['lng'];
$field = $_POST['field'];
$type = $_POST['type'];
$address = $_POST['job_location'];
$title = $_POST['job_title'];
$desc = $_POST['job_desc'];
$nov = $_POST['nov'];

$sql = "INSERT INTO jobpool(`username`,`job_title`,`job_desc`,`field_name`,`field_type`,`address`,`lat`,`lng`,`date`,`no_of_volunteers`,`curr_num`) VALUES ('$uname','$title','$desc','$field','$type','$address',$lat,$lng,'$date','$nov',0)";
signUp($sql);

$sql = "SELECT jobid from jobpool WHERE username = '".$uname."' AND date = '".$date."'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

echo $row['jobid'];


}

if(isset($_GET['changeStatus'])){

    $jobid = $_POST['jobid'];
    $id = $_POST['id'];
    $status = "Accepted";
    $sql = "INSERT INTO jobvolunteers(`uname`,`jobid`,`status`) VALUES ('$id',$jobid,'$status')";
  
    if(signUp($sql)){
        $sql = "INSERT INTO qrcode(`jobid`,`uname`,`status`) VALUES ($jobid,'$id','Not Verified')";
        
        if(signUp($sql)){            
            $sql = "UPDATE jobpool SET curr_num = curr_num+1 WHERE jobid = $jobid";
            
            signUp($sql);


        }




    }
    

}

if(isset($_GET['changeQrcodeStatus'])){
    $jobid = $_POST['jobid'];
    $id = $_POST['id'];
    $date = date("Y-m-d H:i:s");
    $sql = "UPDATE qrcode SET status='Verified',date='".$date."' WHERE jobid = $jobid AND uname ='".$id."'";
    if(signUp($sql))
    echo 'Success';
}
if(isset($_GET['userstatus'])){
    $uname = $_SESSION['uname'];
    $sql = "SELECT * FROM jobpool WHERE username = '".$uname."' ";
    $result = $conn->query($sql);    
            while($row=$result->fetch_assoc()){
                $jobid = $row['jobid'];
                
                $volsql = "SELECT * FROM jobvolunteers WHERE jobid = $jobid AND status IN ('Accepted','Ongoing','Completed')";
                $volresult = $conn->query($volsql);
                $count = $row['curr_num'];
                $classname = $count == $row['no_of_volunteers'] ? "jobCBox" :"jobBox" ;
                $finish = $classname == 'jobCBox' ? "finish" : "";
                $status = $classname == 'jobCBox' ? "Completed" :  "Ongoing";
                $comp = $classname == 'jobCBox' ? "comp" : "";
                echo '
                
                <div class="'.$classname.'">
                <span class="jTitle">
                    <h3>'.$row['job_title'].'</h3>
                    <span class="categ">'.$row['field_name'].'</span>
                    <span class="status '.$comp.'">'.$status.'</span>
                </span>
                <div class="jDetails">
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
                    <span class="status-img '.$finish.'"></span>
                </div>
                
                
                ';

        
if($classname == 'jobBox' && $volresult && mysqli_num_rows($volresult)!=0){

    echo '<button class="qrButton">Click here to scan QR-Code</button>
    <div class="jobSlide"><hr>
        <h3>Volunteer Details</h4>';
        
        while($vol = $volresult->fetch_assoc()){
            $id = $vol['uname'];
            $detailssql = "SELECT * FROM volunteer WHERE email = '".$id."' ";
            $detailsresult =$conn->query($detailssql);
            $details = $detailsresult->fetch_assoc();
            $qrcodesql = "SELECT * FROM qrcode WHERE jobid = $jobid AND uname = '".$id."'";
            $qrcoderesult = $conn->query($qrcodesql);
            $qrcode = $qrcoderesult->fetch_assoc();
            $comp = $qrcode['status'] == 'Not Verified' ? "verify" : "comp";
            $scannedAt = $qrcode['date']? $qrcode['date'] : "Not Yet";
            $address = $details['street']." ".$details['area'];
            echo'
            <div class="jobScan">
            <span class="jTitle">
                <h3>'.$details['name'].'</h3>
                <span class="status '.$comp.'">'.$qrcode['status'].'</span> 
            </span>
            <div class="jDetails">
                <div>
                    <span class="jobID">V-ID:'.$vol['uname'].'</span>
                    <table class="jobDetails">
                    <tr>
                            <th>Job Status</th>
                            <td>'.$vol['status'].'</td>
                        </tr>
                        <tr>
                            <th>Location</th>
                            <td class="locate">
                            <a href="mapdisplay.php?lat='.$row['lat'].'&lng='.$row['lng'].'"> <span class="mimg" ></span></a>
                            </td>
                        </tr>
                        <tr>
                            <th>Address</th>
                            <!--<td><a href="tel:+919940595423">9940595423</a></td> -->
                            <td>'.$address.' </td>
                        </tr>
                       <tr>
                            <th>Scanned at</th>
                            <td>'.$scannedAt.'</td>
                        </tr> 
                    </table>
                </div>
                <button class="qrScan" onclick="onScan('.$jobid.',\''.$uname.'\',\''.$id.'\')">Scan</button>
            </div>
            </div>
        
        ';


        
    }
    

    echo '</div>';



}
echo '</div>';
            }
    
}

