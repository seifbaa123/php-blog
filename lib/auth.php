<?php

if (!isset($_SESSION["username"])) {
    redirect("/dashboard/login");
}

$username = $_SESSION["username"];
