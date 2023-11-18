<?php

require "./lib/db.php";

class Posts
{
    static function get_all()
    {
        global $pdo;

        try {
            $stmt = $pdo->prepare("SELECT * FROM posts");
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_CLASS);
            return $results;
        } catch (PDOException $e) {
            header("Location: ./500.php");
            exit();
        }
    }
}
