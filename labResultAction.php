<?php
require_once('dbConnect.php');
require_once('functions.php');

$folder_name = 'lab_result/';
$uname = $_SESSION['uname'];
$user = $_POST['to'];
$subject = $_POST['subject'];
$remarks = $_POST['remarks'];
$date = date('Y-m-d H:i:s');
$filename = md5(uniqid($date, true) * rand()) ;

if(!empty($_FILES))
{
$extension  = pathinfo( $_FILES["file"]["name"], PATHINFO_EXTENSION ); // jpg
$basename   = $filename . '.' . $extension; // 5dab1961e93a7_1571494241.jpg
 $temp_file = $_FILES['file']['tmp_name'];
 $location = $folder_name . $basename;
 move_uploaded_file($temp_file, $location);
}
$sql= "INSERT INTO labreport(`username`,`doc_id`,`file_name`,`remarks`,`date`,`subject`) VALUES ('$user','$uname','$filename','$remarks','$date','$subject')";
if(signUp($sql))
echo 'Success';
?>