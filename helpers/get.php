<?php
    require_once 'http.php';

    class GET extends HTTP 
    {
        public static function isGET()
        {
            return $_SERVER["REQUEST_METHOD"] === "GET";
        }
    }
?>
