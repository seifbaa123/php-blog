<?php

component("/header");
require_once "$lib/models/posts.php";

$post = Posts::get_by_id_and_other($_GET["id"], $_SESSION["username"]);

if ($post == null) {
    redirect("/dashboard");
}

if (isset($_POST["submit"])) {
    unlink("../../public/images/" . $post->image_url);
    Posts::delete($post->post_id);
    redirect("/dashboard");
}

?>

<main>
    <a class="link" href="/dashboard"><?= $lang->goBack ?></a>
    <form class="form" method="POST">
        <h2><?= $lang->deletePost ?></h2>
        <p style="margin-bottom: .75rem"><?= $lang->AreYouSureYouWantToDeleteThisPost ?></p>
        <button class="danger" name="submit"><?= $lang->delete ?></button>
        <button class="secondary" name="submit" type="button" onclick="location = '/dashboard'"><?= $lang->cancel ?></button>
        <input type="hidden" name="_method" value="DELETE">
        <input type="hidden" name="csrf" value="<?= $csrf ?>">
    </form>
</main>

<?php
component("footer");
?>