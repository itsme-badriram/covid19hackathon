<?php
require_once('dbConnect.php');
require_once('functions.php');
if(!checkLogin()){
    header("Location: login"); }

    if(isset($_GET['logout'])){
        removeAll();
        header("Location: doctor");
    }
    if(isset($_SESSION['homepage']) && $_SESSION['homepage'] != 'doctor'){
        $homepage = $_SESSION['homepage'];
        header("Location: $homepage");
    
      }
$today = '2020-02-04';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Doctor | Covid</title>
    <link rel="stylesheet" href="menu.css">
         
    <link rel="stylesheet" href="doctor.css">
    <script src="jquery.js"></script><script src="alert.js"></script>
    <link rel="stylesheet" href="alert.css">
    <script src="osFinder.js"></script>
    
    <script src="menu.js"></script>
    <script src="canvasjs.min.js"></script>
    <script src="docGraph.js"></script>
    
    <script src="loader.js"></script>
    <link rel="stylesheet" href="loader.css">
</head>    
<script>
count = 0;

    $(document).ready(function(){
        $.post('doctorAction.php?patientAppointment=true',function(response){
            if(response == "")
            response = '<h2 class="filter-head"><span>You Do Not Have Any Appointment</span></h2>';

            document.getElementById('appointment-list').innerHTML = response;
        });
        $.post('doctorAction.php?patientSymptoms=true',function(response){
            if(response == "")
            response = '<h2 class="filter-head"><span>No Reports Available At The Moment</span></h2>';
            document.getElementById('coronasymptoms').innerHTML = response;
            getProgressBar();
        });

        $.post('doctorAction.php?getCount=true',function(response){
          
            document.getElementById('countPatient').innerHTML = response;
            count = parseInt(response);
            
        });
});

function cancelAppointment(id){
    confirmBox("Cancel Appointment...","Are you sure? This action cannot be redone!",
            function(){
                $.post('doctorAction.php?cancelAppointment=true&id='+id,function(response){

$.post('doctorAction.php?patientAppointment=true',function(response){
    if(response == "")
        response = '<h2 class="filter-head"><span>You Do Not Have Any Appointment</span></h2>';
document.getElementById('appointment-list').innerHTML = response;
count=count-1;
document.getElementById('countPatient').innerHTML = count;



});


});
            },
            function(){
                //window.location.href = "userStatus.html";
                console.log('No');
            }
 
            );

         /*   $.post('doctorAction.php?cancelAppointment=true&id='+id,function(response){

    $.post('doctorAction.php?patientAppointment=true',function(response){
        if(response == "")
            response = '<h2 class="filter-head"><span>You Do Not Have Any Appointment</span></h2>';
document.getElementById('appointment-list').innerHTML = response;
count=count-1;
document.getElementById('countPatient').innerHTML = count;



});


});

*/

}
</script>
<body>
         
    <?php  require_once('menubar.php'); ?>
    <div class="main">
        <div class="box appoint">
            <div class="app-head">
                <div>
                    <h2>Today's Appointments</h2>
                    <span class="curr-date">2020-02-04</span>
                    <span class="count" title="Today's Number of online Appointments"><div id="countPatient"></div></span>
                </div>
                <span class="app-icon"></span>
            </div>
            <div id="appointment-list">


            </div>
           
           
            
            
        </div>
        <div class="box report">
            <div class="report-box">
                <div class="rep-head">
                    <h2>Covid Symptoms Reports</h2>
                    <button onclick="report()">View More</button>
                </div>
                <div class="rep-box" id="coronasymptoms">
                    <div class="rep">
                        <h3>Ramanujan R
                            <span class="gender">M</span>
                        </h3>
                        <table>
                            <tr>
                                <th>Age of suspect</th>
                                <td>50 Yrs</td>
                            </tr>
                            <tr>
                                <th>Location</th>
                                <td>Nanganallur</td>
                            </tr>
                            <tr>
                                <th>Reported Time</th>
                                <td>02-05-2020</td>
                            </tr>
                        </table>
                        <div class="progress">
                            <h4>Probability : 
                                <span class="bar-value">85</span>%
                            </h4>
                            <span class="bar">
                                <span class="value"></span>
                            </span>
                        </div>
                        <div class="download">
                            <span class="down"></span>
                            <b>Download PDF</b>
                        </div>
                    </div>
                    <div class="rep">
                        <h3>Prabhakay R
                            <span class="gender">M</span>
                        </h3>
                        <table>
                            <tr>
                                <th>Age of suspect</th>
                                <td>30 Yrs</td>
                            </tr>
                            <tr>
                                <th>Location</th>
                                <td>Nesapakkam</td>
                            </tr>
                            <tr>
                                <th>Reported Time</th>
                                <td>07-05-2020</td>
                            </tr>
                        </table>
                        <div class="progress">
                            <h4>Probability : 
                                <span class="bar-value">45</span>%
                            </h4>
                            <span class="bar">
                                <span class="value"></span>
                            </span>
                        </div>
                        <div class="download">
                            <span class="down"></span>
                            <b>Download PDF</b>
                        </div>
                    </div>
                    <div class="rep">
                        <h3>Vignesh A
                            <span class="gender">M</span>
                        </h3>
                        <table>
                            <tr>
                                <th>Age of suspect</th>
                                <td>20 Yrs</td>
                            </tr>
                            <tr>
                                <th>Location</th>
                                <td>Avadi</td>
                            </tr>
                            <tr>
                                <th>Reported Time</th>
                                <td>08-05-2020</td>
                            </tr>
                        </table>
                        <div class="progress">
                            <h4>Probability : 
                                <span class="bar-value">65</span>%
                            </h4>
                            <span class="bar">
                                <span class="value"></span>
                            </span>
                        </div>
                        <div class="download">
                            <span class="down"></span>
                            <b>Download PDF</b>
                        </div>
                    </div>
                </div>
                <div class="suspect">
                    <div id="graph"></div>
                    <div class="side-box">
                        <div class="result" onclick="labResults()">
                            <span class="result-icon"></span>
                            <span class="res-text">
                                <h3>Lab Results</h3>
                                <p>Send the obtained lab results to patients!!</p>
                            </span>
                        </div>
                        <div class="record" onclick="patient()">
                            <span class="record-icon"></span>
                            <span class="rec-text">
                                <h3>View Records</h3>
                                <p>Check the up-to-date Appointment details!!</p>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer">
        <p>Department of Computer Technology &copy; Madras Institute of Technology</p>
    </div>
    <script>
        
        function report(){
            window.location.href = "docSuspect";
        }
        function patient(){
            window.location.href = "patient_records";
        }
        function labResults(){
            window.location.href = "docLab";
        }
    </script>
</body>
</html>