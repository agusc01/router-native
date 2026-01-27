<?php

    if (session_status() === PHP_SESSION_NONE)
    {
        session_start();
    }

    require_once 'router.php';
    require_once 'routes.php';
    require_once 'guards/_index.php';
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

    // var_dump($currentPath);

    if (isset($routes[$host]))
    {
        $domainRoutes = array_slice($routes[$host], 0, -1, true);
        $domainErrorPage = end($routes[$host]);
        $routeFound = false;

        foreach ($domainRoutes as $route)
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
                foreach ($route['children'] as $childRoute)
                {

                    $childPath = $path . ($childRoute['path'] === '' ? '':  '/' . $childRoute['path']);

                    if ($childPath === $currentPath)
                    {
                        $routeFound = true;

                        if (isset($route['guard'])) { $route['guard'](); }
                        require_once 'includes/title.php';
                        $childRoute['router']();
                        break 2; // Break out of both loops
                    }

                }
            }
        }

        if (!$routeFound)
        {
            $route = $domainErrorPage; // Doing this for 'includes/title.php'
            require_once 'includes/title.php';
            $route['router']();
        }
    } else {
        echo "404 - Domain not recognized";
    }

?>
