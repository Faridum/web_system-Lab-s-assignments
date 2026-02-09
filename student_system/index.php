<?php
require "session_guard.php";
require "db.php";
//حذف الكل
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_all'])) {
    mysqli_query($conn, "DELETE FROM students");
}
// حذف طالب واحد فقط
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
    $delete_id = (int) $_POST['delete_id'];
    mysqli_query($conn, "DELETE FROM students WHERE id = $delete_id");
}

$students = [];
$result = mysqli_query($conn, "SELECT * FROM students");

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
            margin-top: 15px;
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
        .top-actions {
            width: 80%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }
        .add-btn {
            background-color: green;
            color: white;
            padding: 6px 12px;
            text-decoration: none;
            border-radius: 4px;
        }
        .delete-btn {
            background-color: red;
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
        }
        .edit-btn {
            background-color: green;
            color: white;
            padding: 5px 10px;
            text-decoration: none;
            border-radius: 4px;
            margin-right: 5px;
        }
    </style>
</head>
<body>

<h2>Students List</h2>

<!-- 🔹 Top Actions -->
<div class="top-actions">
    <a href="add_student.php" class="add-btn">+ Add Student</a>

    <form method="POST">
        <button 
            type="submit"
            name="delete_all"
            onclick="return confirm('Are you sure you want to DELETE ALL students? This action cannot be undone!')"
            class="delete-btn">
            DELETE ALL RECORDS
        </button>
    </form>
</div>

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
                    <a 
                        href="update_data.php?id=<?= $student['id'] ?>" 
                        class="edit-btn">
                        Edit
                    </a>

                    <form method="POST">
                        <input type="hidden" name="delete_id" value="<?= $student['id'] ?>">
                        <button 
                            type="submit"
                            onclick="return confirm('Delete this student?')"
                            class="delete-btn">
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
