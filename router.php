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
    }
?>
