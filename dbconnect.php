<?php
//K.A , 2018

$dbuser = 'kirungi_gpstrack';
$dbpass = '1nterNaalya';
$dbname = 'kirungi_gpstracker';
$dbserver = 'localhost';

 $params = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, 
                 PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC);

//create connection for prepared statements
$pdo = new PDO('mysql:host=localhost;dbname=kirungi_gpstracker;charset=utf8', $dbuser, $dbpass, $params);
$sqlFunctionCallMethod = 'CALL ';

   
// Create connection for mySQli
$db = new mysqli($dbserver,$dbuser,$dbpass,$dbname);
// Check connection
if (!$db) {
    die("Connection failed: " . $db->connect_error);
}

?>