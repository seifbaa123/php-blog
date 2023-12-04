<?php

component("header");
require_once "$lib/models/posts.php";

$posts = Posts::search($_GET["q"]);

?>

<main>
    <section class="posts">
        <?php foreach ($posts as $index => $post) : ?>
            <a href="/post/<?= $post->post_id ?>" class="post <?= $index === 0 ? 'full-width' : '' ?>">
                <img src="/images/<?= $post->image_url ?>" alt="<?= $post->title ?>">
                <div class="content">
                    <h3>
                        <?= $post->title ?>
                    </h3>
                    <p>
                        <?= $post->content ?>
                    </p>
                </div>
            </a>
        <?php endforeach ?>
    </section>
</main>

<?php
component("footer");
?>