<?php
require_once('dbConnect.php');
require_once('functions.php');
if(!checkLogin()){
    header("Location: login"); }
if(isset($_SESSION['homepage']) &&  $_SESSION['homepage'] != 'volunteerPage'){
    $homepage = $_SESSION['homepage'];
    header("Location: $homepage");
}

$id = $_SESSION['uname'];

$sql = "SELECT * FROM jobvolunteers WHERE uname = '".$id."' AND status IN ('Accepted','Ongoing','Completed')";


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Volunteer Jobs | Covid</title>
    <link rel="stylesheet" href="menu.css">
         
    <link rel="stylesheet" href="volStatus.css">
    <script src="jquery.js"></script><script src="alert.js"></script>
    <link rel="stylesheet" href="alert.css">
    <script src="osFinder.js"></script>
    
    <script src="menu.js"></script>
    <script src="loader.js"></script>
    <link rel="stylesheet" href="loader.css">
</head>    
<script>
    $(document).on('click','#view',function(){
        $(this).parent(".box").children(".content").slideToggle();
    });
</script>
<body>
         
    <?php  require_once('menubar.php'); ?>
    <div class="main">
        <h2>Ongoing Job Status</h2>

        <?php
              $result = $conn->query($sql);
              while($row = $result->fetch_assoc()) {
                  $jobid = $row['jobid'];
                  $sql = "SELECT * FROM jobpool INNER JOIN jobvolunteers ON jobpool.jobid = jobvolunteers.jobid WHERE jobvolunteers.jobid =$jobid AND jobvolunteers.uname = '".$id."'";

                  $execute = $conn->query($sql);

            while($record = $execute->fetch_assoc()) {

                $user_sql = "SELECT name, contact FROM generaluser WHERE email = '".$record['username']."' ";
                $user_result = $conn->query($user_sql);
                $user = $user_result->fetch_assoc();
                $classname = ($record['status'] == 'Ongoing' || $record['status'] == 'Accepted')? "jobBox":"jobCBox"; 
                $finish = ($record['status'] == 'Completed')? "finish" : "";
                echo '
                <div class="'.$classname.'">
                <span class="jTitle">
                    <h3>'.$record['job_title'].'</h3>
                    <span class="categ">'.$record['field_name'].'</span>
                    <span class="status">'.$record['status'].'</span>
                </span>
                <div class="jDetails">
                    <div>
                        <span class="jobID">ID:'.$record['jobid'].'</span>
                        <table class="jobDetails">
                        <tr>
                            <th>Location</th>
                            <td class="locate">
                            <a href="mapdisplay.php?lat='.$record['lat'].'&lng='.$record['lng'].'"> <span class="mimg" ></span></a>
                            </td>
                        </tr>
                          
                            <tr>
                                <th>Requested by</th>
                                <td>'.$user['name'].'</td>
                            </tr>
                            <tr>
                                <th>Contact</th>
                                <td><a href="tel:+91'.$user['contact'].'">'.$user['contact'].'</a></td>
                            </tr>
                            <tr>
                            <th>Job</th>
                            <td class="locate">
                                <span>'.$record['field_type'].'</span>
                            </td>
                        </tr>
                        </table>
                    </div>
                    <span class="status-img '.$finish.'"></span>
                </div>
            </div>
                
                ';
            }


        }
                  

            ?>
        
       
    </div>
    <br><br>
    <div class="footer">
        <p>Department of Computer Technology &copy; Madras Institute of Technology</p>
    </div>
</body>
</html>