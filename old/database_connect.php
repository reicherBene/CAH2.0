<?php
$dbHost = '127.0.0.1';
$dbUsername = 'ni578676_1sql1';
$dbPassword = '3FUyjvnRpsyR3xMk';
$dbName = 'ni578676_1sql1';

function connect_database(){
    $db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);
    if ($db->connect_error) {
      	die("Unable to connect database: " . $db->connect_error);
    }
    return $db;
}
?>