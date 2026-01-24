<?php
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
                'path' => 'database',
                'router' => [
                    'pointer' => 'NitsugaRouter::database',
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
                'path' => 'captcha',
                'router' => [
                    'pointer' => 'NitsugaRouter::captcha',
                ],
            ],
            [
                'path' => 'email',
                'router' => [
                    'pointer' => 'NitsugaRouter::email',
                ],
            ],
            [
                'path' => 'forms',
                'router' => [
                    'pointer' => 'NitsugaRouter::forms',
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
