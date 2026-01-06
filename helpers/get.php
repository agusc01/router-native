<?php
    require_once 'http.php';
    require_once 'messages-get.php';

    class GET
    {
        use HTTP;
        use MessagesGET;
        
        public static function isGET()
        {
            return $_SERVER["REQUEST_METHOD"] === "GET";
        }
    }
?>
