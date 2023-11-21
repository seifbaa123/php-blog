<?php

require __DIR__ . "/../includes/header.php";
require __DIR__ . "/../includes/models/posts.php";

$posts = Posts::get_all();

?>

<main>
    <section class="posts">
        <?php foreach ($posts as $index => $post): ?>
            <a href="/post?id=<?= $post->post_id ?>" class="post <?= $index === 0 ? 'full-width' : '' ?>">
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
require __DIR__ . "./inc/footer.php";
?>