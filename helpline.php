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
         
    <link rel="stylesheet" href="helpline.css">
    <script src="jquery.js"></script><script src="alert.js"></script>
    <link rel="stylesheet" href="alert.css">
    <script src="osFinder.js"></script>
    
    <script src="menu.js"></script>
    <script src="helpline.js"></script>
    <title>Helpline numbers | Covid</title>
    <script src="loader.js"></script>
    <link rel="stylesheet" href="loader.css">
</head>
<body>
         
    <?php require_once('menubar.php'); ?>
    <div class="main">
        <div class="mainemergency">
            <h2 class="main-head">
                <span>Emergency Helpline Numbers</span>
                <span class="icon siren"></span>
            </h2>
            <table class="emergency">
                <tr>
                    <td><span class="icon pol"></span></td>
                    <td><h2>Police</h2></td>
                    <td>
                        <div class="contact">
                            <span class="icon tele"></span>
                            <a href="tel:+100">100</a>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td><span class="icon fire"></span></td>
                    <td><h2>Fire Brigade</h2></td>
                    <td>
                        <div class="contact">
                            <span class="icon tele"></span>
                            <a href="tel:+101">101</a>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td><span class="icon amb"></span></td>
                    <td><h2>Ambulance</h2></td>
                    <td>
                        <div class="contact">
                            <span class="icon tele"></span>
                            <a href="tel:+102">102,</a>
                            <a href="tel:+202001">202001</a>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
        <br>
        <h2 class="dis-head">District-wise Helpline Numbers</h2>
        <div class="tab">
            <button class="tablinks" onclick="openCity(event, 'north')" id="defaultOpen">North District</button>
            <button class="tablinks" onclick="openCity(event, 'east')">East District</button>
            <button class="tablinks" onclick="openCity(event, 'west')">West District</button>
            <button class="tablinks" onclick="openCity(event, 'south')">South District</button>
        </div>
        <br>
        <div id="north" class="tabcontent">
            <div class="heading" style="text-align: center;">
                <h2>North Sikkim</h2>
            </div>
            <input id="myInput1" type="text" placeholder="Type to Search...">
            <table class="stable" id="myTable1">
                <thead>
                    <tr>
                        <th colspan="2">
                            Police Stations
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Mangan Police Station</td>
                        <td><a href="tel:03592-234284">03592-234284</a></td>
                    </tr>
                    <tr>
                        <td>Chungthang Police Station</td>
                        <td><a href="tel:03592-210266">03592-210266</a></td>
                    </tr>
                    <tr>
                        <td>Phodong Police Station</td>
                        <td><a href="tel:03592-262992">03592-262992</a></td>
                    </tr>
                    <tr>
                        <td>Lachung Police Station</td>
                        <td><a href="tel:9800416467">9800416467</a></td>
                    </tr>
                    <tr>
                        <td>Lachen Police Station</td>
                        <td><a href="tel:8436968469">84369 68469</a></td>
                    </tr>
                </tbody>
                <thead>
                    <tr>
                        <th colspan="2">
                            Fire Control Room Numbers
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Fire Control Room (North)</td>
                        <td><a href="tel:03592-234266">03592-234266</a>,<br>
                        <a href="tel:7550923195">7550923195</a></td>
                    </tr>
                </tbody>
                <thead>
                    <tr>
                        <th colspan="2">
                            Medical Services
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>District Hospital Mangan (North Sikkim)</td>
                        <td><a href="tel:9434136948">9434136948</a>,<br>
                        <a href="tel:9434117251">9434117251</a></td>
                    </tr>
                    <tr>
                        <td>Chief Medical Officer</td>
                        <td><a href="tel:234244">234244</a>,<br>
                        <a href="tel:234277">234277</a></td>
                    </tr>
                </tbody>
            </table><br>
        </div>
        <div id="east" class="tabcontent">
            <div class="heading" style="text-align: center;">
                <h2>East Sikkim</h2>
            </div>
            <input id="myInput2" type="text" placeholder="Type to Search...">
            <table class="stable" id="myTable2">
                <thead>
                    <tr>
                        <th colspan="2">
                            Police Stations
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Sadar Police Station</td>
                        <td><a href="tel:03592-202022">03592-202022</a></td>
                    </tr>
                    <tr>
                        <td>Ranipool Police Station</td>
                        <td><a href="tel:03592-251712">03592-251712</a></td>
                    </tr>
                    <tr>
                        <td>Pakyong Police Station</td>
                        <td><a href="tel:03592-257834">03592-257834</a></td>
                    </tr>
                    <tr>
                        <td>Singtam Police Station</td>
                        <td><a href="tel:03592-233762">03592-233762</a></td>
                    </tr>
                    <tr>
                        <td>Rangpo Police Station</td>
                        <td><a href="tel:03592-240835">03592-240835</a></td>
                    </tr>
                    <tr>
                        <td>Rhenock Police Station</td>
                        <td><a href="tel:03592-253840">03592-253840</a></td>
                    </tr>
                    <tr>
                        <td>Rongli Police Station</td>
                        <td><a href="tel:03592-255623">03592-255623</a></td>
                    </tr>
                    <tr>
                        <td>Kupup Police Station</td>
                        <td><a href="tel:03592-256252">03592-256252</a></td>
                    </tr>
                    <tr>
                        <td>Sherathang Police Station</td>
                        <td><a href="tel:03592-266218">03592-266218</a></td>
                    </tr>
                </tbody>
                <thead>
                    <tr>
                        <th colspan="2">
                            Fire Control Room Numbers
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Fire Control Room (East)</td>
                        <td><a href="tel:03592202001">03592-202001</a></td>
                    </tr>
                </tbody>
                <thead>
                    <tr>
                        <th colspan="2">
                            Medical Services
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Central Hospital, Manipal</td>
                        <td><a href="tel:03592231137">03592-231137</a></td>
                    </tr>
                    <tr>
                        <td>STNM Hospital</td>
                        <td><a href="tel:03592202944">03592-202944</a></td>
                    </tr>
                    <tr>
                        <td>Chief Medical Officer</td>
                        <td><a href="tel:03592235379">03592-235379</a></td>
                    </tr>
                </tbody>
            </table><br>
        </div>
        <div id="west" class="tabcontent">
            <div class="heading" style="text-align: center;">
                <h2>West Sikkim</h2>
            </div>
            <input id="myInput3" type="text" placeholder="Type to Search...">
            <table class="stable" id="myTable3">
                <thead>
                    <tr>
                        <th colspan="2">
                            Police Stations
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Gyalshing Police Station</td>
                        <td><a href="tel:03595-250844">03595-250844</a></td>
                    </tr>
                    <tr>
                        <td>Soreng Police Station</td>
                        <td><a href="tel:03595-253206">03595-253206</a></td>
                    </tr>
                    <tr>
                        <td>Sombaria Police Station</td>
                        <td><a href="tel:03595-254222">03595-254222</a></td>
                    </tr>
                    <tr>
                        <td>Kaluk Police Station</td>
                        <td><a href="tel:03595-254270">03595-254270</a></td>
                    </tr>
                    <tr>
                        <td>Uttarey Police Station</td>
                        <td><a href="tel:03595-255658">03595-255658</a></td>
                    </tr>
                    <tr>
                        <td>Nayabazar Police Station</td>
                        <td><a href="tel:03595-257240">03595-257240</a></td>
                    </tr>
                    <tr>
                        <td>Dentam Police Station</td>
                        <td><a href="tel:7797631577">7797631577</a></td>
                    </tr>
                </tbody>
                <thead>
                    <tr>
                        <th colspan="2">
                            Fire Control Room Numbers
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Fire Control Room (West)</td>
                        <td><a href="tel:03595-250810">03595-250810</a>,<br>
                            <a href="tel:9593780978">9593780978</a>,<br>
                            <a href="tel:9733104880">9733104880</a></td>
                    </tr>
                </tbody>
                <thead>
                    <tr>
                        <th colspan="2">
                            Medical Services
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Chief Medical Officer</td>
                        <td><a href="tel:3595250634">3595250634</a></td>
                    </tr>
                    <tr>
                        <td>Soreng PHC</td>
                        <td><a href="tel:3595253273">3595253273</a></td>
                    </tr>
                    <tr>
                        <td>Sombaria PHC</td>
                        <td><a href="tel:3595254248">3595254248</a></td>
                    </tr>
                    <tr>
                        <td>Mangalbaria PHC</td>
                        <td><a href="tel:3595252204">3595252204</a></td>
                    </tr>
                    <tr>
                        <td>Dentam PHC</td>
                        <td><a href="tel:3595255311">3595255311</a></td>
                    </tr>
                    <tr>
                        <td>Gyalshing Hospital</td>
                        <td><a href="tel:3595250823">3595250823</a></td>
                    </tr>
                </tbody>
            </table>
            <br>
        </div>
        <div id="south" class="tabcontent">
            <div class="heading" style="text-align: center;">
                <h2>South Sikkim</h2>
            </div>
            <input id="myInput4" type="text" placeholder="Type to Search...">
            <table class="stable" id="myTable4">
                <thead>
                    <tr>
                        <th colspan="2">
                            Police Stations
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Namchi Police Station</td>
                        <td><a href="tel:03595-263722">03595-263722</a></td>
                    </tr>
                    <tr>
                        <td>Jorethang Police Station</td>
                        <td><a href="tel:03595-257358">03595-257358</a></td>
                    </tr>
                    <tr>
                        <td>Melli Police Station</td>
                        <td><a href="tel:03595-248203">03595-248203</a></td>
                    </tr>
                    <tr>
                        <td>Ravangla Police Station</td>
                        <td><a href="tel:03595-260770">03595-260770</a></td>
                    </tr>
                    <tr>
                        <td>Temi Police Station</td>
                        <td><a href="tel:03595-261713">03595-261713</a></td>
                    </tr>
                    <tr>
                        <td>Hingdam Police Station</td>
                        <td><a href="tel:03595-259329">03595-259329</a></td>
                    </tr>
                </tbody>
                <thead>
                    <tr>
                        <th colspan="2">
                            Fire Control Room Numbers
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Fire Control Room (South)</td>
                        <td><a href="tel:03595-263888">03595-263888</a>,<br>
                            <a href="tel:03595-257327">03595-257327</a>,<br>
                            <a href="tel:9434356552">9434356552 (Namchi)</a>,<br>
                            <a href="tel:9434408097">9434408097 (Jorethang)</a></td>
                    </tr>
                </tbody>
                <thead>
                    <tr>
                        <th colspan="2">
                            Medical Services
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Jorethang PHC</td>
                        <td><a href="tel:3595257233">3595257233</a></td>
                    </tr>
                    <tr>
                        <td>Namchi District hospital</td>
                        <td><a href="tel:3595263741">3595263741</a></td>
                    </tr>
                    <tr>
                        <td>Chief Medical Officer</td>
                        <td><a href="tel:3595263830">3595263830</a></td>
                    </tr>
                </tbody>
            </table>
            <br>
        </div><br><br>
    </div>
    <div class="footer">
        <p>Department of Computer Technology &copy; Madras Institute of Technology</p>
    </div>
    <script>
        document.getElementById("defaultOpen").click();
    </script>
</body>
</html>