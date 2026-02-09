<?php
require "db_connection.php";

// Get student ID from URL
$id = $_GET["student_number"];

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Get form data
    $student_number = $_POST["student_number"];
    $full_name = $_POST["full_name"];
    $email = $_POST["email"];
    $department = $_POST["department"];

    // Update query
    $sql = "UPDATE students SET 
            full_name = '$full_name', 
            email = '$email', 
            department = '$department' 
            WHERE student_number = '$student_number'";

    // Execute query
    if (mysqli_query($connection, $sql)) {
        // Redirect to read_data.php after successful update
        header("Location: read_data.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($connection);
    }
}

// Fetch current student data
$sql = "SELECT * FROM students WHERE student_number = '$id'";
$result = mysqli_query($connection, $sql);
$student = mysqli_fetch_assoc($result);

mysqli_close($connection);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Update Student</title>
</head>

<body>

    <h2>Update Student</h2>

    <form method="POST" action="update_data.php?student_number=<?php echo $id; ?>">

        <label>Student Number:</label><br>
        <input type="text" name="student_number"
            value="<?php echo $student['student_number']; ?>" readonly><br><br>

        <label>Full Name:</label><br>
        <input type="text" name="full_name"
            value="<?php echo $student['full_name']; ?>" required><br><br>

        <label>Email:</label><br>
        <input type="email" name="email"
            value="<?php echo $student['email']; ?>"><br><br>

        <label>Department:</label><br>
        <input type="text" name="department"
            value="<?php echo $student['department']; ?>"><br><br>

        <button type="submit">Update Student</button>
        <a href="read_data.php">Cancel</a>

    </form>

</body>

</html>