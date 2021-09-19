<?php
require_once('dbConnect.php');
require_once('functions.php');

if(isset($_GET['changePassword'])){
    $options = array('cost' => 10);
    $pass = password_hash($_POST['password'],PASSWORD_BCRYPT,$options);
    $table_name = $_SESSION['table_name'];
    $uname = $_SESSION['uname'];
    $sql = "UPDATE $table_name SET password = '".$pass."' WHERE email= '".$uname."' ";
    if(signUp($sql))
    echo "Password Updated Successfully";
}

if(isset($_GET['changeValue'])){
    $uname = $_SESSION['uname'];
    $table_name = $_SESSION['table_name'];
    $key = $_POST['key'];
    $value = $_POST['value'];
    $sql = "UPDATE $table_name SET $key = '".$value."' WHERE email = '".$uname."'";
    if(signUp($sql))
    echo "Successfully Updated";

}



if(isset($_GET['changeAddress'])){
    $home = "apartment";
    if($_SESSION['table_name'] == 'doctor' )
    $home = 'hospital_name';
    else if($_SESSION['table_name'] == 'essentialworker')
    $home = 'shop_name';
    $uname = $_SESSION['uname'];
    $flat = $_POST['no'];
    $street = $_POST['street'];
    $area = $_POST['area'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $lat = $_POST['lat'];
    $lng = $_POST['lng'];
    $table_name = $_SESSION['table_name'];
    $sql = "UPDATE $table_name SET $home = '".$flat."', street = '".$street."',area = '".$area."',city= '".$city."',state= '".$state."', lat = $lat , lng = $lng  WHERE email= '".$uname."' ";
   
    if(signUp($sql))
    echo "Address Updated Successfully";


}

?>