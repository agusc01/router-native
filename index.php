<?php
    session_start(); 
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

        public static function login()
        {
            if ($_SERVER['REQUEST_METHOD'] === 'POST')
            {
                $username = $_POST['username'] ?? '';
                $password = $_POST['password'] ?? '';

                if ($username === 'admin' && $password === 'password')
                {
                    $_SESSION['authenticated'] = true;
                    header("Location: /router-native/");
                    exit();
                }
                else
                {
                    return "Invalid credentials!";
                }
            }
            return '<form method="POST">
                        Username: <input type="text" name="username" required>
                        Password: <input type="password" name="password" required>
                        <button type="submit">Login</button>
                    </form>';
        }

        public static function logout()
        {
            session_destroy();
            header("Location: /router-native/login");
            exit();
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

    class LocalHostMiddleware
    {
        public static function auth($redirectPath = 'router-native/login')
        {
            if (!isset($_SESSION['authenticated']))
            {
                header("Location: /$redirectPath");
                exit();
            }
        }
    }

    $host = $_SERVER['HTTP_HOST'];

    $routes = [
        'localhost' => [
            [
                'path' => 'router-native',
                'controller' => 'LocalHostController::home',
            ],
            [
                'path' => 'router-native/index',
                'controller' => 'LocalHostController::home',
            ],
            [
                'path' => 'router-native/index.php',
                'controller' => 'RedirectController::goto',
                'params' => ['router-native'],
            ],
            [
                'path' => 'router-native/greeting',
                'controller' => 'LocalHostController::greeting',
                'middleware' => 'LocalHostMiddleware::auth',
            ],
            [
                'path' => 'router-native/greeting2',
                'controller' => 'LocalHostController::greeting',
            ],
            [
                'path' => 'router-native/login',
                'controller' => 'LocalHostController::login',
            ],
            [
                'path' => 'router-native/logout',
                'controller' => 'LocalHostController::logout',
            ],
            [
                'path' => '**',
                'controller' => 'LocalHostController::pageNotFound',
            ],
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
        $routeFound = false;

        foreach ($domainRoutes as $route)
        {
            if ($route['path'] === $path)
            {
                $routeFound = true;

                if (isset($route['middleware']) && $route['middleware'] !== null)
                {
                    if(isset($route['redirect']) && $route['redirect'] !== null)
                    {
                        call_user_func($route['middleware'], $route['redirect']);
                    }
                    else
                    {
                        call_user_func($route['middleware']);
                    }
                }

                if (isset($route['params']) && count($route['params']) > 0)
                {
                    echo call_user_func($route['controller'], ...$route['params']);
                }
                else
                {
                    echo call_user_func($route['controller']);
                }
                break;
            }
        }

        if(!$routeFound)
        {
            echo call_user_func($domainErrorPage['controller']);
        }
    }

?>