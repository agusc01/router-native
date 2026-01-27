<?php
    define('QUIMERA_ROOT', 'pages/quimera/views');

    $routes['localhost'] = 
        [
            [
                'path' => '',
                'router' => function () { return Router::view(QUIMERA_ROOT,'home');}
            ],
            [
                'path' => 'index',
                'router' => function () { return Router::view(QUIMERA_ROOT,'home');}
            ],
            [
                'path' => 'home',
                'router' => function () { return Router::view(QUIMERA_ROOT,'home');}
            ],
            [
                'path' => 'cupoftea',
                'router' => function () { return Router::view(QUIMERA_ROOT,'page-under-maintenance');}
            ],
            [
                'path' => '**',
                'router' => function () { return Router::view(QUIMERA_ROOT,'404');}
            ],
        ];
?>
