<?php
require "session_guard.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Page</title>
</head>
<body>

<h2>Admin Panel</h2>

<p>Welcome, <strong><?= htmlspecialchars($_SESSION['username']) ?></strong></p>

<p>This is a protected admin page.</p>

<ul>
    <li><a href="dashboard.php">Dashboard</a></li>
    <li><a href="logout.php">Logout</a></li>
</ul>

</body>
</html>
