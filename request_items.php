<?php
require_once('dbConnect.php');
require_once('functions.php');
if(!checkLogin()){
    header("Location: login"); }
    



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="menu.css">
         
    <link rel="stylesheet" href="request_items.css">
    <script src="jquery.js"></script><script src="alert.js"></script>
    <link rel="stylesheet" href="alert.css">
    <script src="osFinder.js"></script>
    
    <script src="menu.js"></script>
    <script src="request_items.js"></script>
    
    <script src="loader.js"></script>
    <link rel="stylesheet" href="loader.css">
    

    <title>Support | Covid</title>
</head>
<body>
         
   <?php require_once('menubar.php');  ?>   
    <div class="form-wrap" id="main-box">
        <div class="heading">
            <h2>Request Emergency Supplies</h2>
            <div class="icon-wrap">
                <span class="icon-goods"></span>
            </div>
        </div>
        <form id="requestform"><br>
            <input type="text" name="orgname" id="orgname" placeholder="Enter your Institution Name"><br>
            <select id="typeoforg" name="typeoforg">
                <option value="" disabled selected>Select the type of your Institution</option>
                <option value="oldagehome">Old Age Home</option>
                <option value="orphanage">Orphanage</option>
            </select><br>
            <input type="text" name="applicantname" id="name" placeholder="Enter the Applicant's Name">
            <input type="tel" pattern="[0-9]{10}" id="contact" name="applicantphno" placeholder="Enter a Contact Number">
            <input type="text" name="address" id="address" placeholder="Enter Full Address of the Institution">
            <input type="number" id="num" placeholder="Enter no. of People in the Institution">

            <h3>Select Supplies needed: </h3>
            <input type="checkbox" name="food" id="food" value="food">
            <label for="food" >Food and Water &#129369</label><br>

            <div class="expand food">
                <h3>Select food items required</h3>
                <div>
                    <input type="checkbox" name="rice" id="rice" value="rice"> 
                    <label for="rice">Rice &#127834</label>
                    <div class="expand text">
                        <input type="number" name="rice_quantity" id="ricevalue" placeholder="Enter number of kilos of rice required">
                    </div>
                </div>
                <div>
                    <input type="checkbox" name="wheat" id="wheat" value="wheat" >
                    <label for="wheat">Wheat &#127838</label><br>
                    <div class="expand text">
                        <input type="number" name="wheat_quantity"  id= "wheatvalue" placeholder="Enter number of kilos of wheat required">
                    </div>
                </div>
                <div>
                    <input type="checkbox" name="vegetables" id="vegetables" value="vegetables">
                    <label for="vegetables">Vegetables Packets &#129367</label><br>
                    <div class="expand text">
                        <input type="number" name="vegetables_quantity" id = "vegetablesvalue" placeholder="Enter number of vegetable packets required">
                    </div>
                </div>
                <div>
                    <input type="checkbox" name="water" id="water" value="water">
                    <label for="water">Water Cans &#128688</label><br>
                    <div class="expand text">
                        <input type="number" name="water_quantity" id = "watervalue" placeholder="Enter number of litres of water required">
                    </div>
                </div>
                <div>
                    <input type="checkbox" name="snacks" id="snacks" value="snacks">
                    <label for="snacks">Snacks &#129387</label><br>
                    <div class="expand text">
                        <input type="number" name="snacks_quantity" id = "snacksvalue" placeholder="Enter number of snack packets required">
                    </div>
                </div>
                <div>
                    <input type="checkbox" name="otherfoods" id="otherfoods" value="otherfoods">
                    <label for="otherfoods">Others &#127858</label> 
                    <div class="expand text">
                        <input type="text" name="otherfoods_quantity" id = "otherfoodsvalue" placeholder="Please specify what is required">
                    </div>
                </div>
            </div>
            <div>
                <input type="checkbox" id="clothing" name="clothing"  value="clothing">
                <label for="clothing">Clothing &#x1F9E5</label><br>
                <div class="expand cloth">
                    <h3>Select type of clothing required</h3>
                    <div>
                        <input type="checkbox" name="male" id="male" value="male">
                        <label for="male">Male &#x1F454</label><br>
                        <div class="expand text">
                            <input type="number" name="male_quantity" id="malevalue" placeholder="Enter number of male clothes required">
                        </div>
                    </div>
                    <div>
                        <input type="checkbox" name="female" id="female" value="female">
                        <label for="female">Female &#x1F457</label><br>
                        <div class="expand text">
                            <input type="number" name="female_quantity" id="femalevalue" placeholder="Enter number of female clothes required">
                        </div>
                    </div>
                    <div>
                        <input type="checkbox" name="children" id="children" value="children">
                        <label for="children">Children &#x1F455</label><br>
                        <div class="expand text">
                            <input type="number" name="children_quantity" id="childrenvalue" placeholder="Enter number of children clothes required">
                        </div>
                    </div>
                </div>
            </div>
            <h3>Do you need transportation to a safe place? </h3>
            <div class="radioclass">
                <input type="radio" id="transport_yes" name="transport" value="yes" onclick="onRadio('Yes')" ><label for="transport_yes">Yes</label> <br>
                <input type="radio" id="transport_no" name="transport" value="no" checked onclick="onRadio('No')"><label for="transport_no">No</label> <br>
            </div>
        </form>
        <div class="submit_button">
            <input type="button" onclick="onRequestItemsSubmit()" value="Submit">
        </div>
    </div><br><br>
    <script>
        var transportation = 'No';
        function onRadio(radio){
            transportation = radio;
        }
    </script>
    <div class="footer">
        <p>Department of Computer Technology &copy; Madras Institute of Technology</p>
    </div>
</body>
</html>