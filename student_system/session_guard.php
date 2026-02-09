<?php
session_start();

$SESSION_TIMEOUT = 600; // 10 minutes

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

if (isset($_SESSION['last_activity']) &&
    (time() - $_SESSION['last_activity']) > $SESSION_TIMEOUT) {

    session_destroy();
    header("Location: login.php?timeout=1");
    exit;
}

$_SESSION['last_activity'] = time();
