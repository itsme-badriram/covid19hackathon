<?php
require_once('dbConnect.php');
require_once('functions.php');
if(isset($_GET['getvideos'])){
$filter = "1";
if(isset($_GET['category'])){
    $category = $_GET['category'];
    $filter = "category='".$category."'";
}
$sql = "SELECT * FROM trainingvideo WHERE $filter";
$array = [];
$result = $conn->query($sql);
$k=0;
while($row = $result->fetch_assoc()){
    $array[$k] = $row['url'];
    $k = $k+1;

}


echo json_encode($array);
}
if(isset($_GET['addvideo'])){
    $category = $_POST['category'];
    $url = $_POST['url'];
    $sql = "INSERT INTO trainingvideo(`url`,`category`) VALUES ('$url','$category')";
    if(signUp($sql))
    echo "Successfully Added";

}
?>