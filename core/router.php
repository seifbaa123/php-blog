<?php

class Route {
    public function __construct(public $view, public $middlewares) {
    }
}

class Router {
    static private $get_routes;
    static private $post_routes;
    static function GET($url, $view, $middlewares = []) {
        self::$get_routes[$url] = new Route($view, $middlewares);
    }
    static function POST($url, $view, $middlewares = []) {
        self::$post_routes[$url] = new Route($view, $middlewares);
    }

    static function get_view() {
        $method = $_SERVER['REQUEST_METHOD'];
        $parsedUrl = parse_url($_SERVER["REQUEST_URI"]);
        $path = $parsedUrl['path'];

        if ($method === "GET" && isset(self::$get_routes[$path])) {
            foreach (self::$get_routes[$path]->middlewares as $m) {
                require_once __DIR__ . "/../middlewares/$m.php";
            }

            return "../views/" . self::$get_routes[$path]->view . ".php";
        }

        if ($method === "POST" && isset(self::$post_routes[$path])) {
            foreach (self::$get_routes[$path]->middlewares as $m) {
                require_once __DIR__ . "/../middlewares/$m.php";
            }

            if ($_POST["csrf"] != $_SESSION["csrf"]) {
                redirect("/500");
            }
            return "../views/" . self::$post_routes[$path]->view . ".php";
        }

        return __DIR__ . "/../views/404.php";
    }
}
