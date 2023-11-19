<?php

require __DIR__ . "/../db.php";

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
            header("Location: /500.php");
            exit();
        }
    }

    static function get_by_id($id)
    {
        global $pdo;

        try {
            $stmt = $pdo->prepare("SELECT * FROM posts WHERE post_id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_CLASS);
            return $results[0];
        } catch (PDOException $e) {
            header("Location: /500.php");
            exit();
        }
    }

    static function create($title, $image, $content, $username)
    {
        global $pdo;

        try {
            $stmt = $pdo->prepare("INSERT INTO posts VALUES (null, :title, :image, :content, :username)");
            $stmt->bindParam(':title', $title);
            $stmt->bindParam(':image', $image);
            $stmt->bindParam(':content', $content);
            $stmt->bindParam(':username', $username);
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_CLASS);
            return $results[0];
        } catch (PDOException $e) {
            header("Location: /500.php");
            exit();
        }
    }
}
