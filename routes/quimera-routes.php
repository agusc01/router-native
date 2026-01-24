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
                    'pointer' => 'QuimeraController::home',
                ],
            ],
            [
                'path' => 'home',
                'router' => [
                    'pointer' => 'QuimeraController::home',
                ],
            ],
            [
                'path' => 'cupoftea',
                'router' => [
                    'pointer' => 'QuimeraController::pageUnderMaintenance',
                ],
            ],
            [
                'path' => '**',
                'router' => [
                    'pointer' => 'QuimeraController::pageNotFound',
                ],
            ],
        ];
?>
