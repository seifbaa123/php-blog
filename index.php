<?php

require "./inc/header.php";
require "./lib/models/posts.php";

$posts = Posts::get_all();

?>

<main>
    <section class="posts">
        <?php foreach ($posts as $index => $post): ?>
            <a href="/post.php?id=<?= $post->post_id ?>" class="post <?= $index === 0 ? 'full-width' : '' ?>">
                <img src="/static/images/<?= $post->image_url ?>" alt="<?= $post->title ?>">
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
include "./inc/footer.php";
?>