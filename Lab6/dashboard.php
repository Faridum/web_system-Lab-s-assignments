<?php
require "session_guard.php";
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
</head>
<body>

<h2>Welcome, <?= htmlspecialchars($_SESSION['username']) ?></h2>

<p>This page is protected.</p>
<p>You will be logged out after inactivity.</p>

<ul>
    <li><a href="admin.php">Admin Page</a></li>
    <li><a href="logout.php">Logout</a></li>
</ul>

</body>
</html>
