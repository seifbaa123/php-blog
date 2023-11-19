<?php

require "../lib/auth.php";

require "../inc/header.php";
require "../lib/models/posts.php";

function getErrorMessage($title, $content)
{
    if (empty($title)) {
        return "Title is empty!";
    }

    if (empty($content)) {
        return "Content is empty!";
    }

    return null;
}

function uploadFile()
{
    if (!isset($_FILES["image"]) || $_FILES["image"]["error"] != 0) {
        return null;
    }

    $uploadDir = "../static/images/";

    $fileName = uniqid();
    $targetPath = $uploadDir . $fileName;

    if (!move_uploaded_file($_FILES["image"]["tmp_name"], $targetPath)) {
        return null;
    }

    return $fileName;
}

if (isset($_POST["submit"])) {
    $title = $_POST["title"];
    $content = $_POST["content"];
    $err = getErrorMessage($title, $content);

    $image = uploadFile();

    if ($err == null && $image != null) {
        Posts::create($title, $image, $content, $username);
        header("Location: /dashboard");
        exit();
    }
}

?>

<main>
    <form class="form" method="POST" enctype="multipart/form-data">
        <h1>Create new post</h1>
        <?php if ($err != null || $image != null): ?>
            <span class="error">
                <?= $err ?? "Could not upload image" ?>
            </span>
        <?php endif; ?>
        <label>
            Title
            <input type="text" name="title">
        </label>
        <label>
            Image
            <input type="file" name="image">
        </label>
        <label>
            Image
            <textarea name="content" rows="5"></textarea>
        </label>
        <button name="submit">Submit</button>
    </form>
</main>

<?php
include "../inc/footer.php";
?>