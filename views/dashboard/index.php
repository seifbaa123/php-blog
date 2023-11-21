<?php

require "$LIB/auth.php";

includes("header");
require "$LIB/models/posts.php";

$posts = Posts::get_all();

?>

<main class="dashboard">
    <header>
        <h1>Dashboard</h1>
        <form action="/dashboard/logout" method="POST">
            <button>Logout</button>
        </form>
    </header>

    <a class="link" href="/dashboard/create">Create new post</a>

    <?php if (count($posts) == 0): ?>
        <p style="text-align: center">There is no posts yet!</p>
    <?php else: ?>
        <div class="table">
            <table>
                <thead>
                    <th>#</th>
                    <th>Title</th>
                    <th></th>
                </thead>
                <tbody>
                    <?php foreach ($posts as $post): ?>
                        <tr>
                            <td>
                                <?= $post->post_id ?>
                            </td>
                            <td>
                                <?= $post->title ?>
                            </td>
                            <td>
                                <a class="link success" href="/dashboard/update?id=<?= $post->post_id ?>">update</a>
                                <a class="link danger" href="/dashboard/delete?id=<?= $post->post_id ?>">delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</main>

<?php
includes("footer");
?>