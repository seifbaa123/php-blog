<?php

function view($path, $params = []) {
    global $LIB;
    global $pdo;
    require "../app/views/$path.php";
}

function includes($path) {
    require "../app/includes/$path.php";
}

$LIB = __DIR__ . "/../app/lib";
