<?php 
    function getGlobalTitle () 
    { 
        global $titleCurrentPage ; 
        return $titleCurrentPage; 
    }
    echo getGlobalTitle();
?>