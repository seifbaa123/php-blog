<?php

$uri = $_SERVER["REQUEST_URI"];

if (substr($uri, -1) == "/") {
    $uri = $uri . "index";
}

require "../views" . $uri . ".php";
