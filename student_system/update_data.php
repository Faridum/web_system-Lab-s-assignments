<?php
require "session_guard.php";
require "db.php";

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$id = (int) $_GET['id'];

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $full_name  = $_POST["full_name"];
    $email      = $_POST["email"];
    $department = $_POST["department"];

    $sql = "UPDATE students 
            SET full_name = ?, email = ?, department = ?
            WHERE id = ?";

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "sssi",
        $full_name,
        $email,
        $department,
        $id
    );

    if (mysqli_stmt_execute($stmt)) {
        header("Location: index.php");
        exit;
    } else {
        echo "Error updating record.";
    }
}

$sql = "SELECT * FROM students WHERE id = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

$student = mysqli_fetch_assoc($result);

if (!$student) {
    echo "Student not found.";
    exit;
}

mysqli_close($conn);
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Student</title>
</head>
<body>

<h2>Update Student</h2>
<form method="POST">
    <label>Student Number:</label><br>
    <input type="text" value="<?= htmlspecialchars($student['student_number']) ?>" readonly><br><br>

    <label>Full Name:</label><br>
    <input type="text" name="full_name"
           value="<?= htmlspecialchars($student['full_name']) ?>" required><br><br>

    <label>Email:</label><br>
    <input type="email" name="email"
           value="<?= htmlspecialchars($student['email']) ?>"><br><br>

    <label>Department:</label><br>
    <input type="text" name="department"
           value="<?= htmlspecialchars($student['department']) ?>"><br><br>

    <button type="submit">Update Student</button>
    <a href="index.php">Cancel</a>
</form>


</body>
</html>
