<?php

    session_start();
    require_once 'router/_index.php';
    require_once 'guards/_index.php';
    require_once 'routes/_index.php';
    require_once 'config/_index.php';

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
            $path = MAIN_FOLDER . ($route['path'] === '' ? '' : '/') . $route['path'];

            if ($path === $currentPath)
            {
                $routeFound = true;

                if (isset($route['guard']))
                {
                    $guard = $route['guard'];

                    if (isset($guard['params']))
                    {
                        call_user_func($guard['pointer'], ...($guard['params'] ?? []));
                    }
                    else
                    {
                        echo call_user_func($guard['pointer']);
                    }
                }

                $router = $route['router'];
                if (isset($router['params']))
                {
                    echo call_user_func($router['pointer'], ...($router['params'] ?? []));
                }
                else
                {
                    echo call_user_func($router['pointer']);
                }
                break;
            }
        }

        if (!$routeFound)
        {
            $router = $domainErrorPage['router'];
            echo call_user_func($router['pointer']);
        }
    }
    else
    {
        echo "404 - Domain not recognized";
    }
?>
