<?php 
$server = "localhost";
$username = "root";
$password = "root";

// Create connection
$con = new mysqli($server, $username, $password, 'todo');

// Check connection
if ($con->connect_error) {
die("Connection failed: " . $con->connect_error);
} 

?>