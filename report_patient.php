<?php require_once 'dbConnect.php';
require_once 'functions.php';
if(!checkLogin()){
  header("Location: login"); }

$symptomList = ["Fever","Tiredness","Dry cough","Aches and pains","Nasal congestion","Running Nose","Sore throat","Diarrhoea"];



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report Patient | Covid</title>
    <link rel="stylesheet" href="menu.css">
         
    <link rel="stylesheet" href="report_patient.css">
    <link rel="stylesheet" href="table.css">
    <script src="jquery.js"></script>
    <script src="alert.js"></script>
    <link rel="stylesheet" href="alert.css">
    <script src="osFinder.js"></script>
    <script src="reportPatient.js"></script>
    <script src="request_service.js"></script>
    <script src="menu.js"></script>
    
    <script src="loader.js"></script>
    <link rel="stylesheet" href="loader.css">
    
</head>
<body>
         
    <?php require_once('menubar.php'); ?>
    <div class="form-wrap" id="main-box">
        <h2>Report a patient with COVID-19 symptoms</h2>
        <div class="formReq">    
       
            <input name="pname" type="text" id="name" placeholder="Enter patient Name"><br>
            <div class="ageGen">
                <input type="number" name="" id="age" min="0" max="120" placeholder="Age">
                <div class="gen">
                    <div class="gender">
                        <span class="male"></span>
                        <span>Male</span>
                    </div>
                    <div class="gender">
                        <span class="female"></span>
                        <span>Female</span>
                    </div>
                    <div class="gender">
                        <span class="others"></span>
                        <span>Others</span>
                    </div>
                </div>
            </div>
            <h6><b>Note:</b> In case of Infant please enter the Age as 0</h6>
            <hr>
            <h3 id="symhead" class="barDiv">
                <span>Select all the symptoms that apply:</span>
                <span class="baricon" title="Click here to view commom corona symptoms">?</span>
            </h3>
            <h6 title="Please select the severity of the symptom for better analysis"><b>Note:</b> Kindly select the severity of the symptom too</h6>
            <div id="symptoms" class="symptoms">


            <?php
                    foreach($symptomList as $symptom ){
                        $new_str = str_replace(' ', '_', $symptom); 
                        echo '
                        <div>
                        <label for="'.$new_str.'">
                            <input type="checkbox" id="'.$new_str.'" name="'.$new_str.'" value="'.$new_str.'">'.$symptom.'
                        </label>
                        <span class="severeVal"></span>
                        <div class="severe">
                            <span class="sev-head">
                                <b>Severity</b>
                                <span class="backicon">&#8599;</span>
                            </span>
                            <ul>
                                <li class="level vh">Very High</li>
                                <li class="level h">High</li>
                                <li class="level m">Medium</li>
                                <li class="level l">Low</li>
                                <li class="level vl">Very Low</li>
                            </ul>
                        </div>
                    </div>
                    ';
                    }  
            ?>
            </div>
            <script> 
        function displayRadioValue() { 
            var ele = document.getElementsByName('exp'); 
              
            for(i = 0; i < ele.length; i++) { 
                if(ele[i].checked) 
                
                    return (ele[i].value); 
            } 
        } 
    </script> 
            <hr>
            <h3 id="symhead">How long have you been experiencing this?</h3>
            <div class="rad-exp">
                <label for="few">
                    <input type="radio" name="exp" id="few" value="Past few days">Past few days
                </label>
                <label for="last">
                    <input type="radio" name="exp" id="last" value="Since last week">Since last week
                </label>
                <label for="month">
                    <input type="radio" name="exp" id="month" value="For a month">For a month
                </label>
            </div>
            <hr>
            <h3 id="symhead">Current Medications (Optional) </h3>
            <h6><b>Note:</b>Only valid medications are considered</h6><br>
            <textarea name="" id="medication" cols="30" rows="10"></textarea>
            
            <h3 id="symhead">Past/Current conditions (Optional) </h3>
            <h6><b>Note:</b>Only valid conditions are considered</h6><br>
            <textarea name="" id="condition" cols="30" rows="10"></textarea>
            <br><br><hr>
            <h3 id="symhead">Location Details</h3>
            <input type="text" name="job_location" id="job_location"  placeholder="Patient Address"><br>
            <div id="map-all">
                <span id="mapShow" name="get_loc" onclick="getLocation(job_location.value)"></span>
                <div id="googleMap">
                </div>
            </div>
            <br>
            <input type="submit" value="Submit" id="reportSub">
            
        </div>
        <div class="symtable">
            <h3>Covid Symptoms and their Commonalities</h3>
            <table class="stable">
                <tr>
                    <th>Symptom</th>
                    <th>Commonality</th>
                </tr>
                <tr>
                    <td>Fever</td>
                    <td>
                        <span id="prog">
                            <span id="value" style="width: 87.9%;">87.9%</span>
                        </span>
                    </td>
                </tr>
                <tr>
                    <td>Dry cough</td>
                    <td>
                        <span id="prog">
                            <span id="value" style="width: 67.7%;">67.7%</span>
                        </span>
                    </td>
                </tr>
                <tr>
                    <td>Fatigue or Tiredness</td>
                    <td>
                        <span id="prog">
                            <span id="value" style="width: 38.1%;">38.1%</span>
                        </span>
                    </td>
                </tr>
                <tr>
                    <td>Runny Nose</td>
                    <td>
                        <span id="prog">
                            <span id="value" style="width: 33.4%;">33.4%</span>
                        </span>
                    </td>
                </tr>
                <tr>
                    <td>Shortness of breath</td>
                    <td>
                        <span id="prog">
                            <span id="value" style="width: 18.6%;">18.6%</span>
                        </span>
                    </td>
                </tr>
                <tr>
                    <td>Muscle or joint pain</td>
                    <td>
                        <span id="prog">
                            <span id="value" style="width: 14.8%;">14.8%</span>
                        </span>
                    </td>
                </tr>
                <tr>
                    <td>Sore Throat</td>
                    <td>
                        <span id="prog">
                            <span id="value" style="width: 13.9%;">13.9%</span>
                        </span>
                    </td>
                </tr>
                <tr>
                    <td>Headache</td>
                    <td>
                        <span id="prog">
                            <span id="value" style="width: 13.6%;">13.6%</span>
                        </span>
                    </td>
                </tr>
                <tr>
                    <td>Chills</td>
                    <td>
                        <span id="prog">
                            <span id="value" style="width: 11.4%;">11.4%</span>
                        </span>
                    </td>
                </tr>
                <tr>
                    <td>Nausea or vomiting</td>
                    <td>
                        <span id="prog">
                            <span id="value" style="width: 5%;">5%</span>
                        </span>
                    </td>
                </tr>
                <tr>
                    <td>Nasal Congestion</td>
                    <td>
                        <span id="prog">
                            <span id="value" style="width: 4.8%;">4.8%</span>
                        </span>
                    </td>
                </tr>
                <tr>
                    <td>Diarrhoea</td>
                    <td>
                        <span id="prog">
                            <span id="value" style="width: 3.7%;">3.7%</span>
                        </span>
                    </td>
                </tr>
            </table>
            <input type="button" value="Back" id="symback">
        </div>
    </div>
    <div class="footer">
        <p>Department of Computer Technology &copy; Madras Institute of Technology</p>
    </div>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC35zuevufB1F8oHJ-JwXJMHxc0k3fCbfE&libraries=geometry,places"
    async defer></script>
</body>
</html>
