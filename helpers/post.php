<?php
    require_once 'http.php';

    class POST
    {
        use HTTP;
        
        public static function isPOST()
        {
            return $_SERVER["REQUEST_METHOD"] === "POST";
        }
    }
?>
