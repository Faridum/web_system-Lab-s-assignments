<?php
$servername = "localhost";
$username = "farid";
$password = "8208";
$db_name = "university";

// create database connection
$connection = new mysqli($servername,$username,$password,$db_name);

// check connection 
if($connection->connect_error){
    die("Connection Error:" . $connection->connect_error);
}

?>