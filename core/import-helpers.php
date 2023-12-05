<?php

function view($path, $params = []) {
    global $lib;
    global $app;
    global $lang;
    global $public;
    require "../app/views/$path.php";
}

function component($path, $params = []) {
    global $lib;
    global $app;
    global $lang;
    global $public;
    require "../app/components/$path.php";
}

$lib = __DIR__ . "/../app/lib";
$public = __DIR__ . "/../public";
