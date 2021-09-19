<?php require_once 'dbConnect.php';?>
<?php require_once 'functions.php';?>
<?php 
if(isset($_GET['login'])){
    $uname = $_POST['uname'];
    $temp = $_POST['pass'];
    $table_name = $_POST['table_name'];
    //$table_name = "generalusertable";
    $username = $_POST['username'];
    $sql = "SELECT * FROM $table_name where $username = ?";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt,$sql);
    mysqli_stmt_bind_param($stmt,"s",$uname);
    mysqli_stmt_execute($stmt);
    $result =mysqli_stmt_get_result($stmt);
    
    if(!$result || mysqli_num_rows($result)==0){
        //Not Registered
       
    }
    else{
        $user=mysqli_fetch_array($result);
        $pass = $user['password'];
        if(password_verify($temp,$pass)){
            $check="SELECT * FROM $table_name WHERE $username= ?";
            
           
            if(strcmp($table_name,"generaluser") == 0)
            $homepage = "generalUser";
            else if(strcmp($table_name,"volunteer") == 0)
            $homepage = "volunteerPage";
            else if(strcmp($table_name,"essentialworker") == 0)
            $homepage = "essentialWorkerPage";

            else if(strcmp($table_name,"doctor") == 0)
            $homepage = "doctor";

            $var = setSession($uname,$check,$homepage,$table_name);
            if($var){
                echo $homepage;

            }
        }
        else{
            //Enter Correct Password
        }
    }
}

if(isset($_GET['checkUser'])){
    $mail = $_POST['mail'];
    $user = $_POST['user'];
    $sql = "SELECT * FROM users WHERE email = '".$mail."' AND account_type = '".$user."'";
    $result = $conn->query($sql);
    if(!$result || mysqli_num_rows($result) == 0){
        echo 'F';
    }
    else
     echo 'S';
}
if(isset($_GET['changePassword'])){
    $options = array('cost' => 10);
    $pass = password_hash($_POST['pass'],PASSWORD_BCRYPT,$options);
    $user = $_POST['user'];
    if($user == 'G')
    $table_name = 'generaluser';
    else if($user == 'V')
    $table_name = 'volunteer';
    else if($user == 'E')
    $table_name = 'essentialworker';
    else if($user == 'D')
    $table_name = 'doctor';
    $uname = $_POST['email'];
    $sql = "UPDATE $table_name SET password = '".$pass."' WHERE email= '".$uname."' ";
    if(signUp($sql))
    echo "Password Updated Successfully";
}
if(isset($_GET['forgotPassword'])){

    function crypto_rand_secure($min, $max) {
        $range = $max - $min;
        if ($range < 0) return $min; // not so random...
        $log = log($range, 2);
        $bytes = (int) ($log / 8) + 1; // length in bytes
        $bits = (int) $log + 1; // length in bits
        $filter = (int) (1 << $bits) - 1; // set all lower bits to 1
        do {
            $rnd = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes)));
            $rnd = $rnd & $filter; // discard irrelevant bits
        } while ($rnd >= $range);
        return $min + $rnd;
}

function getToken($length=32){
    $token = "";
    $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $codeAlphabet.= "abcdefghijklmnopqrstuvwxyz";
    $codeAlphabet.= "0123456789";
    for($i=0;$i<$length;$i++){
        $token .= $codeAlphabet[crypto_rand_secure(0,strlen($codeAlphabet))];
    }
    return $token;
}
    require 'phpmailer/PHPMailerAutoload.php';

    $date = date('Y-m-d_H:i:s');
    $time = date('H:i:s');
    $link = getToken() ;
    $link = $link.'_'.$date;
    $email = $_GET['mail'];
    $user = $_GET['user'];
    $sql = "INSERT INTO forgotpassword VALUES('$email','$link','$time','$user') ";
    
    $mail = new PHPMailer;
    //$mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->Port=587;
    $mail->SMTPAuth=true;
    $mail->SMTPSecure='tls';
    $mail->Username='team@covid19alert.tech';
    //$mail->Username='covidalert05@gmail.com';
    //$mail->Password='Mit!@#123';
    $mail->Password='Pass$123456';
    $mail->setFrom('team@covid19alert.tech','Covid19Alert Team');
    $mail->addAddress($email);
    $mail->isHTML(true);
    $mail->Subject='Change Password Instructions';
     $ref = 'https://www.covid19alert.tech/Covid19Nagaland/forgotpassword?email='.$email.'&link='.$link;
     //http://localhost/covid19Nagaland
     //$ref = 'http://localhost/covid19alert.tech/Covid19Sikkim/forgotpassword?email='.$email.'&link='.$link;
    $mail->Body='Greetings, Go to this link to change your password...<a href="'.$ref.'">Click Here</a>';
    if($mail->send()){
        if(signUp($sql))
            echo 'S';
    }
    else
       
    {echo 'F';
        
    }
    }


    ?>