<?php
require_once('dbConnect.php');
require_once('functions.php');


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
   
    <title>Donate Relief | Covid</title>
     <script src="loader.js"></script>
    <link rel="stylesheet" href="loader.css">
</head>
<body>
         
    <?php  require_once('menubar.php'); ?>
        <div class="form-wrap" id="main-box">
        <div class="heading">
            <h2>Donate Relief Materials</h2>
            <div class="icon-wrap">
                <span class="icon-goods relief"></span>
            </div>
        </div>
        <form id="donationform">
            <input type="text" name="donorname" id="name" placeholder="Enter Your Name"><br>
            <input type="text" name="address" id="address" placeholder="Enter your full address"><br>
            <input type="tel" pattern="[0-9]*" id="contact" name="donorphno" placeholder="Enter Contact Number">

            <h3>Select all the items you want to donate: </h3>
            <div>
                <input type="checkbox" name="food" id="food" value="food">
                <label for="food" >Food &#129369</label><br>
                <div class="expand food">
                    <h3>Select the type food items you wish to donate:</h3>
                    <div>
                        <input type="checkbox" name="rice" id="rice" value="rice">
                        <label for="rice">Rice &#127834</label><br>
                        <div class="expand text">
                            <input type="number" name="rice_quantity" id="ricevalue" placeholder="Enter number of kilos of rice">
                        </div>
                    </div>
                    <div>
                        <input type="checkbox" name="wheat" id="wheat" value="wheat">
                        <label for="wheat">Wheat &#127838</label><br>
                        <div class="expand text">
                            <input type="number" id="wheatvalue" name="wheat_quantity" placeholder="Enter number of kilos of wheat">
                        </div>
                    </div>
                    <div>
                        <input type="checkbox" name="biscuits" id="biscuits" value="biscuits">
                        <label for="biscuits">Biscuit Packets &#127850</label><br>
                        <div class="expand text">
                            <input type="number" id="biscuitsvalue" name="biscuits_quantity" placeholder="Enter number of biscuit packets">
                        </div>
                    </div>
                    <div>
                        <input type="checkbox" name="otherfoods" id="otherfoods" value="otherfoods" >
                        <label for="otherfoods">Others (non-perishable) &#129387</label> 
                        <div class="expand text" id="otherfoodsexpand">
                            <div id="otherfoodinputs">
                                <input type="text" name="otherfoods1" id="otherfoodsvalue" placeholder="Enter type of food and it's quantity">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <input type="checkbox" name="clothing" id="clothing" value="clothing">
                <label for="clothing">Clothing &#x1F9E5</label><br>
                <div class="expand cloth">
                    <h3>Select type of clothing to donate:</h3>
                    <div>
                        <input type="checkbox" name="male" id="male" value="male">
                        <label for="male">Male &#x1F454</label><br>
                        <div class="expand text">
                            <input type="number" id="malevalue" name="male_quantity" placeholder="Enter number of male clothes">
                        </div>
                    </div>
                    <div>
                        <input type="checkbox" name="female" id="female" value="female">
                        <label for="female">Female &#x1F457</label><br>
                        <div class="expand text">
                            <input type="number" id="femalevalue" name="female_quantity" placeholder="Enter number of female clothes">
                        </div>
                    </div>
                    <div>
                        <input type="checkbox" name="children" id="children" value="children">
                        <label for="children">Children &#x1F455</label><br>
                        <div class="expand text">
                            <input type="number" id="childrenvalue" name="children_quantity" placeholder="Enter number of children's clothes">
                        </div>
                    </div>
                    <div>
                        <input type="checkbox" name="infant" id="infant" value="infant">
                        <label for="infant">Infant &#128118</label><br>
                        <div class="expand text">
                            <input type="number" id="infantvalue" name="infant_quantity" placeholder="Enter number of infant's clothes">
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <input type="checkbox" name="hygiene" id="hygiene" value="hygiene">
                <label for="hygiene">Hygiene Products &#127973 </label><br>
                <div class="expand hyg">
                    <h3>Select type of hygiene products to donate</h3>
                    <div>
                        <input type="checkbox" name="facemask" id="facemask" value="facemask">
                        <label for="facemask">Face Mask &#128567</label><br>
                        <div class="expand text">
                            <input type="number" id="facemaskvalue" name="facemask_quantity" placeholder="Enter number of face masks">
                        </div>
                    </div>
                    <div>
                        <input type="checkbox" name="sanitizer" id="sanitizer" value="sanitizer">
                        <label for="sanitizer">Hand Sanitizer &#129524</label><br>
                        <div class="expand text">
                            <input type="number" id="sanitizervalue" name="sanitizer_quantity" placeholder="Enter number of sanitizers">
                        </div>
                    </div>
                    <div>
                        <input type="checkbox" name="sanitary" id="sanitarypads" value="sanitarypads">
                        <label for="sanitary">Sanitary Napkins &#128105</label><br>
                        <div class="expand text">
                            <input type="number" id="sanitarypadsvalue" name="sanitary_quantity" placeholder="Enter number of Sanitary pads">
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <div class="submit_button">
            <input type="button" onclick="onDonationItemsSubmit()" value="Donate">
        </div>
    </div><br><br>
    <div class="footer">
        <p>Department of Computer Technology &copy; Madras Institute of Technology</p>
    </div>
    <script>
    </script>
</body>
</html>