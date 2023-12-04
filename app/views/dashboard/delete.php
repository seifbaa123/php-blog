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
    <a class="link" href="/dashboard">go back</a>
    <form class="form" method="POST">
        <h2>Delete post</h2>
        <p style="margin-bottom: .75rem">Are you sure you want to delete this post.</p>
        <button class="danger" name="submit">Delete</button>
        <button class="secondary" name="submit" type="button" onclick="location = '/dashboard'">Cancel</button>
        <input type="hidden" name="_method" value="DELETE">
        <input type="hidden" name="csrf" value="<?= $csrf ?>">
    </form>
</main>

<?php
component("footer");
?>