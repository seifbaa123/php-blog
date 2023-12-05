<?php

component("header");
require_once "$lib/models/users.php";

function getErrorMessage($username, $password) {
    $err = validate($_POST, [
        "username" => ["required", "min:4"],
        "password" => ["required", "min:8"],
    ]);
    if ($err != null) {
        return $err;
    }

    $user = Users::get_user($username);
    if ($user != null) {
        return "User already exist!";
    }

    return null;
}

if (isset($_POST["submit"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $err = getErrorMessage($username, $password);

    if ($err == null) {
        Users::create_user($username, $password);
        session_start();
        $_SESSION["username"] = $username;
        redirect("/dashboard");
    }
}

?>

<main>
    <form class="form" method="POST">
        <h1><?= $lang->signup ?></h1>
        <?php if (isset($err)) : ?>
            <span class="error">
                <?= $err ?>
            </span>
        <?php endif; ?>
        <label>
            <?= $lang->username ?>
            <input type="text" name="username">
        </label>
        <label>
            <?= $lang->password ?>
            <input type="password" name="password">
        </label>
        <input type="hidden" name="csrf" value="<?= $csrf ?>">
        <button name="submit"><?= $lang->submit ?></button>
    </form>
</main>

<?php
component("footer");
?>