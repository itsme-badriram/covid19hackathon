<?php
require_once('dbConnect.php');
require_once('functions.php');


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Donate | Covid</title>
    <link rel="stylesheet" href="menu.css">
         
    <script src="jquery.js"></script><script src="alert.js"></script>
    <link rel="stylesheet" href="alert.css">
    <script src="osFinder.js"></script>
    <script src="menu.js"></script>
    <script src="online.js"></script>
    <link rel="stylesheet" href="onlineDonate.css">
    <script src="loader.js"></script>
    <link rel="stylesheet" href="loader.css">
</head>
<body onload="optionAdd(), addBanks()">
         
    <?php require_once('menubar.php'); ?>
    <form class="form-wrap" action="">
        <div class="donate-head">
            <h2>Online Donation</h2>
            <span class="money"></span>
        </div>
        <div class="payment">
            <h3>Donation Amount</h3>
            <div>
                <ul class="amount">
                    <li class="amt-val">&#8377; 100</li>
                    <li class="amt-val">&#8377; 200</li>
                    <li class="amt-val">&#8377; 500</li class="amt-val">
                    <li class="amt-val">&#8377; 1000</liclass="amt-val">
                    <li id="other-amt">Other</li>
                </ul><br>
                <div id="otherA">
                    <label for="">Enter the amount</label><br>
                    <input class="other" type="text" placeholder="Donation Amount(in Rs)">  
                </div>
                <input id="amt" class="other" type="text" placeholder="Amount : " disabled>
            </div>
            <h3>Payment Methods</h3>
            <div class="credit">
                <label class="method one">Credit/Debit Card</label>
                <div class="credit-show">
                    <hr>
                    <label for="card-no">Card Number</label><br>
                    <input type="text" name="" id="card-no" placeholder="Card Number"><br>
                    <label for="">Expiration Date</label><br>
                    <select name="" id="month">
                        <option value="Month">Month</option>
                    </select>
                    <select name="" id="year">
                        <option value="Year">Year</option>
                    </select>
                    <input type="password" name="" id="cvv" placeholder="CVV"><br>
                    <label for="">Full Name on card</label><br>
                    <input type="text" name="" id="" placeholder="Full Name">
                    <input type="submit" value="Pay">
                </div>
            </div><br>
            <div class="net">
                <label class="method two">Net Banking</label>
                <div class="net-show">
                    <hr>
                    <label for="">Select the Bank</label><br>
                    <select name="" id="bank-opt">
                        <option value="">SELECT BANK</option>
                    </select>
                    <input type="submit" value="Proceed">
                </div>
            </div>
        </div><br>
    </form>
    <div class="footer">
        <p>Department of Computer Technology &copy; Madras Institute of Technology</p>
    </div>    
</body>
</html>