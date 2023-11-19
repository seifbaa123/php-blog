<?php
require "../inc/header.php";
require "../lib/models/users.php";

function getErrorMessage()
{
    $username = $_POST["username"];
    $password = $_POST["password"];

    if (empty($username) || empty($password)) {
        return "Username or password is empty!";
    }

    $user = Users::get_user($username);
    if ($user === null) {
        return "User does not exist!";
    }

    if (!password_verify($password, $user->password)) {
        return "Wrong password!";
    }

    return null;
}

if (isset($_POST["submit"])) {
    $err = getErrorMessage();
    if ($err == null) {
        $_SESSION["username"] = $username;
        header("Location: /dashboard");
        exit();
    }
}

?>

<main>
    <form class="auth-form" method="POST">
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
            <input type="text" name="password">
        </label>
        <button name="submit">Submit</button>
    </form>
</main>

<?php
include "../inc/footer.php";
?>