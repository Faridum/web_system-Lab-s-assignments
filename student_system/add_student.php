<?php
require "session_guard.php";
require "db.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $student_number = trim($_POST['student_number']);
    $full_name      = trim($_POST['full_name']);
    $email          = trim($_POST['email']);
    $department     = trim($_POST['department']);

    $sql = "INSERT INTO students (student_number, full_name, email, department)
            VALUES (?, ?, ?, ?)";

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param(
        $stmt,
        "ssss",
        $student_number,
        $full_name,
        $email,
        $department
    );
    mysqli_stmt_execute($stmt);

    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Student</title>
</head>
<body>

<h2>Add New Student</h2>

<form method="POST">
    <label>Student Number:</label><br>
    <input type="text" name="student_number" required><br><br>

    <label>Full Name:</label><br>
    <input type="text" name="full_name" required><br><br>

    <label>Email:</label><br>
    <input type="email" name="email"><br><br>

    <label>Department:</label><br>
    <input type="text" name="department"><br><br>

    <button type="submit">Add Student</button>
    <a href="index.php">Cancel</a>
</form>

</body>
</html>
