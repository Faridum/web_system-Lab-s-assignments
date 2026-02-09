<?php
$host = "localhost";
$user = "farid";
$password = "8208";
$database = "university";

$conn = mysqli_connect($host, $user, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
