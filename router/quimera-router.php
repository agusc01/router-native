<?php

    class QuimeraRouter
    {
        private static $prefix = 'pages/quimera';

        public static function includeFile($fileName)
        {
            $pathFile = self::$prefix . '/' . $fileName;

            if (file_exists($pathFile))
            {
                require_once $pathFile;
            }
            else
            {
                include_once self::$prefix.'/404.php';
            }
        }

        public static function pageNotFound()
        {
            self::includeFile('404.php');
        }

        public static function pageUnderMaintenance()
        {
            self::includeFile('page-under-maintenance.php');
        }

        public static function home()
        {
            self::includeFile('index.php');
        }
    }

?>

