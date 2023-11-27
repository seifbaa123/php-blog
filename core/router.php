<?php

class Route {
    public function __construct(public $view, public $middlewares) {
    }
}

class Router {
    static private $get_routes;
    static private $post_routes;
    static private $put_routes;
    static private $patch_routes;
    static private $delete_routes;

    static function GET($url, $view, $middlewares = []) {
        self::$get_routes[$url] = new Route($view, $middlewares);
    }
    static function POST($url, $view, $middlewares = []) {
        self::$post_routes[$url] = new Route($view, $middlewares);
    }

    static function PUT($url, $view, $middlewares = []) {
        self::$put_routes[$url] = new Route($view, $middlewares);
    }

    static function PATCH($url, $view, $middlewares = []) {
        self::$patch_routes[$url] = new Route($view, $middlewares);
    }

    static function DELETE($url, $view, $middlewares = []) {
        self::$delete_routes[$url] = new Route($view, $middlewares);
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

        $route = null;
        if ($method === "POST" && isset(self::$post_routes[$path])) {
            $route = self::$post_routes[$path];
        } else if (($method === "PUT" || ctype_upper($_POST["_method"]) == "PUT") && isset(self::$put_routes[$path])) {
            $route = self::$put_routes[$path];
        } else if (($method === "PATCH" || ctype_upper($_POST["_method"]) == "PATCH") && isset(self::$patch_routes[$path])) {
            $route = self::$patch_routes[$path];
        } else if (($method === "DELETE" || ctype_upper($_POST["_method"]) == "DELETE") && isset(self::$delete_routes[$path])) {
            $route = self::$delete_routes[$path];
        }

        if ($route != null) {
            foreach ($route->middlewares as $m) {
                require_once __DIR__ . "/../middlewares/$m.php";
            }

            if ($_POST["csrf"] != $_SESSION["csrf"]) {
                echo "<h1>invalid csrf token!</h1>";
                exit();
            }
            return "../views/" . $route->view . ".php";
        }

        return __DIR__ . "/../views/404.php";
    }
}
