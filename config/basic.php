<?php

    if($_SERVER['HTTP_HOST'] != 'localhost')
    {
        define('MAIN_FOLDER', '');
        error_reporting(E_ALL);
        ini_set('display_errors', 1);

        define('SERVER_HTTP_HOST', str_replace('www.', '', $_SERVER['HTTP_HOST']));
        define('BASE_URL', 'https://'.SERVER_HTTP_HOST.'/');

        define('DB_NAME', 'c2751438_ddbb0');
        define('DB_HOST', 'localhost');
        define('DB_USER', 'c2751438_ddbb0');
        define('DB_PASS', 'kazeKUte67');
    
        define('DEFAULT_MINUTES_TO_DELETE_CAPTCHAS', 10);
        define('DEFAULT_MINUTES_TO_DELETE_SESSION', 10);
        
        define('SHOW_ERRORS_BASIC', 0); //= false;
        define('SHOW_ERRORS_COMPLETE', 0); //= false;
        define('SEND_EMAIL', 1); //=true
    }
    else
    {
        define('MAIN_FOLDER', 'router-native');
        error_reporting(E_ALL);
        ini_set('display_errors', 1);

        define('SERVER_HTTP_HOST', "fakewebsite.com");
        define('BASE_URL', 'http://localhost/' . MAIN_FOLDER . '/');

        define('DB_NAME', 'c2751438_ddbb0');
        define('DB_HOST', 'localhost');
        define('DB_USER', 'root');
        define('DB_PASS', '');

        define('DEFAULT_MINUTES_TO_DELETE_CAPTCHAS', 2);
        define('DEFAULT_MINUTES_TO_DELETE_SESSION', 2);

        define('SHOW_ERRORS_BASIC', 1); //= true;
        define('SHOW_ERRORS_COMPLETE', 1); //= true;
        define('SEND_EMAIL', 0); //=false
    }
    
    // const ALLOWED_IMAGE_EXTENSIONS = ['jpg', 'jpeg', 'png', 'gif'];
    const ALLOWED_IMAGE_EXTENSIONS = ['jpg', 'jpeg', 'png'];
    const ALLOWED_PDF_EXTENSIONS = ['pdf'];
    const ALLOWED_WORD_EXTENSIONS = ['doc', 'docx'];
    const ALLOWED_EXCEL_EXTENSIONS = ['xls', 'xlsx'];
    define('DEFAULT_TITLE_MSG', 'Welcome !');
    define('CAPTCHA_URL_INPUT', 'assets/captcha/');
    define('CAPTCHA_URL_OUTPUT', 'assets/captcha/randoms/');
    define('SHOW_ERRORS_MESSAGE', '<br><h1 style="color:red;text-align:center">An error occurred. Please send an email to administration explaining what happened so they can fix it. Thank you.</h1>');

?>