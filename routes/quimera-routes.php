<?php
    $routes['localhost2'] = 
        [
            [
                'path' => '',
                'router' => [
                    'pointer' => 'QuimeraRouter::home',
                ],
            ],
            [
                'path' => 'index',
                'router' => [
                    'pointer' => 'QuimeraRouter::home',
                ],
            ],
            [
                'path' => 'home',
                'router' => [
                    'pointer' => 'QuimeraRouter::home',
                ],
            ],
            [
                'path' => 'cupoftea',
                'router' => [
                    'pointer' => 'QuimeraRouter::pageUnderMaintenance',
                ],
            ],
            [
                'path' => '**',
                'router' => [
                    'pointer' => 'QuimeraRouter::pageNotFound',
                ],
            ],
        ];
?>
