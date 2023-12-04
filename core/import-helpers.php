<?php

function view($path, $params = []) {
    global $lib;
    global $app;
    require "../app/views/$path.php";
}

function component($path, $params = []) {
    global $lib;
    global $app;
    require "../app/components/$path.php";
}

$lib = __DIR__ . "/../app/lib";
$public = __DIR__ . "/../public";
