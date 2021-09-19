<?php
require_once("dbConnect.php");
$filter = "1";
$table_name = "";
if(isset($_GET['type']) && $_GET['type']!="undefined"){
  $filter = "transportation='".$_GET['type']."' ";
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

$sql = "SELECT * FROM migrantworker WHERE $filter";
$result = $conn->query($sql);

header("Content-type: text/xml");
echo "<?xml version='1.0' ?>";
echo '<markers>';
$ind=0;
while($row = $result->fetch_assoc()) {
   
    //$address = $row[$type]." ".$row['street']." ".$row['area']." ".$row['city']." ".$row['state']." ".$row['pincode'];
    echo '<marker ';
    
    echo 'name="' . parseToXML($row['name']) . '" ';
    echo 'address="' . parseToXML($row['location']) . '" ';
    echo 'lat="' . $row['lat'] . '" ';
    echo 'lng="' . $row['lng'] . '" ';
   echo 'state="' . $row['state'] . '" ';
    echo 'city="' . $row['district'] . '" ';
   echo 'transportation="' . $row['transportation'] . '" ';
 echo 'food="' . $row['food'] . '" ';
    echo 'contact="' . $row['contact'] . '" ';
    echo 'place="' . $row['place_name'] . '" ';
    echo '/>';
    $ind = $ind + 1;

}
echo '</markers>';


?>