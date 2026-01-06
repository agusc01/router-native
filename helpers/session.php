<?php
    require_once 'helpers/http.php';
    require_once 'helpers/messages-session.php';

    class SESSION
    {
        use HTTP;
        use MessagesSESSION;
        
        public static function isSESSION()
        {
            return $_SERVER["REQUEST_METHOD"] === "SESSION";
        }
    }
?>
