<?php

require "../lib/auth.php";

require "../inc/header.php";
require "../lib/models/posts.php";

$posts = Posts::get_all();

?>

<main class="dashboard">
    <header>
        <h1>Dashboard</h1>
        <form action="/dashboard/logout.php" method="POST">
            <button>Logout</button>
        </form>
    </header>

    <div class="table">

        <?php if (count($posts) == 0): ?>
            <p style="text-align: center">There is no posts yet!</p>
        <?php else: ?>
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
                                <?= $post->id ?>
                            </td>
                            <td>
                                <?= $post->title ?>
                            </td>
                            <td>
                                <a class="link success" href="/dashboard/update?id=<?= $post->id ?>">update</a>
                                <a class="link danger" href="/dashboard/delete?id=<?= $post->id ?>">delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</main>

<?php
include "../inc/footer.php";
?>