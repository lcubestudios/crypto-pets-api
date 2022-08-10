<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: X-Requested-With, Content-Type, Origin, Cache-Control, Pragma, Authorization, Accept, Accept-Encoding");
header("Access-Control-Allow-Headers: Authorization, Content-Type, Depth, User-Agent, X-File-Size, X-Requested-With, If-Modified-Since, X-File-Name, Cache-Control");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS, DELETE, PUT");

// Report all errors
error_reporting(E_ALL);
ini_set('display_errors', 'On');

// Retrive env variable
$host = "db.lcubestudios.io";
$db_user = "eth";
$db_pass = "W1^8pf*ErRvJrCE";
$db = "demo";
$port = 5432;

// Create connection
$conn = pg_connect("host=$host port=$port dbname=$db user=$db_user password=$db_pass");

$method = $_SERVER['REQUEST_METHOD'];
?>