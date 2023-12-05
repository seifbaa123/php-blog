<?php

component("/header");
require_once "$lib/models/posts.php";
require_once "$lib/utils.php";

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
    <a class="link" href="/dashboard"><?= $lang->goBack ?></a>
    <form class="form" method="POST" enctype="multipart/form-data">
        <h1><?= $lang->createNewPost ?></h1>
        <?php if (isset($err) || (isset($image) && $image == null)) : ?>
            <span class="error">
                <?= $err ?? "Could not upload image" ?>
            </span>
        <?php endif; ?>
        <label>
            <?= $lang->title ?>
            <input type="text" name="title">
        </label>
        <label>
            <?= $lang->image ?>
            <input type="file" name="image">
        </label>
        <label>
            <?= $lang->content ?>
            <textarea name="content" rows="5"></textarea>
        </label>
        <input type="hidden" name="csrf" value="<?= $csrf ?>">
        <button name="submit"><?= $lang->submit ?></button>
    </form>
</main>

<?php
component("footer");
?>