<?php
require_once('dbConnect.php');
require_once 'functions.php';
if(!checkLogin()){
  header("Location: login"); }


if(isset($_GET['username']) && $_SESSION['uname']!=$_GET['username']){
$uname = $_GET['username'];
$sql = "SELECT * FROM doctor WHERE email='".$uname."'";

}
else
header("Location: hosApp");

$result = $conn->query($sql);
$row = $result->fetch_assoc();

$working_hours = array("09:00" => 0,'09:30' => 0,'10:00' => 0,'10:30'=> 0,'11:00'=> 0,'11:30'=> 0,'12:00'=> 0,'12:30'=> 0,'13:00'=> 0,'13:30'=> 0,'14:00'=> 0,'14:30'=> 0,'15:00'=> 0,'15:30'=> 0,'16:00'=> 0,'16:30'=> 0,'17:00'=> 0,'17:30'=> 0,'18:00'=> 0,'18:30'=> 0,'19:00'=> 0,'19:30'=> 0,'20:00'=> 0,'20:30'=> 0,'21:00'=> 0,'21:30'=> 0,'22:00'=> 0,'22:30'=> 0);


$workinghours = $row['working_hours'];
$hours = explode(';',$workinghours); 

foreach($hours as $hour)
{$time = explode('-',$hour);

$start_time = explode(':',$time[0]);
$end_time = explode(':',$time[1]);

$start_time_hr = $start_time[0];
$start_time_min = $start_time[1];


$end_time_hr = $end_time[0];
$end_time_min = $end_time[1];

$working_hour = $start_time_hr.':'.$start_time_min;

$working_hours[$working_hour] = 1;

$start_time_hr = (int)$start_time_hr;
$start_time_min = (int)$start_time_min;
$end_time_hr = (int)$end_time_hr;
$end_time_min = (int)$end_time_min;

while($start_time_hr < $end_time_hr){
$new_start_min = ($start_time_min + 30) % 60;
$new_start_hr = $start_time_hr + (int)(($start_time_min + 30) / 60);

$start_time_hr =$new_start_hr; 
$start_time_min = $new_start_min;
if($start_time_min == 0)
$new_start_min = "00"; 
if($new_start_hr<10)
$new_start_hr = "0".strval($new_start_hr);
$working_hour = strval($new_start_hr).':'.strval($new_start_min);
$working_hours[$working_hour] = 1;
}

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Application Form | Covid</title>
    <link rel="stylesheet" href="menu.css">
         
    <link rel="stylesheet" href="hosAppform.css">
    <script src="jquery.js"></script><script src="alert.js"></script>
    <link rel="stylesheet" href="alert.css">
    <script src="osFinder.js"></script>
    <script src="hosAppform.js"></script>
   
    <script src="menu.js"></script>
   
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBQGctSfJElLgutbtHHnPct4JkGzdxg_GA"></script>
    <script src="loader.js"></script>
    <link rel="stylesheet" href="loader.css">
</head>
<body>
         
    <?php require_once('menubar.php'); ?>
    <div class="main">
        <h2>Doctor Appointment Form</h2>
        <?php
        $job_location = $row['street']."\n ".$row['area']."\n ".$row['city']."\n ".$row['state']."\n ".$row['pincode'];

    echo '
        <div class="doc-details">
        <h3>Doctor Details</h3>
        <table class="doc-table">
            <tr>
                <th>Doctor</th>
                <td>'.$row['name'].', '.$row['qualification'].'</td>
            </tr>
            <tr>
                <th>Specialist</th>
                <td>'.$row['specialization'].'</td>
            </tr>
            <tr>
                <th>Hospital Name</th>
                <td>'.$row['hospital_name'].'</td>
            </tr>
            <tr>
                <th>Contact</th>
                <td><a href="tel:+91'.$row['contact'].'">'.$row['contact'].'</a></td>
            </tr>
            <tr>
                <th>Address</th>
                <td>'.$job_location.'</td>
            </tr>
            <tr>
                <th>Working Hours</th>
                <td>'.$row['working_hours'].'</td>
            </tr>
        </table>
        </div>

    ';

    ?>
    <script>
        var doc_id = '<?php echo $uname   ?>';
        var gender,time;
function onRadioHandler(radio){
    gender = radio;

}

</script>
        <form action="" id="form">
            <h3>Personal Details</h3>
            <input type="text" name="" id="name" placeholder="Patient Name"><br>
            <input type="text" name="" id="guardian" placeholder="Father's/Guardian's Name"><br>
            <div class="gen">
                <label for="male">
                    <input type="radio" name="gender" id="male" onclick="onRadioHandler('Male')">
                    <span>Male</span>
                </label>
                <label for="female">
                    <input type="radio" name="gender" id="female" onclick="onRadioHandler('Female')">
                    <span>Female</span>
                </label>
                <label for="others">
                    <input type="radio" name="gender" id="others" onclick="onRadioHandler('Others')">
                    <span>Others</span>
                </label>
            </div><br>
            <div class="age">
                <input type="number" name="" id="age" placeholder="Age">
                <input type="text" name="" id="weight" placeholder="Weight(Kg)">
                <input type="text" name="" id="height" placeholder="Height(cm)">
            </div><br>
            <input type="text" name="" id="contact"  placeholder="Contact Number"><br>
            <textarea name="" id="address" cols="30" rows="5" placeholder="Patient Address"></textarea><br>
           
            <h3>Appointment Details</h3>
            <div class="appTime">
                <h4 class="appDate">Select Appointment Date</h4>
                <input type="date" name="" id="date"><br><br>
                <div class="app-head">
                    <h4>Available Timing Slots</h4>
                    <span class="result"><b>Status : </b>Available</span>
                </div>
                <div class="time">
                    <?php  
                        foreach($working_hours as $key=>$value){
                            $classname = !$value? "time-box-none" : "time-box";
                            echo'
                            <span class="'.$classname.'" >'.$key.'</span>';

                        }


                ?>
                    
                </div>
                <h4>
                    Selected time-slot : 
                    <span class="time-slot"></span>
                </h4>
            </div><br>
            <input type="button" onclick="onSubmit()" value="Submit my Application">
        </form>
    </div><br><br>
    <script>

        function onSubmit(){
            var time_slot = getTime();
            $.post("reportAction.php?patientAppointment=true",{
                name: document.getElementById("name").value,
                guardian : document.getElementById("guardian").value,
                gender: gender,
                age: document.getElementById("age").value,
                height: document.getElementById("height").value,
                weight: document.getElementById("weight").value,
                contact: document.getElementById("contact").value,
                address: document.getElementById("address").value,
                date:  document.getElementById("date").value,
                time: time_slot,
                doc_id: doc_id
            },function(response){
                alertBox("Appointment Submitted Successfully",'',2);


                $("#form").trigger("reset");
            });

        }


                    </script>
    <div class="footer">
        <p>Department of Computer Technology &copy; Madras Institute of Technology</p>
    </div>
</body>
</html>