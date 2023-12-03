<?php

session_start();
unset($_SESSION["username"]);

redirect("/dashboard/login");
