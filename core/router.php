<?php

class Router {
    static private $get_routes;
    static private $post_routes;
    static function GET($url, $view) {
        self::$get_routes[$url] = $view;
    }
    static function POST($url, $view) {
        self::$post_routes[$url] = $view;
    }

    static function get_view() {
        $method = $_SERVER['REQUEST_METHOD'];
        $parsedUrl = parse_url($_SERVER["REQUEST_URI"]);
        $path = $parsedUrl['path'];

        if ($method === "GET" && isset(self::$get_routes[$path])) {
            return "../views/" . self::$get_routes[$path] . ".php";
        }

        if ($method === "POST" && isset(self::$post_routes[$path])) {
            return "../views/" . self::$post_routes[$path] . ".php";
        }

        return __DIR__ . "/../views/404.php";
    }
}
