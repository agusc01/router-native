<?php

    if (session_status() === PHP_SESSION_NONE)
    {
        session_start();
    }

    require_once 'router.php';
    require_once 'routes.php';
    require_once 'guards.php';
    require_once 'config/_index.php';

    $host = str_replace('www.', '', $_SERVER['HTTP_HOST']);
    $requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $currentPath = trim($requestUri, '/');
    $currentPath = str_replace('//', '/', $currentPath);

    if ($_SERVER['HTTP_HOST'] != 'localhost')
    {
        if ($currentPath[0] !== '/' && strlen($currentPath) > 1)
        {
            $currentPath = '/' . $currentPath;
        }
    }

    if (isset($routes[$host]))
    {
        $routeErrorPage = Router::catchRouteByPath($routes[$host], '**');

        $routeFound = false;

        foreach ($routes[$host] as $route)
        {
            $path = Router::concatPath(MAIN_FOLDER, $route['path'] ?? '');

            if ($path === $currentPath && !isset($route['children']))
            {
                $routeFound = true;
                return Router::render($route);
            }

            if (isset($route['children']))
            {
                foreach ($route['children'] as $childrenRoute)
                {
                    $childrenPath = Router::concatPath($path, $childrenRoute['path'] ?? '');
                    $childrenRouteErrorPage = Router::catchRouteByPath($route['children'], '**');

                    if ($childrenPath === $currentPath)
                    {
                        $routeFound = true;

                        if (isset($route['guard'])) { $route['guard'](); }
                        if (isset($childrenRoute['guard'])) { $childrenRoute['guard'](); } // TODO: test
                        $childrenRoute['title'] = isset($childrenRoute['title']) ? $childrenRoute['title'] : ($route['title'] ?? ''); 

                        return Router::render($childrenRoute);
                    }
                }

                // TODO: It's not working as it have it
                // It must show ChildrenRouterErrorPage when you are inside 'root (route) path'
                // if(!$routeFound && $childrenRouteErrorPage)
                // {
                //     Router::render($childrenRouteErrorPage);
                // }
            }
        }

        if (!$routeFound)
        {
            if(!$routeErrorPage) 
            {
                echo '404 - Page not found.,';
                return;
            }
            Router::render($routeErrorPage);
        }
    } 
    else
    {
        echo "404 - Domain not recognized";
    }

?>