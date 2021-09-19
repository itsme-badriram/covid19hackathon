<?php
require_once('dbConnect.php');
require_once('functions.php');
if(isset($_GET['products'])){
    $name = $_POST['name'];
    
    $phno = $_POST['phno'];
    $street = $_POST['streetname'];
    $door = $_POST['doorno'];
    $area = $_POST['areaname'];
    $city = $_POST['cityname'];
    $pincode = $_POST['pincode'];
    $state = $_POST['statename'];
    $lat = $_POST['lat'];
    $lng = $_POST['lng'];
    $id = $_POST['verifyid'];
    if($id == 'panid')
    $verify = 'pancard_no';
    else
    $verify = 'aadhar_no';
    $id = $_POST[$id];
    $splits = explode(';',$_POST['products']);
    foreach($splits as $split ){

        $product = explode(':',$split);
        $sql = "INSERT INTO msme(`name`,`contact`,`door`,`street`,`area`,`city`,`state`,`pincode`,`lat`,`lng`,`$verify`,`product`,`quantity`) VALUES ('$name',$phno,'$door','$street','$area','$city','$state',$pincode,$lat,$lng,$id,'$product[0]',$product[1])";
        echo $sql;
        signUp($sql);

    }
}
if(isset($_GET['migrant'])){
    $uname = $_SESSION['uname'];
    $lat = $_POST['lat'];
    $lng = $_POST['lng'];
    $trans = $_POST['transportation'];
    $food = $_POST['food'];
    $address = $_POST['address'];
    $place = $_POST['place'];
    if($trans == 'Yes'){
    $splits = explode(';',$_POST['str']);
    foreach($splits as $split ){
        $person = explode(':',$split);
        $sql = "INSERT INTO migrantworker(`uname`,`transportation`,`name`,`contact`,`state`,`district`,`food`,`location`,`lat`,`lng`,`place_name`) VALUES('$uname','$trans','$person[0]',$person[1],'$person[2]','$person[3]','$food','$address',$lat,$lng,'$place')";
        signUp($sql);
    }
}
else{
    $sql = "INSERT INTO migrantworker(`uname`,`transportation`,`food`,`location`,`lat`,`lng`,`place_name`) VALUES('$uname','$trans','$food','$address',$lat,$lng,'$place')";
    echo $sql;
    signUp($sql);
}
}
if(isset($_GET['patientAppointment'])){

    $uname = $_SESSION['uname'];
    $name = $_POST['name'];

    $guardian = $_POST['guardian'];
    $gender = $_POST['gender'];
    $contact = $_POST['contact'];
    $address = $_POST['address'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $weight = $_POST['weight'];
    $height = $_POST['height'];
    $age = $_POST['age'];
    $doc_id = $_POST['doc_id'];
    $sql = "INSERT INTO patienttable(`uname`,`guardian_name`,`gender`,`age`,`weight`,`height`,`contact`,`address`,`appointment_date`,`appointment_time`,`name`,`doc_id`,`status`) VALUES ('$uname','$guardian','$gender','$age','$weight','$height','$contact','$address','$date','$time','$name','$doc_id','Accepted')  ";

    signUp($sql);

    echo 'Success';



}
if(isset($_GET['donateItems'])){
    if(isset($_SESSION['uname']))
    $uname = $_SESSION['uname'];
    else
    $uname = "";
    $name = $_POST['name'];
    $contact = $_POST['contact'];
    $address = $_POST['address'];
    $food =  $_POST['food'];
    $cloth = $_POST['cloth']; 
    $hygiene = $_POST['hygiene'];
    $sql = "INSERT INTO donatesupply(`uname`,`name`,`contact`,`address`,`food_water`,`clothing`,`hygiene`) VALUES ('$uname','$name','$contact','$address','$food','$cloth','$hygiene') ";
    if(signUp($sql))
    echo "Donation Successfully Posted";

}
if(isset($_GET['requestItems'])){
    $uname = $_SESSION['uname'];
    $name = $_POST['name'];
    $orgname = $_POST['org_name'];
    $orgtype = $_POST['org_type'];
    $num = $_POST['num'];
    $contact = $_POST['contact'];
    $address = $_POST['address'];
    $trans = $_POST['transportation'];
    $food =  $_POST['food'];
    $cloth = $_POST['cloth']; 

    $sql = "INSERT INTO requestsupply(`uname`,`org_name`,`org_type`,`applicant_name`,`contact`,`address`,`num_of_people`,`food_water`,`clothing`,`transportation`) VALUES ('$uname','$orgname','$orgtype','$name',$contact,'$address',$num,'$food','$cloth','$trans')";

    if(signUp($sql))
    echo "Request Successfully Posted";


}
if(isset($_GET['nearestMedic'])){
$radius = 2;
if(isset($_POST['radius']))
$radius = $_POST['radius'];

$query = "pharmacy";
if(isset($_POST['query']))
$query = $_POST['query'];

echo json_encode(array($radius, $query));
}

if(isset($_GET['hospital'])){
    $uname = $_SESSION['uname'];
    $field = $_POST['fieldtype'];
    $name = $_POST['hospital_name'];
    $address = $_POST['address'];
    $lat = $_POST['lat'];
    $lng = $_POST['lng'];
    $sql = "INSERT INTO reporthospital(`uname`,`hospital_name`,`field_type`,`address`,`lat`,`lng`) VALUES ('$uname','$name','$field','$address',$lat,$lng)";
    if(signup($sql))
    echo "Reported Successfully";
    
    }
if(isset($_GET['patient'])){
    $date = date("Y-m-d H:i:s");
    $requestPayload = file_get_contents("php://input");
    $object = json_decode($requestPayload,true);
    $uname = $_SESSION['uname'];
    $gender = $object['gender'];
    $name = $object['name'];
    $age = $object['age'];
    $medication = $object['medication'];
    $condition = $object['condition'];
    $location = $object['location'];
    $period = $object['period'];
    $lat = $object['lat'];
    $lng = $object['lng'];
    $fever = $object['fever'];
    $tiredness = $object['tiredness'];
    $drycough = $object['drycough'];
    $ache = $object['aches_and_pains'];
    $nasal = $object['nasal_congestion'];
    $nose = $object['running_nose'];
    $sorethroat = $object['sore_throat'];
    $diarrhoea = $object['diarrhoea'];


   
    $level = array(
        "None" => 0,
        "Very Low" => 1,
        "Low" => 2,
        "Medium" => 3,
        "High" => 4,
        "Very High" => 5
    );
    

$w0 = 0;
$w1 = 0.88;//fever
$w2 = 0.38;//tiredness
$w3 = 0.67;//drycough
$w4 = 0.15;//aches and pains
$w5 = 0.05;//nasal congestion
$w6 = 0.33;//runny nose
$w7 = 0.14;//sore throat
$w8 = 0.04;//diarrhoea
//Assign x values between 0 and 5(not ticked to vey high)
$x0 = $age; //age
$x1 = $level[$object['fever']]; //fever
$x2 = $level[$object['tiredness']]; //tiredness
$x3 = $level[$object['drycough']]; //drycough
$x4 = $level[$object['aches_and_pains']]; //aches and pains
$x5 = $level[$object['nasal_congestion']]; //nasal congestion
$x6 = $level[$object['running_nose']]; //runny nose
$x7 = $level[$object['sore_throat']]; //sore throat
$x8 = $level[$object['diarrhoea']]; //diarrhoea
$x1 = $x1 /5; $x2 = $x2 /5; $x3 = $x3 /5; $x4 = $x4 /5; $x5 = $x5 /5; $x6 = $x6 /5; $x7 = $x7 /5; $x8 = $x8 /5;
if($x0<=10)
{
$w0=0.0418;
}
elseif($x0<=20)
{
$w0=0.0972;
}
elseif($x0<=30)
{
$w0=0.2192;
}
elseif($x0<=40)
{
$w0=0.2290;
}
elseif($x0<=50)
{
$w0=0.1633;
}
elseif($x0<=60)
{
$w0=0.1305;
}
elseif($x0<=70)
{
$w0=0.0870;
}
else
{
$w0=0.0315;
}
$y = ($w1*$x1)+($w2*$x2)+($w3*$x3)+($w4*$x4)+($w5*$x5)+($w6*$x6)+($w7*$x7)+($w8*$x8);
if($y > 0)
$y = $y + $w0;

$weight = tanh($y) * 100;
$weight = (int)$weight;

    $sql = "INSERT INTO patientreport(`uname`,`name`,`age`,`gender`,`fever`,`tiredness`,`drycough`,`ache`,`nasal_congestion`,`running_nose`,`sorethroat`,`diarrhoea`,`medication`,`past_condition`,`location`,`lat`,`lng`,`period`,`date`,`weightage`) VALUES('$uname','$name',$age,'$gender','$fever','$tiredness','$drycough','$ache','$nasal','$nose','$sorethroat','$diarrhoea','$medication','$condition','$location',$lat,$lng,'$period','$date',$weight)";
  
    signUp($sql);
    
    $sql = "SELECT patient_id from patientreport WHERE uname = '".$uname."' AND date = '".$date."'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

echo json_encode(array($row['patient_id'],$uname));

}
?>