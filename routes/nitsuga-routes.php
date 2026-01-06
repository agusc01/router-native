<?php
    if(!isset($routes))
    {
        $routes = [];
    }

    $routes['localhost'] = 
        [
            [
                'path' => '',
                'router' => [
                    'pointer' => 'NitsugaRouter::home',
                ],
            ],
            [
                'path' => 'index',
                'router' => [
                    'pointer' => 'NitsugaRouter::home',
                ],
            ],
            [
                'path' => 'home',
                'router' => [
                    'pointer' => 'NitsugaRouter::home',
                ],
            ],
            [
                'path' => 'cupoftea',
                'router' => [
                    'pointer' => 'NitsugaRouter::pageUnderMaintenance',
                ],
            ],
            [
                'path' => 'contact',
                'router' => [
                    'pointer' => 'NitsugaRouter::contact',
                ],
            ],
            [
                'path' => 'colour',
                'router' => [
                    'pointer' => 'NitsugaRouter::colour',
                ],
            ],
            [
                'path' => 'grettings',
                'router' => [
                    'pointer' => 'NitsugaRouter::grettings',
                ],
                'guard' => [
                    'pointer' => 'NitsugaGuard::isAdmin',
                    'params' => ['cupoftea']
                ],
            ],
            [
                'path' => '**',
                'router' => [
                    'pointer' => 'NitsugaRouter::pageNotFound',
                ],
            ],
        ];
?>
