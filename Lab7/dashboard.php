<?php
// 1. Security Check: logic to ensure only logged-in users see this
if (!isset($_COOKIE['username'])) {
    // If cookie is missing, redirect to login
    header("Location: login.php");
    exit;
}

// 2. Get the username from the cookie
$current_user = $_COOKIE['username'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
</head>
<body>

<h2>Welcome, <?= htmlspecialchars($current_user) ?></h2>

<p>You are logged in using a Cookie.</p>

<a href="logout.php">Logout</a>

</body>
</html>