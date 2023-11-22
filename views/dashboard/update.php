<?php

require_once "$LIB/auth.php";

includes("/header");
require_once "$LIB/models/posts.php";
require_once "$LIB/utils.php";

$post = Posts::get_by_id_and_other($_GET["id"], $username);

if ($post == null) {
    redirect("/dashboard");
}

function getErrorMessage($title, $content) {
    if (empty($title)) {
        return "Title is empty!";
    }

    if (empty($content)) {
        return "Content is empty!";
    }

    return null;
}

if (isset($_POST["update-post"])) {
    $title = $_POST["title"];
    $content = $_POST["content"];
    $err = getErrorMessage($title, $content);

    if ($err == null) {
        Posts::update($post->post_id, $title, $content);
        redirect("/dashboard");
    }
}

if (isset($_POST["update-post"])) {
    $title = $_POST["title"];
    $content = $_POST["content"];
    $err = getErrorMessage($title, $content);

    if ($err == null) {
        Posts::update($post->post_id, $title, $content);
        redirect("/dashboard");
    }
}

if (isset($_POST["update-image"])) {
    $image = uploadImage();

    if ($image != null) {
        unlink("../static/images/" . $post->image_url);
        Posts::update_image($post->post_id, $image);
        redirect("/dashboard");
    }
}

?>

<main>
    <a class="link" href="/dashboard">go back</a>
    <form class="form" method="POST">
        <h2>Update post</h2>
        <?php if (isset($err)): ?>
            <span class="error">
                <?= $err ?>
            </span>
        <?php endif; ?>
        <label>
            Title
            <input type="text" name="title" value="<?= $post->title ?>">
        </label>
        <label>
            Content
            <textarea name="content" rows="5"><?= $post->content ?></textarea>
        </label>
        <input type="hidden" name="csrf" value="<?= $csrf ?>">
        <button name="update-post">Submit</button>
    </form>
    <form class="form" method="POST" enctype="multipart/form-data">
        <h2>Update image</h2>
        <?php if (isset($image) && $image == null): ?>
            <span class="error">Could not upload image</span>
        <?php endif; ?>
        <label>
            Image
            <input type="file" name="image">
        </label>
        <input type="hidden" name="csrf" value="<?= $csrf ?>">
        <button name="update-image">Submit</button>
    </form>
</main>

<?php
includes("footer");
?>