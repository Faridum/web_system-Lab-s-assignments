<?php
require "session_guard.php";
require "db.php";

$id = (int) $_GET['id'];
mysqli_query($conn, "DELETE FROM students WHERE id = $id");

header("Location: index.php");
exit;
