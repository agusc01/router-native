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
        $routeErrorPage = array_filter($routes[$host], function($route) { return $route['path'] === '**'; });
        $routeErrorPage = !empty($routeErrorPage) ? array_values($routeErrorPage)[0] : null;

        $routeFound = false;

        foreach ($routes[$host] as $route)
        {
            $path = MAIN_FOLDER . ($route['path'] === '' ? '' : '/') . $route['path'];

            if ($path === $currentPath && !isset($route['children']))
            {
                $routeFound = true;

                if (isset($route['guard'])) { $route['guard'](); }
                require_once 'includes/title.php';
                $route['router']();
                break;
            }

            if (isset($route['children']))
            {
                foreach ($route['children'] as $childrenRoute)
                {

                    $childrenPath = $path . ($childrenRoute['path'] === '' ? '':  '/' . $childrenRoute['path']);
                    $childrenRouteErrorPage = array_filter($route['children'], function($childrenRoute) { 
                        return $childrenRoute['path'] === '**'; 
                    });
                    $childrenRouteErrorPage = !empty($childrenRouteErrorPage) ? array_values($childrenRouteErrorPage)[0] : null;

                    if ($childrenPath === $currentPath)
                    {
                        $routeFound = true;

                        if (isset($route['guard'])) { $route['guard'](); }
                        if (isset($childrenRoute['guard'])) { $childrenRoute['guard'](); } // TODO: test

                        // Doing this for 'includes/title.php'
                        $route['title'] = isset($childrenRoute['title']) ? $childrenRoute['title'] : $route['title']; 
                        require_once 'includes/title.php';

                        $childrenRoute['router']();
                        break 2; // Break out of both loops
                    }

                }

                if(!$routeFound && $childrenRouteErrorPage)
                {
                    $route = $childrenRouteErrorPage; // Doing this for 'includes/title.php'
                    require_once 'includes/title.php';
                    $route['router']();
                }
            }
        }

        if (!$routeFound)
        {
            if(!$routeErrorPage) 
            {
                echo '404 - Page not found.,';
                return;
            }
            $route = $routeErrorPage; // Doing this for 'includes/title.php'
            require_once 'includes/title.php';
            $route['router']();
        }
    } 
    else
    {
        echo "404 - Domain not recognized";
    }

?>
