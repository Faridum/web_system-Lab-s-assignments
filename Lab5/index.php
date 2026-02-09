<?php
require "db_connection.php";

/*
|--------------------------------------------------------------------------
| DELETE ALL RECORDS LOGIC
|--------------------------------------------------------------------------
*/
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_all'])) {
    $delete_all_sql = "DELETE FROM students";
    mysqli_query($conn, $delete_all_sql);
}


/*
|--------------------------------------------------------------------------
| DELETE LOGIC
|--------------------------------------------------------------------------
*/
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
    $delete_id = (int) $_POST['delete_id']; // cast to int (basic safety)

    $delete_sql = "DELETE FROM students WHERE id = $delete_id";
    mysqli_query($conn, $delete_sql);
}

/*
|--------------------------------------------------------------------------
| FETCH STUDENTS
|--------------------------------------------------------------------------
*/
$students = [];
$sql = "SELECT * FROM students";
$result = mysqli_query($conn, $sql);

while ($row = mysqli_fetch_assoc($result)) {
    $students[] = $row;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Management</title>
    <style>
        table {
            border-collapse: collapse;
            width: 80%;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #333;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
        form {
            display: inline;
        }
    </style>
</head>
<body>

<h2>Students List</h2>
<form method="POST" style="margin-bottom: 15px;">
    <button 
        type="submit" 
        name="delete_all"
        onclick="return confirm('Are you sure you want to DELETE ALL students? This action cannot be undone!')"
       style="background-color: red; color: white; border: none; padding: 5px 10px; cursor: pointer;">
        DELETE ALL RECORDS
    </button>
</form>
<table>
    <tr>
        <th>ID</th>
        <th>Student Number</th>
        <th>Full Name</th>
        <th>Email</th>
        <th>Department</th>
        <th>Action</th>
    </tr>

    <?php if (!empty($students)): ?>
        <?php foreach ($students as $student): ?>
            <tr>
                <td><?= htmlspecialchars($student['id']) ?></td>
                <td><?= htmlspecialchars($student['student_number']) ?></td>
                <td><?= htmlspecialchars($student['full_name']) ?></td>
                <td><?= htmlspecialchars($student['email']) ?></td>
                <td><?= htmlspecialchars($student['department']) ?></td>
                <td>
                    <form method="POST">
                        <input type="hidden" name="delete_id" value="<?= $student['id'] ?>">
                        <button type="submit" onclick="return confirm('Delete this student?')" style="background-color: red; color: white; border: none; padding: 5px 10px; cursor: pointer;">
                            Delete
                        </button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="6">No students found</td>
        </tr>
    <?php endif; ?>
</table>

</body>
</html>
