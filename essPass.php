<?php
require_once('dbConnect.php');
require_once('functions.php');
$jobid = 0;
$uname = 'none';
if(!checkLogin()){
    header("Location: login"); }
if($_SESSION['homepage'] != 'essentialWorkerPage'){
    $homepage = $_SESSION['homepage'];
    header("Location: $homepage");
}

$uname = $_SESSION['uname'];
$sql = "SELECT aadhar_no,name,shop_name,street,area,city,state,field,pincode FROM essentialworker WHERE email ='".$uname."'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$id = $row['aadhar_no'];
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
                    $job_location =$row['shop_name']."\n ".$row['street']."\n ".$row['area']."\n ".$row['city']."\n ".$row['state']."\n ".$row['pincode'];

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
                    <input type="text" name="" id="" value='<?php echo $row['field'];  ?>' disabled> 
                </label><br>
            </div>
        </div>
    </div><br><br>
    <script>
        $(document).ready(function(){


           
            
        $(document).on('click','#qrwrap',function(){


            
            var username = '<?php  echo $uname; ?>';

var id = '<?php  echo $id; ?>';
var qrcode = {
    username : username,
    aadhar_no : id
    
};
           
            /*Implement your php condition here*/
            new QRCode(document.getElementById("qrcode"), JSON.stringify(qrcode));
            $("#qrcode").attr('title',"");
            $("#qrwrap").hide();
        
});
    });
    </script>
    <div class="footer">
        <p>Department of Computer Technology &copy; Madras Institute of Technology</p>
    </div>
</body>
</html>