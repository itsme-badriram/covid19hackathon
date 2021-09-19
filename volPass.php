<?php
require_once('dbConnect.php');
require_once('functions.php');
$jobid = 0;
$uname = 'none';
if(!checkLogin()){
    header("Location: login"); }
if($_SESSION['homepage'] != 'volunteerPage'){
    $homepage = $_SESSION['homepage'];
    header("Location: $homepage");
}

$id = $_SESSION['uname'];
$sql = "SELECT * FROM jobvolunteers WHERE uname ='".$id."' and status = 'Accepted' ";
$result = $conn->query($sql);
$flag =1;
if(!$result || mysqli_num_rows($result) == 0){
    $flag=0;
     
    

}else {
$row = $result->fetch_assoc(); 
$jobid = $row['jobid'];
$user_sql = "SELECT username FROM jobpool WHERE jobid = $jobid ";
$user_result = $conn->query($user_sql);
$user = $user_result->fetch_assoc();
$uname = $user['username'];
}
$sql = "SELECT name,apartment,street,area,city,state,field,pincode FROM volunteer WHERE email ='".$id."'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Volunteer Pass | Covid</title>
    <link rel="stylesheet" href="menu.css">
         
    <link rel="stylesheet" href="generalUser.css">
    <link rel="stylesheet" href="volunteerPage.css">
    <link rel="stylesheet" href="volPass.css">
    <script src="jquery.js"></script><script src="alert.js"></script>
    <link rel="stylesheet" href="alert.css">
    <script src="osFinder.js"></script>
   
    <script src="menu.js"></script>
    <script src="qrcode.js"></script>
    <script src="loader.js"></script>
    <link rel="stylesheet" href="loader.css">
    
</head>    

<script>

</script>
<body>
         
    <?php  require_once('menubar.php'); ?>
    <div class="mainpass">
        <div id="qrcode">
            <span id="qrwrap">
                <span class="qricon"></span>
                <span>Generate QR Code</span>
            </span>
        </div>
        <div class="details">
            <h3>Personal Details</h3>
            <div class="info">
                <label for="">Name<br>
                    <input type="text" name="" value='<?php echo $row['name']  ?>'  id="" disabled>
                </label><br>
                <label for="">Address<br>
                    <textarea name="" id="" cols="30" rows="10" disabled><?php 
                    $job_location = $row['street']."\n ".$row['area']."\n ".$row['city']."\n ".$row['state']."\n ".$row['pincode'];

                    echo $job_location; ?>
                        
                    </textarea>
                </label><br>
                <label for="">Contact Number<br>
                    <input type="text" name="" id="" value=<?php echo $_SESSION['contact'];  ?>  disabled> 
                </label><br>
                <label for="">Email Address<br>
                    <input type="text" name="" id="" value=<?php echo $_SESSION['uname'];  ?>  disabled>
                </label><br>
                <!--<label for="">Date of Registration<br>
                    <input type="text" name="" id="" value="23rd April 2020" disabled>
                </label><br>-->
                <label for="">Field of Expertise<br>
                    <input type="text" name="" id="" value=<?php echo $row['field'];  ?> disabled> 
                </label><br>
            </div>
        </div>
    </div><br><br>
    <script>
        $(document).ready(function(){


            var flag = <?php  echo $flag; ?>;
            
        $(document).on('click','#qrwrap',function(){


            if(flag == 1) {
            var username = '<?php  echo $uname; ?>';
var jobid = <?php  echo $jobid ?>;
var id = '<?php  echo $id; ?>';
var qrcode = {
    username : username,
    jobid : jobid,
    id: id
}
           
            /*Implement your php condition here*/
            new QRCode(document.getElementById("qrcode"), JSON.stringify(qrcode));
            $("#qrcode").attr('title',"");
            $("#qrwrap").hide();
        

    }
    else {
        alertBox('QRCode Generation Falied','You Have Not Accepted Any Job Request',1);

    }
});
    });
    </script>
    <div class="footer">
        <p>Department of Computer Technology &copy; Madras Institute of Technology</p>
    </div>
</body>
</html>