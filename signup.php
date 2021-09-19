<?php
require_once('dbConnect.php');
require_once('functions.php');

if(checkLogin()){
    $homepage = $_SESSION['homepage'];
 
    header("Location: $homepage ");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Signup | Covid</title>
    <link rel="stylesheet" href="signup-new.css">
    <script src="jquery.js"></script><script src="alert.js"></script>
    <link rel="stylesheet" href="alert.css">
    <script src="osFinder.js"></script>
    <script src="signup.js"></script>
    
    <script src="request_service.js"></script>
    
    <script src="loader.js"></script>
    <link rel="stylesheet" href="loader.css">
</head>
<body>
    <div class="banner">
        <span class="logo"></span>
        <h1>Covid 19 Emergency Management</h1>
        <a href="login"><button id="login">Login</button></a>
    </div>
    <div class="main">
        <h2 class="main-head">Sign Up</h2>
        <h5 class="main-cat">Category</h5>
        <div class="prog-bar">
            <span class="number one finished">1</span>
            <span class="line">
                <span class="one-line"></span>
            </span>
            <span class="number two">2</span>
            <span class="line">
                <span class="two-line"></span>
            </span>
            <span class="number three">3</span>
            <span class="line">
                <span class="three-line"></span>
            </span>
            <span class="number four">4</span>
        </div>
        <div class="multi-form">
            <div class="select-category">
                <h3>
                    <span class="cat-icon"></span>
                    <span>Select Category</span>
                </h3>
                <div class="category">
                    <ul>
                        <li class="c-list">
                            <span class="c-icon"></span>
                            <span class="text">General User</span>
                            <span class="selected"></span>
                        </li>
                        <li class="c-list">
                            <span class="c-icon vol"></span>
                            <span class="text">Volunteer</span>
                            <span class="selected"></span>
                        </li>
                        <li class="c-list">
                            <span class="c-icon ess"></span>
                            <span class="text">Essential Worker</span>
                            <span class="selected"></span>
                        </li>
                        <li class="c-list">
                            <span class="c-icon doc"></span>
                            <span class="text">Doctor</span>
                            <span class="selected"></span>
                        </li>
                    </ul>
                </div>
                <div class="button pers-button">
                    <span>Continue</span>
                    <span class="button-icon"></span>
                </div>
            </div>
            <div class="form-wrap personal">
                <h3>
                    <span class="pers-icon"></span>
                    <span>Personal Details</span>
                </h3>
                <form action="" autocomplete="off">
                    <div class="input-wrap">
                        <input type="text" name="" id="name" required>
                        <label for="name">Full Name</label>
                    </div>
                    <div class="input-wrap">
                        <input type="text" name="" id="email" required>
                        <label for="email">Email Address</label>
                    </div>
                    <div class="input-wrap">
                        <input type="number" name="" id="contact" required>
                        <label for="contact">Contact Number</label>
                    </div>
                    <div class="aadhar">
                        <div class="input-wrap">
                            <input type="number" name="" id="aadhar" required>
                            <label for="aadhar">Aadhar Card Number</label>
                        </div>
                    </div>
                    <div class="skills vol-details">
                        <h4 class="skill-title">Tell us more about you!</h4>
                        <div class="input-wrap">
                            <select id="field" name="field" required>
                                <option value="" selected></option>
                                <option value="Health">Health</option>
                                <option value="Communication">Communication</option>
                                <option value="Entrepreneurial">Entrepreneurial</option>
                            </select>
                            <label for="field">Select field of volunteering</label>
                        </div>
                        <div class="input-wrap">
                            <select id="experience" name="experience" required>
                                <option value="" selected></option>
                                <option value="No Prior Experience">No Prior Experience</option>
                                <option value="Little Experience">Little Experience</option>
                                <option value="Good Experience">Good Experience</option>
                                
                            </select>
                            <label for="experience">Experience</label>
                        </div>
                    </div>
                    <div class=" skills ess-details">
                        <h4 class="skill-title">Tell us more about you!</h4>
                        <div class="input-wrap">
                            <select id="type" name="type" required>
                                <option value="" selected></option>
                                <option value="Assisting District administration in Quarantine">Assisting District administration in Quarantine</option>
                                <option value="Disinfection and cleaning services">Disinfection and cleaning services</option>
                                <option value="Door to door Info and Service management">Door to door Info and Service management</option>
                                <option value="Food and Grocery Services">Food and Grocery Services</option>
                            </select>
                            <label for="type">Select Type</label>
                        </div>
                    </div>
                    <div class="skills doc-details">
                        <h4 class="skill-title">Tell us more about you!</h4>
                        <div class="input-wrap">
                            <input type="text" name="" id="degree" required>
                            <label for="degree">Completed Degrees</label>
                        </div>
                        <div class="input-wrap">
                            <input type="text" name="" id="special" required>
                            <label for="special">Specialist</label>
                        </div>
                        <h4 class="skill-title">Your Consulting Hours</h4>
                        <div class="time-overflow">
                            <div class="time-wrap">
                                <div class="input-wrap time-slot">
                                    <input type="text" name="" id="start" required>
                                    <label for="start">Start Time</label>
                                </div>
    
                                <div class="input-wrap time-slot">
                                    <input type="text" name="" id="end" required>
                                    <label for="end">End Time</label>
                                </div>
                                <div class="addSlot">+</div>
                            </div>
                        </div>
                        <h5 class="note"><b>Note : </b>You can't add not more than 3 additional time slots!</h5>    
                    </div>
                </form>
                <div class="button-wrap">
                    <div class="button back cat-back">
                        <span class="button-icon"></span>
                        <span>Back</span>
                    </div>
                    <div class="button loc-button">
                        <span>Continue</span>
                        <span class="button-icon"></span>
                    </div>
                </div>
            </div>
            <div class="form-wrap location">
                <h3>
                    <span class="loc-icon"></span>
                    <span>Location Details</span>
                </h3>
                <form action="" autocomplete="off">
                    <div class="input-wrap">
                        <input type="text" name="" id="flat" required>
                        <label id="place-title" for="flat">Flat No, Apt Name</label>
                        <h5 class="note doc-ess">
                            <b>Note : </b>
                            <span id="note-msg"></span>
                        </h5>
                    </div>
                    <div class="input-wrap">
                        <input type="text" name="" id="street" required>
                        <label for="street">Street Name</label>
                    </div>
                    <div class="input-wrap">
                        <input type="text" name="" id="town" required>
                        <label for="town">Town/Area</label>
                    </div>
                    <div class="input-wrap">
                        <select name="" id="state" required>
                            <option value="" selected></option>
                        </select>
                        <label for="state">State</label>
                    </div>
                    <div class="input-wrap">
                        <select name="" id="city" required>
                            <option value="" selected></option>
                        </select>
                        <label for="city">City</label>
                    </div>
                    <div class="input-wrap">
                        <input type="number" name="" id="pin" required>
                        <label for="pin">PIN Code</label>
                    </div>
                    <div id="mapAll">
                        <span id="mapShow" onclick = "addLocation()"></span>
                        <div id="googleMap">
                        </div>
                    </div>
                    <h5 class="note"><b>Note : </b>Drop the marker in your location</h5>
                </form>
                <div class="button-wrap">
                    <div class="button back pers-back">
                        <span class="button-icon"></span>
                        <span>Back</span>
                    </div>
                    <div class="button pass-button">
                        <span>Continue</span>
                        <span class="button-icon"></span>
                    </div>
                </div>
            </div>
            <div class="form-wrap pass">
                <h3>
                    <span class="pass-icon"></span>
                    <span>Password</span>
                </h3>
                <form action="" autocomplete="off">
                    <div class="input-wrap">
                        <input type="password" name="" id="pass" required>
                        <label for="pass">Password</label>
                    </div>
                    <div class="input-wrap">
                        <input type="password" name="" id="re-pass" required>
                        <label for="re-pass">Retype Password</label>
                    </div>
                </form>
                <div class="button-wrap">
                    <div class="button back loc-back">
                        <span class="button-icon"></span>
                        <span>Back</span>
                    </div>
                    <div class="button signup">
                        <span>Sign Up</span>
                        <span class="button-icon"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC35zuevufB1F8oHJ-JwXJMHxc0k3fCbfE&libraries=geometry,places"
    async defer></script>
    <div class="footer">
        <p>Department of Computer Technology &copy; Madras Institute of Technology</p>
    </div> 
</body>
</html>