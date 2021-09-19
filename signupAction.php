<?php
    require_once 'dbConnect.php';
    require_once 'functions.php'; 

    if(isset($_GET['G'])){
        $requestPayload = file_get_contents("php://input");
        $object = json_decode($requestPayload,true);
        $email = $object['email'];
        $name = $object['name'];
        $contact = $object['contact'];
        $options = array('cost' => 10);
        $pass = password_hash($object['pass'],PASSWORD_BCRYPT,$options);
        $apartment = $object['flat'];
        $street= $object['street'];
        $state =  $object['state'];
        $area = $object['town'];
        $lat = $object['lat'];
        $lng= $object['lng'];
        $city = $object['city'];
        $pin = $object['pin'];
        $sql = "INSERT INTO users VALUES('$email',$contact,'G')";
        if(signUp($sql))
        {
            $sql = "INSERT INTO generaluser(`email`,`password`,`name`,`contact`,`apartment`,`street`,`area`,`state`,`city`,`lat`,`lng`,`pincode`) VALUES ('$email','$pass','$name','$contact','$apartment','$street','$area','$state','$city',$lat,$lng,$pin)";
            if(signUp($sql))
            { $uname = $email;
                
                $homepage = "generalUser";
                $table_name = 'generaluser';
                $check="SELECT * FROM $table_name WHERE email= ?";
                $var = setSession($uname,$check,$homepage,$table_name);
                if($var){
                    echo $homepage;

                }
            }
        }

        
        
    }
    if(isset($_GET['V'])){
        $requestPayload = file_get_contents("php://input");
        $object = json_decode($requestPayload,true);
        $email = $object['email'];
        $name = $object['name'];
        $contact = $object['contact'];
        $options = array('cost' => 10);
        $pass = password_hash($object['pass'],PASSWORD_BCRYPT,$options);
        $aadhar = $object['aadhar'];
        $field = $object['field'];
        $experience = $object['experience'];
        $apartment = $object['flat'];
        $street= $object['street'];
        $state =  $object['state'];
        $area = $object['town'];
        $lat = $object['lat'];
        $lng= $object['lng'];
        $city = $object['city'];
        $pin = $object['pin'];
        $sql = "INSERT INTO users VALUES('$email',$contact,'V')";
        if(signUp($sql))
        {
            $sql = "INSERT INTO volunteer(`email`,`password`,`name`,`contact`,`apartment`,`street`,`area`,`state`,`city`,`lat`,`lng`,`pincode`,`field`,`experience`,`aadhar_no`) VALUES ('$email','$pass','$name','$contact','$apartment','$street','$area','$state','$city',$lat,$lng,$pin,'$field','$experience',$aadhar)";
            if(signUp($sql))
            { $uname = $email;
                $homepage = "volunteerPage";
                $table_name = 'volunteer';
                $check="SELECT * FROM $table_name WHERE email= ?";
                $var = setSession($uname,$check,$homepage,$table_name);
                if($var){
                    echo $homepage;

                }
            }
        }
        
        
        
    }
    if(isset($_GET['D'])){
        $requestPayload = file_get_contents("php://input");
        $object = json_decode($requestPayload,true);
        $email = $object['email'];
        $name = $object['name'];
        $contact = $object['contact'];
        $options = array('cost' => 10);
        $pass = password_hash($object['pass'],PASSWORD_BCRYPT,$options);
        $aadhar = $object['aadhar'];
        $degree = $object['degree'];
        $specialization = $object['special'];
        $working_at = $object['flat'];
        $street= $object['street'];
        $state =  $object['state'];
        $area = $object['town'];
        $lat = $object['lat'];
        $lng= $object['lng'];
        $city = $object['city'];
        $pin = $object['pin'];
        $hours = $object['working_hours'];
        $sql = "INSERT INTO users VALUES('$email',$contact,'D')";
        if(signUp($sql))
        {
            $sql = "INSERT INTO doctor(`email`,`password`,`name`,`contact`,`hospital_name`,`street`,`area`,`state`,`city`,`lat`,`lng`,`pincode`,`qualification`,`specialization`,`aadhar_no`,`working_hours`) VALUES ('$email','$pass','$name','$contact','$working_at','$street','$area','$state','$city',$lat,$lng,$pin,'$degree','$specialization',$aadhar,'$hours')";
            
            if(signUp($sql))
            {   $uname = $email;
                $homepage = "doctor";
                $table_name = 'doctor';
                $check="SELECT * FROM $table_name WHERE email= ?";
                $var = setSession($uname,$check,$homepage,$table_name);
                
                if($var){
                    echo $homepage;

                }
            }
        }
        
        
        
    }
    if(isset($_GET['E'])){
        $requestPayload = file_get_contents("php://input");
        $object = json_decode($requestPayload,true);
        $email = $object['email'];
        $name = $object['name'];
        $contact = $object['contact'];
        $options = array('cost' => 10);
        $pass = password_hash($object['pass'],PASSWORD_BCRYPT,$options);
        $aadhar = $object['aadhar'];
        $field = $object['type'];
        
        $apartment = $object['flat'];
        $street= $object['street'];
        $state =  $object['state'];
        $area = $object['town'];
        $lat = $object['lat'];
        $lng= $object['lng'];
        $city = $object['city'];
        $pin = $object['pin'];
        $sql = "INSERT INTO users VALUES('$email',$contact,'E')";
        if(signUp($sql))
        {
            $sql = "INSERT INTO essentialworker(`email`,`password`,`name`,`contact`,`shop_name`,`street`,`area`,`state`,`city`,`lat`,`lng`,`pincode`,`field`,`aadhar_no`) VALUES ('$email','$pass','$name','$contact','$apartment','$street','$area','$state','$city',$lat,$lng,$pin,'$field',$aadhar)";
            if(signUp($sql))
            { $uname = $email;
                $homepage = "essentialWorkerPage";
                $table_name = 'essentialworker';
                $check="SELECT * FROM $table_name WHERE email= ?";
                $var = setSession($uname,$check,$homepage,$table_name);
                if($var){
                    echo $homepage;

                }
            }
        }
        
        
        
    }

?>