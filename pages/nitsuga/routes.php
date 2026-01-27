<?php
    define('NITSUGA_ROOT', 'pages/nitsuga/views');

    $routes['localhost'] = 
        [
            [
                'path' => '',
                'router' => function() { return Router::view(NITSUGA_ROOT, 'index'); },
                'title' => 'Start',
            ],
            [
                'path' => 'index',
                'router' => function() { return Router::view(NITSUGA_ROOT, 'index'); },
                'title' => 'Index',
            ],
            [
                'path' => 'home',
                'router' => function() { return Router::view(NITSUGA_ROOT, 'index'); },
                'title' => 'Home',
            ],
            [
                'path' => 'cupoftea',
                'router' => function() { return Router::view(NITSUGA_ROOT, 'page-under-maintenance'); },
                'title' => 'Want a cup of tea, Mate ?',
            ],
            [
                'path' => 'contact',
                'router' => function() { return Router::view(NITSUGA_ROOT, 'contact'); },
                'title' => 'Contact',
            ],
            [
                'path' => 'database',
                'router' => function() { return Router::view(NITSUGA_ROOT, 'database'); },
                'title' => 'Database Adapter',
            ],
            [
                'path' => 'grettings',
                'router' => function() { return Router::view(NITSUGA_ROOT, 'grettings'); },
                'title' => 'Using GET',
            ],
            [
                'path' => 'captcha',
                'router' => function() { return Router::view(NITSUGA_ROOT, 'captcha'); },
                'title' => 'Are you a robot ?',
            ],
            [
                'path' => 'email',
                'router' => function() { return Router::view(NITSUGA_ROOT, 'email'); },
                'title' => 'SPAM',
            ],
            [
                'path' => 'forms',
                'router' => function() { return Router::view(NITSUGA_ROOT, 'forms'); },
                'title' => 'Validations',
            ],
            [
                'path' => 'title',
                'router' => function() { return Router::view(NITSUGA_ROOT, 'title'); },
                'title' => 'Title from routes',
            ],
            [
                'path' => 'file',
                'router' => function() { return Router::view(NITSUGA_ROOT, 'file'); },
                'title' => 'File things',
            ],      
            [
                'path' => 'database-excel',
                'router' => function() { return Router::view(NITSUGA_ROOT, 'database-excel'); },
                'title' => "Download Colour's Database",
            ],
            [
                'path' => 'database-pdf',
                'router' => function() { return Router::view(NITSUGA_ROOT, 'database-pdf'); },
                'title' => "Download Colour's Database",
            ],    
            [
                'path' => 'login',
                'router' => function() { return Router::view(NITSUGA_ROOT, 'login'); },
                'title' => "Authorized Users Only",
            ],
            [
                'path' => 'logout',
                'router' => function() { return Router::view(NITSUGA_ROOT, 'logout'); },
                'title' => "Bye Bye",
                'guard' => function () { return NitsugaGuard::isLogged('index'); },
            ],
            [
                'path' => 'auth',
                'children' => [
                    [
                        'path' => '',
                        'router' => function() { return Router::view(NITSUGA_ROOT, 'auth/dashboard'); },
                        'title' => "Admins only",
                    ],
                    [
                        'path' => 'dashboard',
                        'router' => function() { return Router::redirectTo('auth'); },
                        'title' => "Admins only",
                    ],
                    [
                        'path' => 'info',
                        'router' => function() { return Router::view(NITSUGA_ROOT, 'auth/info'); },
                        'title' => "Admins only",
                    ]
                ],
                'guard' => function () { return NitsugaGuard::isAdmin('login'); },
            ],              
            [
                'path' => 'protected',
                'router' => function() { return Router::view(NITSUGA_ROOT, 'protected'); },
                'guard' => function () { return NitsugaGuard::isCustomer('404'); },
                'title' => 'This URL is protected',
            ],
            [
                'path' => '404',
                'router' => function() { return Router::view(NITSUGA_ROOT, '404'); },
                'title' => 'Not Found Mate !',
            ],
            [
                'path' => '**',
                'router' => function() { return Router::view(NITSUGA_ROOT, '404'); },
                'title' => 'Error: Page not found',
            ],
        ];
?>
