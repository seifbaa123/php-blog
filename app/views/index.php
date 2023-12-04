<?php

component("header");
require_once "$lib/models/posts.php";

$posts = Posts::get_all();

?>

<main>
    <section class="posts">
        <?php
        foreach ($posts as $index => $post) :
            component("post", ["post" => $post]);
        endforeach
        ?>
    </section>
</main>

<?php
component("footer");
?>