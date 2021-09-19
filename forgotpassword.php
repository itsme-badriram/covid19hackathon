<?php
require_once('dbConnect.php');
$email="";
$user ="";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="menu.css">
         
    <link rel="stylesheet" href="request_items.css">

    <script src="jquery.js"></script><script src="alert.js"></script>
    <link rel="stylesheet" href="alert.css">
    <script src="osFinder.js"></script>
   
    <script src="menu.js"></script>
    
    <script src="loader.js"></script>
    <link rel="stylesheet" href="loader.css">
</head>
<body>
     
    <?php  require_once('menubar.php'); ?>
<?php
if(isset($_GET['getEmail'])){
    echo'
<div class="form-wrap" id="main-box">
        <div class="heading">
            <h2>Forgot Passord</h2>
            <div class="icon-wrap">
                <span class=""></span>
            </div>
        </div>
        <form id="requestform"><br>
        <select name="" id="login-select" title="Select type of user">
        <option value="General User">General User</option>
        <option value="Essential Worker">Essential worker</option>
        <option value="Volunteer">Volunteer</option>
        <option value="Doctor">Doctor</option>
        <!--<option value="Admin">Admin</option> -->
    </select>
            <input type="text" name="orgname" id="mailid" placeholder="Enter your Email Id"><br>
</form>
<div class="submit_button">
            <input type="button" onclick="onRequestSubmit()" value="Submit">
        </div>
</div>';
}
if(isset($_GET['email']) && isset($_GET['link'])){
    $email = $_GET['email'];
    $link = $_GET['link'];
    $sql = "SELECT * FROM forgotpassword WHERE email = '".$email."' AND link = '".$link."' ";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $user = $row['account_type'];
    $time = explode(':',$row['change_time']);
    
    $hours = (int)$time[0];
    $minutes = (int)$time[1];
    $new_minutes = ($minutes + 10)%60;
   
    $temp = (int)(($minutes + 10)/60);
   
    $hours = (int)($hours + $temp);
    if($hours < 10)
    $hours = '0'.strval($hours);
    if($new_minutes < 10)
    $new_minutes = '0'.strval($new_minutes);
    $change_time = strval($hours).':'.strval($new_minutes).':'.$time[2];
    $currtime = date('H:i:s');
   
   $start = strtotime($change_time);
$end = strtotime($currtime);
$mins = ($end - $start) / 60;

    if($mins <= 10){
        echo '
        <div class="form-wrap" id="main-box">
        <div class="heading">
            <h2>Forgot Password - Change Password</h2>
            <div class="icon-wrap">
                <span class=""></span>
            </div>
        </div>
        <form id="requestform"><br>
            <input type="password" name="pass" id="pass" placeholder="New Password"><br>
            <input type="password" name="confpass" id="confpass" placeholder="Confirm Password"><br>
</form>
<div class="submit_button">
            <input type="button" onclick="onChangePassword()" value="Submit">
        </div>
</div>';




    }
    else{
        echo 'Session Expired';
    }


}

?>

<script>
function onRequestSubmit(){


    var mail = document.getElementById('mailid').value;
    var user =  $("#login-select").find(":selected").text()[0];
    
    $.post('loginAction.php?checkUser=true',{
        mail: mail,
        user: user
    },function(response){
        if(response == 'S'){
        $.post('loginAction.php?forgotPassword=true&mail='+mail+'&user='+user,function(response){
        console.log(response);
        if(response == 'S')
        alertBox('Hi, '+mail,'We Have Sent a Verification Link to Your Mail, Follow the instructions. The Link will be valid for 10 minutes',2,'login');
        else if(response == 'F')
        alertBox('Hi, '+mail,'We Cannot Send Verification Link to Your Mail, Try Again Later.',1,'login');
    });
    

        }
        else if(response == 'F'){
            alertBox('Email And Account Type Does Not Match','',1);
        }



    });

   
}
function onChangePassword(){
    var mail = '<?php echo $email; ?>';
    var user = '<?php echo $user; ?>';
    $.post('loginAction.php?changePassword',{
        email: mail ,
        user: user,
        pass: document.getElementById('confpass').value,
    },function(response){
        alertBox(response,'Redirecting to Login Page',3,'login');

    });
}

</script>
<br><br>
    <div class="footer">
        <p>Department of Computer Technology &copy; Madras Institute of Technology</p>
    </div>
</body>
</html>