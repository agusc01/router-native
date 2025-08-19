<?php
    class LocalHostController
    {
        public static function home()
        {
            return "Home page content for localhost";
        }

        public static function greeting()
        {
            if (!isset($_GET['name']))
            {
                return "Hello Anonymous! Welcome to localhost";
            }
            return "Hello, " . htmlspecialchars($_GET['name']) . "! Welcome to localhost";
        }

        public static function pageNotFound()
        {
            return "404 - Page not found.";
        }
    }

    class RedirectController
    {
        public static function goto($path)
        {
            header("Location: /$path/");
            exit();
        }
    }

    $host = $_SERVER['HTTP_HOST'];

    $routes = [
        'localhost' => [
            'router-native' => ['LocalHostController', 'home'],
            'router-native/index' => ['LocalHostController', 'home'],
            'router-native/index.php' => ['RedirectController', 'goto', 'router-native'],
            'router-native/greeting' => ['LocalHostController', 'greeting'],
            '**' => ['LocalHostController', 'pageNotFound'],
        ],
    ];

    $requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $path = trim($requestUri, '/');

    if (isset($routes[$host]))
    {
        $domainRoutes = array_slice($routes[$host], 0, -1, true);
        echo "<pre>";
        var_dump($domainRoutes);
        echo "<hr>";
        var_dump($path);
        echo "</pre>";

        $domainErrorPage = end($routes[$host]);

        if (array_key_exists($path, $domainRoutes))
        {
            $route = $domainRoutes[$path];
            
            if (count($route) === 3)
            {
                call_user_func($route[0] . '::' . $route[1], $route[2]);
            }
            else
            {
                echo call_user_func($route);
            }
        }
        else
        {
            echo call_user_func($domainErrorPage);
        }
    }
    else
    {
        echo "404 - Domain not recognized";
    }
?>
