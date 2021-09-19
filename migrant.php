<?php
require_once 'dbConnect.php';
require_once 'functions.php';
if(!checkLogin()){
  header("Location: login"); }

  if(isset($_SESSION['homepage']) && $_SESSION['homepage'] != 'volunteerPage'){
    $homepage = $_SESSION['homepage'];
    header("Location: $homepage");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Migrant Labour Help | Covid</title>
    <link rel="stylesheet" href="menu.css">
         
    <link rel="stylesheet" href="migrant.css">
    
    <script src="jquery.js"></script><script src="alert.js"></script>
    <link rel="stylesheet" href="alert.css">
    <script src="osFinder.js"></script>
    <script src="request_service.js"></script>
    <script src="menu.js"></script>
   
    <script src="loader.js"></script>
    <link rel="stylesheet" href="loader.css">
</head>
<body>
         
    <?php  require_once('menubar.php'); ?>
    <div class="form-wrap" id="main-box">
        <h2 class="main-title">
            <span>Migrant Labour Help Form</span>
            <span class="mig-icon"></span>
        </h2>  
        <div class="nearloc">
            <span class="warn-icon"></span>
            <p>
                <b>Nearby Shelters</b>
                <span>Click to view the nearby shelters for migrant labourers!</span>
            </p>
            <a href="migrantMapDisplay"><input type="button" value="View in Map"></a>
        </div><hr>
        
        <div class="formEmer">
        <h3 class="loc-head">Place Name</h3>
            <input type="text" name="" id="place" placeholder="Enter the place name">
            
            <h3 class="loc-head">Current Location Details</h3>
            <input type="text" name="" id="location" placeholder="Enter the Address">
            <div id="mapAll">
                <span id="mapShow" onclick="addLocation()"></span>
                <div id="googleMap">
                </div>
            </div>
            <h5 class="note"><b>Note : </b>Drop the marker in your location</h5><br><hr>
            <h3>Emergency Form</h3>
            <p>Do you require Transportation to your home state?</p> 
            <span style="font-size: 0.75em;"> <b>Note : </b>Report Labour Shelter with Transportation: No</span> 
            <div class="radioclass">
                <input type="radio" id="transport_yes" name="transport" value="Yes" onclick="onTransportRadio('Yes')"><label for="transport_yes">Yes</label><br>
                <input type="radio" id="transport_no"  name="transport" value="No" onclick="onTransportRadio('No')" checked><label for="transport_no">No</label><br>
            </div>
            <div class="transportexpand" id="transportexpand">
                <h3>Enter details to apply for transportation</h3>
                <div class="persons" id="persons">
                    <div class="form-wrap person" id="person1">
                        <input type="text" placeholder="Enter your Name" id="name1" required>
                        <input type="text" placeholder="Enter contact number" id="phone1" pattern="[0-9]{10}">
                        <input type="text" placeholder="Enter your home state" required id="state1">
                        <input type="text" placeholder="Enter the city to which you belong to" required id="district1">
                    </div>
                </div>
                <div style="text-align: center;">
                    <input type="button" value=" + Add another person" onclick="appendRow()">
                </div>
                
            </div>  
            <p>Do you require Emergency food packets?</p>
            <div class="radioclass">
                <input type="radio" id="foodpackets_yes" name="foodpackets" onclick="onFoodRadio('Yes')" value="Yes"><label for="foodpackets_yes">Yes</label><br>
                <input type="radio" id="foodpackets_no" name="foodpackets" onclick="onFoodRadio('No')" value="No" checked><label for="foodpackets_no">No</label><br>
            </div>
           <!-- <div class="foodpacketsexpand" id="foodpacketsexpand">
                <input type="number" name="foodpackets_quantity" placeholder="Enter number of food packets required">
            </div> -->
            <div class="submit_button">
                <input type="button" onclick="onSubmit()" value="Submit">
            </div>
        </div>
    </div><br><br>
    <div class="footer">
        <p>Department of Computer Technology &copy; Madras Institute of Technology</p>
    </div>
    <script>
function onSubmit(){
  
    var result = $(".form-wrap").find(":input[type=text]");
    var k=0;
    
    var str="";
    result.each(function(i){
        var id = $(this).attr('id');
        if(id!='location' && id!='place')
        {
        str+=result[i].value+':';
        k++;
        if(k==4){
            str=str.substring(0,str.length-1);
            str+=';';
            k=0;
        }
    }
    });
    var place = document.getElementById('place').value;
    var marker = returnMarker();
    var lat = marker.getPosition().lat();
                var lng = marker.getPosition().lng();
    str=str.substring(0,str.length-1);
    console.log(address,str,transportation,food);
    $.post('reportAction.php?migrant=true',{
        place: place,
        address: address,
        transportation: transportation,
        str: str,
        food:food,
        lat: lat,
        lng: lng
    },function(response){
        console.log(response);
        alertBox('Successfully Reported!','',2,'migrant');

    });

}
 var transportation = 'No'; var food= 'No';
        function onTransportRadio(radio){
            transportation = radio;
        }
        function onFoodRadio(radio){
            food = radio;
        }
        function addLocation(){
             address = document.getElementById('location').value;
            getLocation(address);
        }
        var x=2;var address;
        function appendRow()
        {
       

        $( ".persons" ).append( '<div class="form-wrap person" class="person" id="person'+x+'"><hr><h4>Another Person details</h4>  <input type="text" placeholder="Enter you Name" name="name'+x+'" required> <input type="text" placeholder="Enter contact number" name="phone'+x+'" pattern="[0-9]{10}"> <input type="text" placeholder="Enter your home state" required name="state'+x+'"> <input type="text" placeholder="Enter the district to which you belong to" required name="district'+x+'"> <br> <button type="button" id="remove">Remove person</button> </div>' );
        x++;
        }   
        $(document).ready(function() {
            $("#foodpackets_yes").click(function() {
                    $("#foodpacketsexpand").slideDown();
            });
            $("#foodpackets_no").click(function() {
                    $("#foodpacketsexpand").slideUp();
            });
        });
        $(document).ready(function() {
            $("#transport_yes").click(function() {
                    $("#transportexpand").slideDown();
            });
            $("#transport_no").click(function() {
                    $("#transportexpand").slideUp();
            });
        });
        $(document).ready(function () {
            $(document).on('click', '#remove', function() {
                $(this).parent().remove();
                x--;
            });
        });
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC35zuevufB1F8oHJ-JwXJMHxc0k3fCbfE&libraries=places"
    async defer></script>
</body>
</html>