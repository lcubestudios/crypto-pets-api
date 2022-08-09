<?php
// Report all errors
error_reporting(E_ALL);
ini_set('display_errors', 'On');

// Retrive env variable
$host = "db.lcubestudios.io";
$db_user = "eth-toronto";
$db_pass = "W1^8pf*ErRvJrCE";
$db = "demo";
$port = 5432;

// Create connection
$conn = pg_connect("host=$host port=$port dbname=$db user=$db_user password=$db_pass");

$method = $_SERVER['REQUEST_METHOD'];
?>