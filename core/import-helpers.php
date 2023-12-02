<?php

function view($path, $params = []) {
    global $LIB;
    global $pdo;
    require "../views/$path.php";
}

function includes($path) {
    require "../includes/$path.php";
}

$LIB = __DIR__ . "/../lib";
