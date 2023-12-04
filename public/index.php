<?php

session_start();


require_once "../core/utils.php";
require_once "../core/router.php";
require_once "../core/csrf-token.php";
require_once "../core/validation.php";
require_once "../core/import-helpers.php";

require_once "../app/app.php";
require_once "../app/routes.php";

Router::handleRequest();

$_SESSION["csrf"] = $csrf;
