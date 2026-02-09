<?php
require "db_connection.php";


$selectedDepartment = isset($_GET['department']) ? $_GET['department'] : 'all';


$deptQuery = "SELECT DISTINCT department FROM students";
$deptResult = mysqli_query($connection, $deptQuery);

if ($selectedDepartment == 'all') {
    $sql = "SELECT * FROM students";
} else {
    $sql = "SELECT * FROM students WHERE department = ?";
    $stmt = mysqli_prepare($connection, $sql);
    mysqli_stmt_bind_param($stmt, "s", $selectedDepartment);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
}

if ($selectedDepartment == 'all') {
    $result = mysqli_query($connection, $sql);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Students List</title>
    <style>
        table {
            border-collapse: collapse;
            width: 90%;
            margin-top: 15px;
        }
        th, td {
            border: 1px solid black;
            padding: 10px;
        }
        th {
            background-color: #f2f2f2;
        }
        .edit-btn {
            background-color: #4CAF50;
            color: white;
            padding: 5px 15px;
            text-decoration: none;
            border-radius: 3px;
        }
        .filter-box {
            margin-bottom: 15px;
        }
    </style>
</head>
<body>

<h2>All Students</h2>

<form method="GET" class="filter-box">
    <label><strong>Filter by Department:</strong></label>
    <select name="department" onchange="this.form.submit()">
        <option value="all">All</option>

        <?php
        while ($dept = mysqli_fetch_assoc($deptResult)) {
            $deptName = $dept['department'];
            $selected = ($deptName == $selectedDepartment) ? 'selected' : '';
            echo "<option value='$deptName' $selected>$deptName</option>";
        }
        ?>
    </select>
</form>

<table>
    <tr>
        <th>Student Number</th>
        <th>Full Name</th>
        <th>Email</th>
        <th>Department</th>
        <th>Action</th>
    </tr>

    <?php
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>{$row['student_number']}</td>";
        echo "<td>{$row['full_name']}</td>";
        echo "<td>{$row['email']}</td>";
        echo "<td>{$row['department']}</td>";
        echo "<td>
                <a class='edit-btn' href='update_data.php?student_number={$row['student_number']}'>
                    Update
                </a>
              </td>";
        echo "</tr>";
    }
    ?>
</table>

<?php
mysqli_close($connection);
?>

</body>
</html>
