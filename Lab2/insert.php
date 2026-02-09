<?php
require "db_connection.php";

$student_number = $_POST["student_number"];
$full_name = $_POST["full_name"];
$email = $_POST["email"];
$department = $_POST["department"];
$date_of_birth = $_POST["date_of_birth"];


$sql = "INSERT INTO students 
        (student_number, full_name, email, department, date_of_birth) 
        VALUES (?, ?, ?, ?, ?)";

$stmt = mysqli_prepare($connection, $sql);
mysqli_stmt_bind_param(
    $stmt,
    "sssss",
    $student_number,
    $full_name,
    $email,
    $department,
    $date_of_birth
);

if (mysqli_stmt_execute($stmt)) {
    echo "Student added successfully.";
} else {
    echo "Error: " . mysqli_error($connection);
}

mysqli_close($connection);
?>
