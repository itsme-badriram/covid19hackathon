<?php
require_once('dbConnect.php');
require_once('functions.php');
if(isset($_GET['getCount'])){
    $today = '2020-02-04';
    $uname = $_SESSION['uname'];
    $sql = "SELECT count(*) AS num FROM patienttable WHERE appointment_date = '".$today."' AND status='Accepted' AND doc_id = '".$uname."'";
$result = $conn->query($sql);
$CountRes = $result->fetch_assoc();
$count = $CountRes['num'];
echo $count;
}
if(isset($_GET['cancelAppointment'])){

    $id = $_GET['id'];
    $sql = "UPDATE patienttable SET status = 'Cancelled' WHERE patient_id = $id";
    if(signUp($sql));
    echo 'Cancelled Appointment';
    
}
if(isset($_GET['patientSymptomsFilter'])){
    $filter = "weightage";
    if(isset($_GET['filter'])){
        $filter = $_GET['filter'];
    }

    $sql = "SELECT * FROM patientreport ORDER BY $filter DESC";
    $result = $conn->query($sql);
 
    while($row = $result->fetch_assoc()){
        $filename = $row['name'].'_'.$row['patient_id'].'.pdf';
        
        echo '
        <div class="report">
        <div class="details">
            <h3>'.$row['name'].'</h3>
            <span class="gender">
                <b>'.ucfirst($row['gender'][0]).'</b>
            </span>
            <span class="age">'.$row['age'].' Yrs</span><br>
            <span class="time">'.explode(' ',$row['date'])[0].'</span>
            <div class="download">
                <span class="down"></span>
                <form id="downloadpdf" action="embedpdf" method="post">
                <input type="text" name="name" value="patient_report/'.$row['name'].'_'.$row['patient_id'].'" hidden>
                <input type="submit" name="download"><a><b>Download PDF</b></a>
                </form>
            </div>
        </div>
        <div class="progress">
            <h4>Probability : 
                <span class="bar-value">'.$row['weightage'].'</span>%
            </h4>
            <span class="bar">
                <span class="value"></span>
            </span>
        </div>
    </div>
        ';
    }


}

if(isset($_GET['patientSymptoms'])){
    $sql = "SELECT * FROM patientreport ORDER BY weightage DESC LIMIT 3";
    $result = $conn->query($sql);
 
    while($row = $result->fetch_assoc()){
        $filename = $row['name'].'_'.$row['patient_id'].'.pdf';
echo '
        <div class="rep">
                        <h3>'.$row['name'].'
                            <span class="gender">'.ucfirst($row['gender'][0]).'</span>
                        </h3>
                        <table>
                            <tr>
                                <th>Age of suspect</th>
                                <td>'.$row['age'].' Yrs</td>
                            </tr>
                            <tr>
                                <th>Location</th>
                                <td>'.$row['location'].'</td>
                            </tr>
                            <tr>
                                <th>Reported Time</th>
                                <td>'.explode(' ',$row['date'])[0].'</td>
                            </tr>
                        </table>
                        <div class="progress">
                            <h4>Probability : 
                                <span class="bar-value">'.$row['weightage'].'</span>%
                            </h4>
                            <span class="bar">
                                <span class="value"></span>
                            </span>
                        </div>
                        <div class="download">
                            <span class="down"></span>
                            <a href="patient_report/'.$filename.'" style="text-decoration: none; color:white"><b>Download PDF</b></a>
                        </div>
                    </div>
                    ';

    }
}
if(isset($_GET['patientAppointment'])){

    $uname = $_SESSION['uname'];
    $sql = "SELECT * FROM patienttable WHERE appointment_date='2020-02-04' AND doc_id = '".$uname."' AND status = 'Accepted' ORDER BY appointment_time ASC";
    $result = $conn->query($sql);
 
    while($row = $result->fetch_assoc()){
        echo'
        <div class="app-box">
                <div class="pat">
                    <span class="pat-name">'.$row['name'].'</span>
                    <div class="cont">
                        <span class="pat-id">ID:'.$row['patient_id'].'</span>
                        <span class="contact"></span>
                        <a href="tel:+91'.$row['contact'].'">'.$row['contact'].'</a>
                    </div>
                    <div class="details">
                        <span class="gender">'.$row['gender'][0].'</span>
                        <span class="age">'.$row['age'].' Yrs</span>
                        <span class="height"></span>
                        <span class="height-value">'.$row['height'].'cm</span>
                        <span class="weight"></span>
                        <span class="weight-value">'.$row['weight'].'kg</span>    
                    </div>
                </div>
                <div class="timing">
                    <h3>'.$row['appointment_time'].'</h3>
                    <span class="cancel" title="Cancel Appointment" onclick="cancelAppointment('.$row['patient_id'].')" >X</span>
                </div>
            </div>
            ';
    }
}


?>