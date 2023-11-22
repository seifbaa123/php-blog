<?php

if (isset($_SESSION["username"])) {
    redirect("/dashboard");
}
