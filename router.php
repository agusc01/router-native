<?php

    class Router
    {
        public static function view($prefix, $fileName)
        {
            $pathFile = "$prefix/$fileName.php";

            if (file_exists($pathFile))
            {
                require_once $pathFile;
            }
            else
            {
                include_once "$prefix/404.php";
            }
        }

        public static function redirectTo($path)
        {
            header("Location: ".BASE_URL.$path); 
            exit();
        }

        public static function catchRouteByPath($routes, $path)
        {
            $route = array_filter($routes, function($route) use ($path) { return $route['path'] === $path; });
            return !empty($route) ? array_values($route)[0] : null;
        }

        public static function render($route)
        {
            require_once 'helpers/title.php';
                
            if (isset($route['guard'])) { $route['guard'](); }
            
            $defaultTitle = WebsiteController::current()->nameWebsite ?? '';
            $titleCurrentPage = $defaultTitle . ' | '  . ($route['title'] ??  DEFAULT_TITLE_MSG);
            Title::set($titleCurrentPage);

            $route['router']();
        }

        public static function concatPath($prefix, $path)
        {
            $newPath = ($path === '' ? '':  '/' . $path);
            return $prefix.$newPath;
        }
    }
?>
