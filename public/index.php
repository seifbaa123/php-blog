<?php

require_once "../core/import-helpers.php";

$parsedUrl = parse_url($_SERVER["REQUEST_URI"]);
$path = $parsedUrl['path'];

if (substr($path, -1) == "/") {
    $path = $path . "index";
}

require "../views" . $path . ".php";
