<?php

require_once "$lib/db.php";

class Users {
    static function get_user($username) {
        global $app;

        try {
            $stmt = $app->pdo->prepare("SELECT * FROM users WHERE username = :username");
            $stmt->bindParam(":username", $username);
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_CLASS);
            return count($results) > 0 ? $results[0] : false;
        } catch (PDOException $e) {
            redirect("/500");
        }
    }

    static function create_user($username, $password) {
        global $app;

        $hash = password_hash($password, PASSWORD_DEFAULT);

        try {
            $stmt = $app->pdo->prepare("INSERT INTO users VALUES(:username, :password)");
            $stmt->bindParam(":username", $username);
            $stmt->bindParam(":password", $hash);
            $stmt->execute();
        } catch (PDOException $e) {
            redirect("/500");
        }
    }
}
