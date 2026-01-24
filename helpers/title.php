<?php 
    class Title
    {
        public static function get() 
        { 
            global $titleCurrentPage; 
            return $titleCurrentPage; 
        }

        public static function set($newTitle) 
        { 
            global $titleCurrentPage; 
            $titleCurrentPage = $newTitle; 
        }
    }
?>