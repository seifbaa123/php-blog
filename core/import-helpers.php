<?php

function view($path, $params = []) {
    global $LIB;
    global $pdo;
    require "../app/views/$path.php";
}

function component($path, $params = []) {
    require "../app/components/$path.php";
}

$LIB = __DIR__ . "/../app/lib";
