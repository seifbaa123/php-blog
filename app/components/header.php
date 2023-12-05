<!DOCTYPE html>
<html lang="<?= $app->lang ?>" dir="<?= $app->dir ?>">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $lang->blog ?> - <?= $lang->home ?></title>
    <link rel="stylesheet" href="/css/reset.css">
    <link rel="stylesheet" href="/css/main.css">
    <link rel="stylesheet" href="/css/navbar.css">
    <link rel="stylesheet" href="/css/posts.css">
    <link rel="stylesheet" href="/css/table.css">
    <link rel="stylesheet" href="/css/form.css">
    <link rel="stylesheet" href="/css/links.css">
    <link rel="stylesheet" href="/css/buttons.css">
    <link href="/fontawesome6/css/all.css" rel="stylesheet">
</head>

<body>
    <nav>
        <form class="search" action="/search">
            <label>
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="text" name="q" value="<?= isset($_GET["q"]) ? $_GET["q"] : '' ?>" placeholder="<?= $lang->search ?>...">
            </label>
        </form>
        <h2><a href="/"><?= $lang->blog ?></a></h2>
        <div class="icons">
            <a href="#"><i class="fa-brands fa-twitter"></i></a>
            <a href="#"><i class="fa-brands fa-reddit-alien"></i></a>
            <a href="#"><i class="fa-brands fa-discord"></i></a>
        </div>
    </nav>