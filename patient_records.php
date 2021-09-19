<?php
require_once('dbConnect.php');
require_once('functions.php');
if(!checkLogin()){
    header("Location: login"); }

    if(isset($_GET['logout'])){
        removeAll();
        header("Location: doctor");
    }
    if(isset($_SESSION['homepage']) && $_SESSION['homepage'] != 'doctor'){
        $homepage = $_SESSION['homepage'];
        header("Location: $homepage");
    
      }
$uname = $_SESSION['uname'];
$doc_sql = "SELECT * FROM doctor WHERE email = '".$uname."'";
$doc_result = $conn->query($doc_sql);
$user = $doc_result->fetch_assoc();

$sql = "SELECT * FROM patienttable WHERE doc_id ='".$uname."' ORDER BY appointment_time ASC ";
$result = $conn->query($sql);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Patient Records | Covid</title>
    <link rel="stylesheet" href="menu.css">
         
    <link rel="stylesheet" href="patient_records.css">
    <script src="jquery.js"></script><script src="alert.js"></script>
    <link rel="stylesheet" href="alert.css">
    <script src="osFinder.js"></script>
    
    <script src="menu.js"></script>
    <script src="loader.js"></script>
    <link rel="stylesheet" href="loader.css">
</head>    
<body>
         
    <?php  require_once('menubar.php'); ?>  
    <div class="form-wrap" id="main-box">
        <div class="heading">
            <h2>Doctor Details</h2>
            <?php 
             $job_location = $user['street']."\n ".$user['area']."\n ".$user['city']."\n ".$user['state']."\n ".$user['pincode'];
            echo'
            <table class="doc-table">
                <tr><th>Doctor</th><td>'.$user['name'].', '.$user['qualification'].'</td></tr>
                <tr><th>Specialist</th><td>'.$user['specialization'].'</td></tr>
                <tr><th>Hospital Name</th><td>'.$user['hospital_name'].'</td></tr>
                <tr><th>Contact</th><td><a href="tel:+91'.$user['contact'].'">'.$user['contact'].'</a></td></tr>
                <tr>
                    <th>Address</th>
                    <td><textarea name="" id="" cols="30" rows="5" disabled>'.$job_location.'
                    </textarea></td>
                </tr>
            </table> ';
            ?>
        </div><hr>

        <?php
        if(!$result || mysqli_num_rows($result) == 0){
            echo '<h2 class="filter-head"><span>You Do Not Have Any Appointments</span></h2>';
        }
        else{
        echo'
        <div class="heading">
            <h2>Patient Records</h2>
        </div>
        <div class="table-wrap">
            <table class="stable">
                <thead>
                    <tr>
                        <th class="fix"><h3>Patient ID</h3></th>
                        <th class="details"><h3>Patient Details</h3></th>
                        <th class="fix"><h3>Date of Appointment</h3></th>
                        <th class="fix"><h3>Time of Appointment</h3></th>
                        <th class="fix"><h3>COVID-19 Test Result</h3></th>
                    </tr>
                </thead>
                <tbody>
               ';     
        while($row = $result->fetch_assoc()){
            echo '
            <tr id="p1">
                        <td id="p1id">'.$row['patient_id'].'</td>
                        <td id="p1details" class="patientdetails">
                            <div class="phead">
                                <h4>'.$row['name'].'</h4>
                                <span class="back"></span>
                            </div>
                            <table class="pdetails">
                                <tr><th>Name</th><td>'.$row['name'].'</td></tr>
                                <tr><th>Age</th><td>'.$row['age'].'</td></tr>
                                <tr><th>Gender</th><td>'.$row['gender'].'</td></tr>
                                <tr><th>Height</th><td>'.$row['height'].' cm</td></tr>
                                <tr><th>Weight</th><td>'.$row['weight'].' kg</td></tr>
                                <tr><th>Contact</th>
                                <td><a href="tel:+91'.$row['contact'].'">'.$row['contact'].'</a></td></tr>
                            </table>
                        </td>
                        <td id="p1date">'.$row['appointment_date'].'</td>
                        <td id="p1time">'.$row['appointment_time'].'</td>
                        <td id="p1res">Negative</td>
                    </tr>
            
            ';

        }

    }
?>
                    
                    
                </tbody>
            </table>
        </div>
    </div><br><br>
    <div class="footer">
        <p>Department of Computer Technology &copy; Madras Institute of Technology</p>
    </div>
    <script>
        $(document).ready(function(){
            var tCount = 0;
            $(".back").click(function(){
                if(tCount % 2 == 0){
                    $(this).parent().siblings(".pdetails").show();
                    $(this).css("transform","rotate(90deg)");
                }
                else{
                    $(this).parent().siblings(".pdetails").hide();
                    $(this).css("transform","rotate(-90deg)");
                }
                tCount++;
            });
        });
    </script>
</body>
</html>