<?php

component("header");
require_once "$lib/models/posts.php";

$posts = Posts::get_by_other($_SESSION["username"]);

?>

<main class="dashboard">
    <header>
        <h1><?= $lang->dashboard ?></h1>
        <form action="/dashboard/logout" method="POST">
            <input type="hidden" name="csrf" value="<?= $csrf ?>">
            <button><?= $lang->logout ?></button>
        </form>
    </header>

    <a class="link" href="/dashboard/create"><?= $lang->createNewPost ?></a>

    <?php if (count($posts) == 0) : ?>
        <p style="text-align: center"><?= $lang->thereIsNoPostsYet ?></p>
    <?php else : ?>
        <div class="table">
            <table>
                <thead>
                    <th>#</th>
                    <th><?= $lang->title ?></th>
                    <th></th>
                </thead>
                <tbody>
                    <?php foreach ($posts as $post) : ?>
                        <tr>
                            <td>
                                <?= $post->post_id ?>
                            </td>
                            <td>
                                <?= $post->title ?>
                            </td>
                            <td>
                                <a class="link success" href="/dashboard/update?id=<?= $post->post_id ?>"><?= $lang->update ?></a>
                                <a class="link danger" href="/dashboard/delete?id=<?= $post->post_id ?>"><?= $lang->delete ?></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</main>

<?php
component("footer");
?>