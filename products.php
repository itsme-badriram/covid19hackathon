<?php

require_once 'dbConnect.php';
require_once 'functions.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="menu.css">
    <link rel="stylesheet" href="alert.css">
    <link rel="stylesheet" href="products.css">
    <script src="jquery.js"></script>
    <script src="menu.js"></script>
    <script src="alert.js"></script>
    <script src="osFinder.js"></script>
    <script src="request_service.js"></script>
    <script src="loader.js"></script>
    <link rel="stylesheet" href="loader.css">
    <title>MSME Products | Covid</title>
</head>
<body>
    <?php  require_once('menubar.php'); ?>
    <div class="form-wrap" id="main-box">
        <h2 class="heading">
            <span>MSME Product Supplier Form</span>
            <span class="icon"></span>
        </h2>
        <form id="myForm" method='post' action='reportAction.php?products=true'>
            <h3>Personal Details</h3>
            <input type="text" name="name" id="name" placeholder="Enter Your Name"  ><br>
            <input type="text" name="phno" id='phno' placeholder="Enter your mobile number" pattern="[0-9]*"  ><br>
            <h3>Enter your address</h3>
            <input type="text" name="doorno" placeholder="Door number" id='doorno' ><br>
            <input type="text" name="streetname" placeholder="Street Name" id='streetname' ><br>
            <input type="text" name="areaname" placeholder="Area Name" id='areaname' ><br>
            <input type="text" name="cityname" placeholder="City Name" id='cityname' ><br>
            <input type="number" name="pincode" placeholder="Postal Code" id='pincode' ><br>
            <input type="text" name="statename" placeholder="State Name"  id='statename'><br>
            <div id="mapAll">
                <span id="mapShow" onclick="addLocation()"></span>
                <div id="googleMap">
                </div>
            </div>
                <h3>Select a mode of verification</h3>
            <div class="radioclass">
                <input type="radio" id="aadhar" value="aadhar" name="verification">
                <label for="aadhar">Aadhar ID</label><br>
                <input type="radio" id="pan" value="pan" name="verification">
                <label for="pan">Pan Card</label><br>
                <div class="aadhar validbox">
                    <input type="text"  name="aadharid" onclick = "onRadio('aadharid')" placeholder="Enter you Aadhar ID number"><br>
                </div>
                <div class="pan validbox">
                    <input type="text"  name="panid" onclick = "onRadio('panid')" placeholder="Enter your PAN Card number"><br>
                </div>
            </div>
            <script>
                var verifyid="";
                function onRadio(id){
                    verifyid = id;

                }
                </script>
            <br>
            <div id='append'>
            <div class="products" id="products">
                <h3>
                    <span>Enter your Product Details</span>
                    <span class="add" onclick="appendRow()" title="Add Products">+</span>
                </h3>
                <div class="product" id="product1">
                    <input type="text" placeholder="Enter the Name of the product" name="prodname1"  ><br>
                    <div class="quantity">
                        <input type="number" placeholder="Enter quantity" class="quan"  >
                    </div>
                </div>
</div>
            </div>
            <div class="submit_button">
            <input type="submit" value="Submit">
        </div>
        </form>
        
    </div><br><br>
    <div class="footer">
        <h3>Department of Computer Technology &copy; Madras Institute of Technology</h3>
    </div>
    <script>
        var x=2;
        function addLocation(){
             var address = document.getElementById('streetname').value + " " +document.getElementById('areaname').value + " "+document.getElementById('cityname').value + " "+document.getElementById('statename').value;
            getLocation(address);
        }
        $(document).ready(function(){
            var form = $('#myForm');
            $('#myForm').on('submit',function(e){
                console.log("Yes");
                e.preventDefault();
                var result = $(".form-wrap #append").find(":input[type=text],:input[type=number] ");
    var k=0;
    
    var str="";
    result.each(function(i){
        var id = $(this).attr('id');
        
        str+=result[i].value+':';
        k++;
        if(k==4){
            str=str.substring(0,str.length-1);
            str+=';';
            k=0;
        }
    
    });
    var lat = marker.getPosition().lat();
                var lng = marker.getPosition().lng();
    var formData = new FormData(this);
    formData.append('products',str);
    
    formData.append('verifyid',verifyid);
    formData.append('lat',lat);
    formData.append('lng',lng);
    $.ajax({
                type: form.attr('method'),
                url: form.attr('action'),
                data: formData,
                contentType: false,
                cache: false,
                processData:false,
                dataType: 'html',
                success: function (data) {
                    console.log(data);
                    alertBox('Reported Successfully','Registered as a Supplier',2);
        },
        error: function (data) {
            alertBox('Try Again Later','',1);
          
        },
    });
               
        });
    });
        function appendRow()
        {
        //var d = document.getElementById('products');
        $( ".products" ).append('<div class="product" id="product'+x+'"><hr><h3><span>Another Product</span><span class="add red" id="remove">-</span></h3><input type="text" placeholder="Enter the Name of the product" name="prodname'+x+'"  ><br> <div class="quantity"> <input type="number" placeholder="Enter quantity" class="quan" name="prodquantity'+x+'"  ></div></div>');
        x++;
        }   

        $(document).ready(function () {
            
            $(document).on('click', '#remove', function() {
                $(this).parents(".product").remove();
            });
        });

        $(document).ready(function(){
        $('input[type="radio"]').click(function(){
            var inputValue = $(this).attr("value");
            var targetBox = $("." + inputValue);
            $(".validbox").not(targetBox).hide();
            $(targetBox).show();
        });
    });
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC35zuevufB1F8oHJ-JwXJMHxc0k3fCbfE&libraries=places"
    async defer></script>
</body>
</html>