<?php
    require_once 'http.php';
    require_once 'messages-session.php';

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
