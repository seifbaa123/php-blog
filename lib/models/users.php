<?php

require __DIR__ . "/../db.php";

class Users
{
    static function get_user($username)
    {
        global $pdo;

        try {
            $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
            $stmt->bindParam(":username", $username);
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_CLASS);
            return $results[0];
        } catch (PDOException $e) {
            header("Location: /500.php");
            exit();
        }
    }
}
