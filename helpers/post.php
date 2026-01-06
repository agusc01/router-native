<?php
    require_once 'http.php';

    class POST extends HTTP 
    {
        public static function isPOST()
        {
            return $_SERVER["REQUEST_METHOD"] === "POST";
        }
    }
?>
