<?php

$host = '127.0.0.1';
$dbname = 'blog';
$user = 'root';
$pass = 'root';

try {
    $app->pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    $app->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $app->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    redirect("/500");
}
