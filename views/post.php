<?php

require "./inc/header.php";
require "./lib/models/posts.php";

$post = Posts::get_by_id($_GET["id"]);

?>

<main class="single-post">
    <?php if ($post != null): ?>
        <h1>
            <?= $post->title ?>
        </h1>
        <img src="./static/images/<?= $post->image_url ?>" alt="<?= $post->title ?>" />
        <p>
            <?= $post->content ?>
        </p>
    <?php else: ?>
        <h1>Post not found</h1>
    <?php endif; ?>
</main>

<?php
require "./inc/footer.php";
?>