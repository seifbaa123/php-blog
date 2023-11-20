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

    static function get_by_id_and_other($id, $other)
    {
        global $pdo;

        try {
            $stmt = $pdo->prepare("SELECT * FROM posts WHERE post_id = :id AND username = :other");
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':other', $other);
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
        } catch (PDOException $e) {
            header("Location: /500.php");
            exit();
        }
    }

    static function update($id, $title, $content)
    {
        global $pdo;

        try {
            $stmt = $pdo->prepare("UPDATE posts SET title = :title, content = :content WHERE post_id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':title', $title);
            $stmt->bindParam(':content', $content);
            $stmt->execute();
        } catch (PDOException $e) {
            header("Location: /500.php");
            exit();
        }
    }

    static function update_image($id, $image)
    {
        global $pdo;

        try {
            $stmt = $pdo->prepare("UPDATE posts SET image_url = :image WHERE post_id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':image', $image);
            $stmt->execute();
        } catch (PDOException $e) {
            header("Location: /500.php");
            exit();
        }
    }

    static function delete($id)
    {
        global $pdo;

        try {
            $stmt = $pdo->prepare("DELETE FROM posts WHERE post_id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
        } catch (PDOException $e) {
            header("Location: /500.php");
            exit();
        }
    }
}
