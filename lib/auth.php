<?php

session_start();

if (!isset($_SESSION["username"])) {
    header("Location: /dashboard/login");
    exit();
}

$username = $_SESSION["username"];
