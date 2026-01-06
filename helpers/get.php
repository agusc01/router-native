<?php
    require_once 'http.php';

    class GET
    {
        use HTTP;
        
        public static function isGET()
        {
            return $_SERVER["REQUEST_METHOD"] === "GET";
        }
    }
?>
