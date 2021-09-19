<?php require_once 'dbConnect.php';
require_once 'functions.php';
if(!checkLogin()){
  header("Location: login"); }
 
$field="";  
if(isset($_GET['field'])){
    $field = $_GET['field'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Volunteer Service | Covid</title>
    <link rel="stylesheet" href="menu.css">
         
    <link rel="stylesheet" href="request_service.css">
    
    <script src="jquery.js"></script><script src="alert.js"></script>
    <link rel="stylesheet" href="alert.css">
    <script src="osFinder.js"></script>
    <script src="menu.js"></script>
    <script src="request_service.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.0.js" integrity="sha256-r/AaFHrszJtwpe+tHyNi/XCfMxYpbsRg2Uqn0x3s2zc=" crossorigin="anonymous"></script>
    
    <script src="loader.js"></script>
    <link rel="stylesheet" href="loader.css">
</head>
<body>
         
    <?php  require_once('menubar.php'); ?>
    <div class="form-wrap" id="main-box">
        <div class="heading">
            <h2>Request Volunteer assistance</h2>
            <span class="request-icon"></span>
        </div>
        <div class="formReq">
            <form id="form">
            <label for="job_title">
                <span class="text">Enter Job Title:</span> 
                <input type="text" name="job_title" id="job_title" placeholder="Title">
            </label>
            <label>
                <span class="text">Enter Job Description:</span>
                <textarea name="job_desc" id="job_desc" placeholder="Description"></textarea>
            </label>
            <label for="job_location">
                <span class="text">Enter Job Location:</span> 
                <input type="text" id="job_location" name="job_location" placeholder="Location">
            </label>

            <div id="mapAll">
                <span id="mapShow" name="get_loc" onclick = "getLocation(job_location.value)"></span>
                <div id="googleMap">
                </div>
            </div>

            <label for="no_of_volunteers">
                <span class="text">Enter no. of volunteers needed for the job</span>
                <input type="number" name="no_of_volunteers" id="nov">
            </label>
            <label for="field">
                <span class="text">Select field of volunteering required</span>
                <select id="field" name="field">
                    <option value="" disabled <?php if($field == "") echo 'selected'; ?> >Select Field</option>
                    <option value="health" <?php if($field == "Health") echo 'selected'; ?>>Health</option>
                    <option value="communication" <?php if($field == "Communication") echo 'selected'; ?>>Communication</option>
                    <option value="entrepreneurial" <?php if($field == "Entrepreneurial") echo 'selected'; ?>>Entrepreneurial</option>
                </select>
            </label>
            <label for="activity">
                <span class="text">Select type of volunteering activity:</span>
                <select id="activity">
                    <option value="" disabled selected>Select Activity</option>
                </select>
            </label>
            <input type="submit"  value="Post Request">
            </form>
        </div>

    </div><br>
    <div class="footer">
        <p>Department of Computer Technology &copy; Madras Institute of Technology</p>
    </div>
    <script>


        $(document).ready(function () {
            var type = $("#field").find(":selected").text();
            if(type == 'Health'){
                $("#activity").html("<option value='donate'>Donate medical equipment</option> <option value='paramedic'>Paramedic</option> <option value='pac'>Infection Prevention and Control</option> <option value='assist'>Assisting Primary Healthcare workers</option> <option value='elderly'>Helping elderly and those in need</option> <option value='dead'>Dead Body Management</option> <option value='transport'>Transportation of Patients</option>");

            }
            else if(type == 'Communication'){
                $("#activity").html("<option value='hygiene'> Public awareness on hygiene practices </option> <option value='promote'> Promote Social Distancing Measures </option> <option value='awareness'> Community level Awareness Campaigns </option> <option value='helplines'> Manning of helplines </option> ");

            }
            else if(type=='Entrepreneurial'){
                $("#activity").html("<option value='prod'> Assisting in production of medical essentials </option> <option value='it'> IT based solutions </option> <option value='logistics'> Logistics </option> ");
            }



    $("#field").change(function () {
        var val = $(this).val();
        if (val == "health") {
            $("#activity").html("<option value='donate'>Donate medical equipment</option> <option value='paramedic'>Paramedic</option> <option value='pac'>Infection Prevention and Control</option> <option value='assist'>Assisting Primary Healthcare workers</option> <option value='elderly'>Helping elderly and those in need</option> <option value='dead'>Dead Body Management</option> <option value='transport'>Transportation of Patients</option>");
        } else if (val == "communication") {
            $("#activity").html("<option value='hygiene'> Public awareness on hygiene practices </option> <option value='promote'> Promote Social Distancing Measures </option> <option value='awareness'> Community level Awareness Campaigns </option> <option value='helplines'> Manning of helplines </option> ");
        } else if (val == "entrepreneurial") {
            $("#activity").html("<option value='prod'> Assisting in production of medical essentials </option> <option value='it'> IT based solutions </option> <option value='logistics'> Logistics </option> ");
        }
    });
});

    
    $('#form').submit(function(e){
            e.preventDefault();
            var formData = new FormData(this);
                var conceptName = $('#field').find(":selected").text();
                var conceptType = $('#activity').find(":selected").text();
                var marker = returnMarker();
                var lat = marker.getPosition().lat();
                var lng = marker.getPosition().lng();
                console.log(conceptName,conceptType);
                var jobid;
                var points = [];
                    $.post("requestServiceAction.php?requestStatus=true",{
                    job_title: document.getElementById("job_title").value,
                    job_desc: document.getElementById("job_desc").value,   
                    lat: lat,
                    lng : lng,
                    field: conceptName,
                    type: conceptType,  
                    nov: document.getElementById("nov").value,
                    job_location: document.getElementById("job_location").value 
                        
                    },
                    function(response,status,http){
                        jobid=response;
                        alertBox("Requested Succefully",'',2);
                    });


    $("#form").trigger("reset");

});


    </script>



    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC35zuevufB1F8oHJ-JwXJMHxc0k3fCbfE&libraries=geometry,places"
    async defer></script>
</body>
</html>