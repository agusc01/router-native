<?php

    class NitsugaRouter
    {
        private static $prefix = 'pages/nitsuga/views';

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

        public static function contact()
        {
            self::includeFile('contact.php');
        }

        public static function database()
        {
            self::includeFile('database.php');
        }
        
        public static function grettings()
        {
            self::includeFile('grettings.php');
        }

        public static function captcha()
        {
            self::includeFile('captcha.php');
        }
        
        public static function pageUnderMaintenance()
        {
            self::includeFile('page-under-maintenance.php');
        }

        public static function home()
        {
            self::includeFile('index.php');
        }

        public static function email()
        {
            self::includeFile('email.php');
        }

        public static function forms()
        {
            self::includeFile('forms.php');
        }
    }

?>

