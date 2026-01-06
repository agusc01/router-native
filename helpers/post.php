<?php
    require_once 'http.php';
    require_once 'messages-post.php';

    class POST
    {
        use HTTP;
        use MessagesPOST;
        
        public static function isPOST()
        {
            return $_SERVER["REQUEST_METHOD"] === "POST";
        }
    }
?>
