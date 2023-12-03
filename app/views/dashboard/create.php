<?php

component("/header");
require_once "$LIB/models/posts.php";
require_once "$LIB/utils.php";

if (isset($_POST["submit"])) {
    $title = $_POST["title"];
    $content = $_POST["content"];
    $err = validate($_POST, [
        "title"   => ["required"],
        "content" => ["required"],
    ]);

    $image = uploadImage();

    if ($err == null && $image != null) {
        Posts::create($title, $image, $content, $_SESSION["username"]);
        redirect("/dashboard");
    }
}

?>

<main>
    <a class="link" href="/dashboard">go back</a>
    <form class="form" method="POST" enctype="multipart/form-data">
        <h1>Create new post</h1>
        <?php if (isset($err) || (isset($image) && $image == null)) : ?>
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
        <input type="hidden" name="csrf" value="<?= $csrf ?>">
        <button name="submit">Submit</button>
    </form>
</main>

<?php
component("footer");
?>