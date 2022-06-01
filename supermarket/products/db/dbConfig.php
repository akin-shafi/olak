<?php 
// Database configuration 
$dbHost     = "localhost"; 
$dbUsername = "hoteliap_ambiance_user"; 
$dbPassword = "Akinshafi@91"; 
$dbName     = "hoteliap_restaurant";
 
// Create database connection 
$db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName); 
 
// Check connection 
if ($db->connect_error) { 
    die("Connection failed: " . $db->connect_error); 
}