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
            return count($results) > 0 ? $results[0] : false;
        } catch (PDOException $e) {
            header("Location: /500.php");
            exit();
        }
    }

    static function create_user($username, $password)
    {
        global $pdo;

        $hash = password_hash($password, PASSWORD_DEFAULT);

        try {
            $stmt = $pdo->prepare("INSERT INTO users VALUES(:username, :password)");
            $stmt->bindParam(":username", $username);
            $stmt->bindParam(":password", $hash);
            $stmt->execute();
        } catch (PDOException $e) {
            header("Location: /500.php");
            exit();
        }
    }
}
