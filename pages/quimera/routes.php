<?php
    define('QUIMERA_ROOT', 'pages/quimera/views');

    $routes['localhost2'] = 
        [
            [
                'path' => '',
                'router' => function () { return Router::view(QUIMERA_ROOT,'index');}
            ],
            [
                'path' => 'index',
                'router' => function () { return Router::view(QUIMERA_ROOT,'index');}
            ],
            [
                'path' => 'home',
                'router' => function () { return Router::view(QUIMERA_ROOT,'index');}
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
