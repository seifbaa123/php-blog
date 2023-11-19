<?php

require "../lib/auth.php";

require "../inc/header.php";
require "../lib/models/posts.php";


?>

<main class="dashboard">
    <header>
        <h1>Dashboard</h1>
        <form action="/dashboard/logout.php" method="POST">
            <button>Logout</button>
        </form>
    </header>
</main>

<?php
include "../inc/footer.php";
?>