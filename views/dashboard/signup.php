<?php

includes("header");
require "$LIB/models/users.php";

function getErrorMessage($username, $password)
{
    if (empty($username) || empty($password)) {
        return "Username or password is empty!";
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
        header("Location: /dashboard");
        exit();
    }
}

?>

<main>
    <form class="form" method="POST">
        <h1>Signup</h1>
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
        <button name="submit">Submit</button>
    </form>
</main>

<?php
includes("footer");
?>