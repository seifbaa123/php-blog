<?php

component("/header");
require_once "$lib/models/posts.php";
require_once "$lib/utils.php";

$post = Posts::get_by_id_and_other($_GET["id"], $_SESSION["username"]);

if ($post == null) {
    redirect("/dashboard");
}

if (isset($_POST["update-post"])) {
    $title = $_POST["title"];
    $content = $_POST["content"];
    $err = validate($_POST, [
        "title"   => ["required"],
        "content" => ["required"],
    ]);

    if ($err == null) {
        Posts::update($post->post_id, $title, $content);
        redirect("/dashboard");
    }
}

if (isset($_POST["update-image"])) {
    $image = uploadImage();

    if ($image != null) {
        unlink("$public/images/" . $post->image_url);
        Posts::update_image($post->post_id, $image);
        redirect("/dashboard");
    }
}

?>

<main>
    <a class="link" href="/dashboard"><?= $lang->goBack ?></a>
    <form class="form" method="POST">
        <h2><?= $lang->updatePost ?></h2>
        <?php if (isset($err)) : ?>
            <span class="error">
                <?= $err ?>
            </span>
        <?php endif; ?>
        <label>
            <?= $lang->title ?>
            <input type="text" name="title" value="<?= $post->title ?>">
        </label>
        <label>
            <?= $lang->content ?>
            <textarea name="content" rows="5"><?= $post->content ?></textarea>
        </label>
        <input type="hidden" name="_method" value="PUT">
        <input type="hidden" name="csrf" value="<?= $csrf ?>">
        <button name="update-post"><?= $lang->submit ?></button>
    </form>
    <form class="form" method="POST" enctype="multipart/form-data">
        <h2><?= $lang->updateImage ?></h2>
        <?php if (isset($image) && $image == null) : ?>
            <span class="error"><?= $lang->couldNotUploadImage ?></span>
        <?php endif; ?>
        <label>
            <?= $lang->Image ?>
            <input type="file" name="image">
        </label>
        <input type="hidden" name="_method" value="PUT">
        <input type="hidden" name="csrf" value="<?= $csrf ?>">
        <button name="update-image"><?= $lang->submit ?></button>
    </form>
</main>

<?php
component("footer");
?>