<?php
require "db_connection.php";
//Get form data
$student_number = $_POST["student_number"];
$full_name = $_POST["full_name"];
$email = $_POST["email"];
$department = $_POST["department"];

//insert query
$sql = "INSERT INTO students (student_number, full_name, email, department) VALUES ('$student_number', '$full_name', '$email', '$department')";

//execute query
if(mysqli_query($connection, $sql)){
    echo "Student added successfully.";
}else{
    echo "Error: " . mysqli_error($connection);
}

//close connection
mysqli_close($connection);

?>