<?php

    if($_SERVER['HTTP_HOST'] != 'localhost')
    {
        define('MAIN_FOLDER', '');
        error_reporting(E_ALL);
        ini_set('display_errors', 1);    
    }
    else
    {
        define('MAIN_FOLDER', 'router-native');
        error_reporting(E_ALL);
        ini_set('display_errors', 1);    
    }

?>