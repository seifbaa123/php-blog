<?php

session_start();

if (!isset($_SESSION["username"])) {
    header("Location: /dashboard/login.php");
    exit();
}

$username = $_SESSION["username"];
