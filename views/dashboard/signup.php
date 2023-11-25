<?php

includes("header");
require_once "$LIB/models/users.php";

function getErrorMessage($username, $password) {
    $err = validate($_POST, [
        "username" => ["required"],
        "password" => ["required"],
    ]);
    if ($err != null) {
        return $err;
    }

    $user = Users::get_user($username);
    if ($user != null) {
        return "User already exist!";
    }
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
        <h1>Signup</h1>
        <?php if (isset($er)): ?>
            <span class="error">
                <?= $err ?>
            </span>
        <?php endif; ?>
        <label>
            Username
            <input type="text" name="username">
        </label>
        <label>
            Password
            <input type="password" name="password">
        </label>
        <input type="hidden" name="csrf" value="<?= $csrf ?>">
        <button name="submit">Submit</button>
    </form>
</main>

<?php
includes("footer");
?>