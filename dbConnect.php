<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "covidphp";
// Create connection
try{
$conn = new mysqli($servername, $username, $password, $dbname);
} catch(Exception $e) {
    die("Connection Failed");
}
date_default_timezone_set('Asia/Kolkata');
session_start();
?>