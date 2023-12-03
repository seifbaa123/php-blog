<?php
$post = $params["post"];
?>

<a href="/post/<?= $post->post_id ?>" class="post">
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