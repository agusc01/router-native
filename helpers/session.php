<?php
    require_once 'http.php';

    class SESSION
    {
        use HTTP;
        
        public static function isSESSION()
        {
            return $_SERVER["REQUEST_METHOD"] === "SESSION";
        }
    }
?>
