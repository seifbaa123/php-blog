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
    if ($user == null) {
        return "User does not exist!";
    }

    if (!password_verify($password, $user->password)) {
        return "Wrong password!";
    }

    return null;
}

if (isset($_POST["submit"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $err = getErrorMessage($username, $password);

    if ($err == null) {
        session_start();
        $_SESSION["username"] = $username;
        redirect("/dashboard");
    }
}

?>

<main>
    <form class="form" method="POST">
        <h1>Login</h1>
        <?php if (isset($err)) : ?>
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
component("footer");
?>