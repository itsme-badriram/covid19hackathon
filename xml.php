<?php
require_once("dbConnect.php");
$filter = "1";
$table_name = "";
if(isset($_GET['table_name']) && isset($_GET['type'])){
    $table_name = $_GET['table_name'];
    $type = $_GET['type'];
}
if(isset($_GET['field']) && $_GET['field']!="undefined"){
    $filter = "field='".$_GET['field']."' ";
}
function parseToXML($htmlStr)
{
$xmlStr=str_replace('<','&lt;',$htmlStr);
$xmlStr=str_replace('>','&gt;',$xmlStr);
$xmlStr=str_replace('"','&quot;',$xmlStr);
$xmlStr=str_replace("'",'&#39;',$xmlStr);
$xmlStr=str_replace("&",'&amp;',$xmlStr);
return $xmlStr;
}

$sql = "SELECT * FROM $table_name WHERE $filter";
$result = $conn->query($sql);

header("Content-type: text/xml");
echo "<?xml version='1.0' ?>";
echo '<markers>';
$ind=0;
while($row = $result->fetch_assoc()) {
    if($row['email'] != $_SESSION['uname']){
    $address = $row[$type]." ".$row['street']." ".$row['area']." ".$row['city']." ".$row['state']." ".$row['pincode'];
    echo '<marker ';
    echo 'id="' . parseToXML($row['email']) . '" ';
    echo 'name="' . parseToXML($row['name']) . '" ';
    echo 'address="' . parseToXML($address) . '" ';
    echo 'lat="' . $row['lat'] . '" ';
    echo 'lng="' . $row['lng'] . '" ';
    echo 'field="' . $row['field'] . '" ';
    echo 'contact="' . $row['contact'] . '" ';
    echo '/>';
    $ind = $ind + 1;
}
}
echo '</markers>';


?>