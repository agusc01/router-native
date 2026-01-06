<?php
    
    require_once 'config/_index.php';

    class URL
    {
        public static function redirectTo($path = '')
        {
            header("Location: ".BASE_URL.$path); 
            exit();
        }

        public static function redirectToScript($path = '')
        {
            if (isset($path[0]) && $path[0] === '/')
            {
                $path = substr($path, 1);
            }
            $url = BASE_URL . $path;
            echo "<script>window.location.href='$url'</script>";
        }

        public static function newParameters($parameters = '')
        {
            $currentUrl = (isset($_SERVER['HTTPS']) ? "https://" : "http://") . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
            $currentUrlWithoutParams = strtok($currentUrl, '?');
            header("Location: ".$currentUrlWithoutParams.'?'.$parameters); 
            exit();
        }

        public static function newParametersScript($parameters = '')
        {
            echo "<script>window.location.href=window.location.href.split('?')[0]+'?".$parameters."';</script>";
        }

    }

?>