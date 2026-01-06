<?php
    require_once 'helpers/http.php';
    require_once 'helpers/messages-get.php';

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
