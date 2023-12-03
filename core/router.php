<?php

class Route {
    function __construct(public string $handler, public array $middlewares) {
    }
}

class Router {
    static private $routes = [];

    static function GET(string $url, array $middlewares, callable|string $handler) {
        self::$routes["GET"][$url] = new Route($handler, $middlewares);
    }

    static function POST(string $url, array $middlewares, callable|string $handler) {
        self::$routes["POST"][$url] = new Route($handler, $middlewares);
    }

    static function PUT(string $url, array $middlewares, callable|string $handler) {
        self::$routes["PUT"][$url] = new Route($handler, $middlewares);
    }

    static function PATCH(string $url, array $middlewares, callable|string $handler) {
        self::$routes["PATCH"][$url] = new Route($handler, $middlewares);
    }

    static function DELETE(string $url, array $middlewares, callable|string $handler) {
        self::$routes["DELETE"][$url] = new Route($handler, $middlewares);
    }

    static public function handleRequest() {
        $url = self::getUrl();
        $method = self::getMethod();

        if (isset(self::$routes[$method])) {
            foreach (self::$routes[$method] as $routeUrl => $route) {
                $pattern = self::convertToRegex($routeUrl);

                if (preg_match($pattern, $url, $matches)) {
                    array_shift($matches);
                    $params = self::getParams($routeUrl, $matches);

                    foreach ($route->middlewares as $m) {
                        require __DIR__ . "/../app/middlewares/$m.php";
                    }

                    if (gettype($route->handler) === "string") {
                        return view($route->handler, $params);
                    }

                    call_user_func_array($route->handler, [$params]);
                    return;
                }
            }
        }

        require __DIR__ . "/../app/views/404.php";
    }

    static private function convertToRegex(string $route) {
        $pattern = preg_replace('/:[a-zA-Z0-9]+/', '([^/]+)', $route);
        $pattern = '#^' . $pattern . '$#';
        return $pattern;
    }

    static private function getParams($route, $matches) {
        $params = [];
        $paramNames = [];
        preg_match_all('/:[a-zA-Z0-9]+/', $route, $paramNames);

        foreach ($paramNames[0] as $index => $paramName) {
            $params[trim($paramName, ':')] = $matches[$index];
        }

        return $params;
    }

    static private function getMethod() {
        $method = strtoupper($_SERVER['REQUEST_METHOD']);

        if ($method === "POST") {
            if ($_POST["_method"] === "PUT") return "PUT";
            if ($_POST["_method"] === "PATCH") return "PATCH";
            if ($_POST["_method"] === "DELETE") return "DELETE";
            return "POST";
        }

        return $method;
    }

    static private function getUrl(): string {
        $parsedUrl = parse_url($_SERVER["REQUEST_URI"]);
        return $parsedUrl['path'];
    }
}
