<?php

require "$LIB/auth.php";

includes("/header");
require "$LIB/models/posts.php";
require "$LIB/utils.php";

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

if (isset($_POST["submit"])) {
    $title = $_POST["title"];
    $content = $_POST["content"];
    $err = getErrorMessage($title, $content);

    $image = uploadImage();

    if ($err == null && $image != null) {
        Posts::create($title, $image, $content, $username);
        header("Location: /dashboard");
        exit();
    }
}

?>

<main>
    <a class="link" href="/dashboard/">go back</a>
    <form class="form" method="POST" enctype="multipart/form-data">
        <h1>Create new post</h1>
        <?php if ($err != null || (isset($image) && $image == null)): ?>
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
            Content
            <textarea name="content" rows="5"></textarea>
        </label>
        <button name="submit">Submit</button>
    </form>
</main>

<?php
includes("footer");
?>