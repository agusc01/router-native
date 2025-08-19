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

    class Middleware
    {
        public static function auth($redirectPath)
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
                'controller' => 
                    [
                        'pointer' => 'LocalHostController::home',
                    ],
            ],
            [
                'path' => 'router-native/index',
                'controller' => 
                    [
                        'pointer' => 'LocalHostController::home',
                    ],
            ],
            [
                'path' => 'router-native/index.php',
                'controller' => 
                    [
                        'pointer' => 'RedirectController::goto',
                        'params' => ['router-native'],
                    ],
            ],
            [
                'path' => 'router-native/greeting',
                'controller' => 
                    [
                        'pointer' => 'LocalHostController::greeting',
                    ],
                'middleware' => 
                    [
                        'pointer' => 'Middleware::auth',
                        'params' => ['router-native/login'],
                    ],
            ],
            [
                'path' => 'router-native/login',
                'controller' => 
                    [
                        'pointer' => 'LocalHostController::login',
                    ],
            ],
            [
                'path' => 'router-native/logout',
                'controller' => 
                    [
                        'pointer' => 'LocalHostController::logout',
                    ],
            ],
            [
                'path' => '**',
                'controller' => 
                    [
                        'pointer' => 'LocalHostController::pageNotFound',
                    ],
            ],
        ],
    ];


    $requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $path = trim($requestUri, '/');

    if (isset($routes[$host]))
    {
        $domainRoutes = array_slice($routes[$host], 0, -1, true);
        echo "<pre style='overflow:auto;height:200px;'>";
        var_dump($domainRoutes);
        var_dump($path);
        echo "</pre>";
        echo "<hr>";

        $domainErrorPage = end($routes[$host]);
        $routeFound = false;

        foreach ($domainRoutes as $route)
        {
            if ($route['path'] === $path)
            {
                $routeFound = true;

                if (isset($route['middleware']))
                {
                    $middleware = $route['middleware'];
                    call_user_func($middleware['pointer'], $middleware['params'][0] ?? null);
                }

                $controller = $route['controller'];
                if (isset($controller['params']))
                {
                    echo call_user_func($controller['pointer'], ...($controller['params'] ?? []));
                }
                else
                {
                    echo call_user_func($controller['pointer']);
                }
                break; 
            }
        }

        if (!$routeFound)
        {
            $controller = $domainErrorPage['controller'];
            echo call_user_func($controller['pointer']);
        }
    }
    else
    {
        echo "404 - Domain not recognized";
    }
?>
