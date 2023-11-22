<?php

includes("header");
require_once "$LIB/models/users.php";

function getErrorMessage($username, $password) {
    if (empty($username) || empty($password)) {
        return "Username or password is empty!";
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
        <?php if ($err != null): ?>
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