<?php

require_once "$lib/db.php";

class Posts {
    static function get_all() {
        global $app;

        try {
            $stmt = $app->pdo->prepare("SELECT * FROM posts");
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_CLASS);
            return $results;
        } catch (PDOException $e) {
            redirect("/500");
        }
    }

    static function get_by_other($other) {
        global $app;

        try {
            $stmt = $app->pdo->prepare("SELECT * FROM posts WHERE username = :username");
            $stmt->bindParam(":username", $other);
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_CLASS);
            return $results;
        } catch (PDOException $e) {
            redirect("/500");
        }
    }

    static function get_by_id($id) {
        global $app;

        try {
            $stmt = $app->pdo->prepare("SELECT * FROM posts WHERE post_id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_CLASS);
            return $results[0];
        } catch (PDOException $e) {
            redirect("/500");
        }
    }

    static function search($q) {
        global $app;
        $q = "%" . trim($q) . "%";

        try {
            $stmt = $app->pdo->prepare("SELECT * FROM posts WHERE title LIKE :q");
            $stmt->bindParam(':q', $q);
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_CLASS);
            return $results;
        } catch (PDOException $e) {
            redirect("/500");
        }
    }

    static function get_by_id_and_other($id, $other) {
        global $app;

        try {
            $stmt = $app->pdo->prepare("SELECT * FROM posts WHERE post_id = :id AND username = :other");
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':other', $other);
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_CLASS);
            return $results[0];
        } catch (PDOException $e) {
            redirect("/500");
        }
    }

    static function create($title, $image, $content, $username) {
        global $app;

        try {
            $stmt = $app->pdo->prepare("INSERT INTO posts VALUES (null, :title, :image, :content, :username)");
            $stmt->bindParam(':title', $title);
            $stmt->bindParam(':image', $image);
            $stmt->bindParam(':content', $content);
            $stmt->bindParam(':username', $username);
            $stmt->execute();
        } catch (PDOException $e) {
            redirect("/500");
        }
    }

    static function update($id, $title, $content) {
        global $app;

        try {
            $stmt = $app->pdo->prepare("UPDATE posts SET title = :title, content = :content WHERE post_id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':title', $title);
            $stmt->bindParam(':content', $content);
            $stmt->execute();
        } catch (PDOException $e) {
            redirect("/500");
        }
    }

    static function update_image($id, $image) {
        global $app;

        try {
            $stmt = $app->pdo->prepare("UPDATE posts SET image_url = :image WHERE post_id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':image', $image);
            $stmt->execute();
        } catch (PDOException $e) {
            redirect("/500");
        }
    }

    static function delete($id) {
        global $app;

        try {
            $stmt = $app->pdo->prepare("DELETE FROM posts WHERE post_id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
        } catch (PDOException $e) {
            redirect("/500");
        }
    }
}
