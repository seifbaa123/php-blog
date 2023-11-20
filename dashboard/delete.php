<?php

require "../lib/auth.php";

require "../inc/header.php";
require "../lib/models/posts.php";
require "../lib/utils.php";

$post = Posts::get_by_id_and_other($_GET["id"], $username);

if ($post == null) {
    header("Location: /dashboard");
    exit();
}

if (isset($_POST["submit"])) {
    unlink("../static/images/" . $post->image_url);
    Posts::delete($post->post_id);
    header("Location: /dashboard");
    exit();
}

?>

<main>
    <a class="link" href="/dashboard/">go back</a>
    <form class="form" method="POST">
        <h2>Delete image</h2>
        <button name="submit">Submit</button>
    </form>
</main>

<?php
include "../inc/footer.php";
?>