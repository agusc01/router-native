<?php
    $routes['localhost'] = 
        [
            [
                'path' => '',
                'router' => [
                    'pointer' => 'NitsugaRouter::home',
                ],
                'title' => 'Start',
            ],
            [
                'path' => 'index',
                'router' => [
                    'pointer' => 'NitsugaRouter::home',
                ],
                'title' => 'Index',
            ],
            [
                'path' => 'home',
                'router' => [
                    'pointer' => 'NitsugaRouter::home',
                ],
                'title' => 'Home',
            ],
            [
                'path' => 'cupoftea',
                'router' => [
                    'pointer' => 'NitsugaRouter::pageUnderMaintenance',
                ],
                'title' => 'Want a cup of tea, Mate ?',
            ],
            [
                'path' => 'contact',
                'router' => [
                    'pointer' => 'NitsugaRouter::contact',
                ],
                'title' => 'Contact',
            ],
            [
                'path' => 'database',
                'router' => [
                    'pointer' => 'NitsugaRouter::database',
                ],
                'title' => 'Database Adapter',
            ],
            [
                'path' => 'grettings',
                'router' => [
                    'pointer' => 'NitsugaRouter::grettings',
                ],
                'title' => 'Using GET',
            ],
            [
                'path' => 'captcha',
                'router' => [
                    'pointer' => 'NitsugaRouter::captcha',
                ],
                'title' => 'Are you a robot ?',
            ],
            [
                'path' => 'email',
                'router' => [
                    'pointer' => 'NitsugaRouter::email',
                ],
                'title' => 'SPAM',
            ],
            [
                'path' => 'forms',
                'router' => [
                    'pointer' => 'NitsugaRouter::forms',
                ],
                'title' => 'Validations',
            ],
            [
                'path' => 'title',
                'router' => [
                    'pointer' => 'NitsugaRouter::title',
                ],
                'title' => 'Title from routes',
            ],
            [
                'path' => 'file',
                'router' => [
                    'pointer' => 'NitsugaRouter::file',
                ],
                'title' => 'File things',
            ],      
            [
                'path' => 'database-excel',
                'router' => [
                    'pointer' => 'NitsugaRouter::databaseExcel',
                ],
                'title' => "Download Colour's Database",
            ],         
            [
                'path' => 'protected',
                'router' => [
                    'pointer' => 'NitsugaRouter::protected',
                ],
                'guard' => [
                    'pointer' => 'NitsugaGuard::isAdmin',
                    'params' => ['404']
                    // 'params' => ['cupoftea']
                ],
                'title' => 'This URL is protected',
            ],
            [
                'path' => '404',
                'router' => [
                    'pointer' => 'NitsugaRouter::pageNotFound',
                ],
                'title' => 'Not Found Mate !',
            ],
            [
                'path' => '**',
                'router' => [
                    'pointer' => 'NitsugaRouter::pageNotFound',
                ],
                'title' => 'Error: Page not found',
            ],
        ];
?>
