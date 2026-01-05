<?php

    session_start();
    require_once 'controllers/_index.php';
    require_once 'routers/_index.php';

    if($_SERVER['HTTP_HOST'] != 'localhost')
    {
        define('MAIN_FOLDER_APP', '');
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
    }
    else
    {
        define('MAIN_FOLDER_APP', 'routes');
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
    }

    $host = str_replace('www.', '', $_SERVER['HTTP_HOST']);

    $requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $currentPath = trim($requestUri, '/');
    $currentPath = str_replace('//','/', $currentPath);

    if($_SERVER['HTTP_HOST'] != 'localhost')
    {
        if ($currentPath[0] !== '/' && strlen($currentPath) > 1)
        {
            $currentPath = '/' . $currentPath;
        }
    }

    // echo "<pre>";
    // var_dump($currentPath);
    // var_dump($host);
    // var_dump($routes);
    // var_dump($routes[$host]);
    // echo "</pre>";

    if (isset($routes[$host]))
    {
        $domainRoutes = array_slice($routes[$host], 0, -1, true);
        $domainErrorPage = end($routes[$host]);
        $routeFound = false;

        foreach ($domainRoutes as $route)
        {
            $path = MAIN_FOLDER_APP . ($route['path'] === '' ? '' : '/') . $route['path'];

            if ($path === $currentPath)
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
