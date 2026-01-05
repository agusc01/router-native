<?php
    if(!isset($routes))
    {
        $routes = [];
    }

    $routes['localhost2'] = 
        [
            [
                'path' => '',
                'controller' => [
                    'pointer' => 'QuimeraController::home',
                ],
            ],
            [
                'path' => 'index',
                'controller' => [
                    'pointer' => 'QuimeraController::home',
                ],
            ],
            [
                'path' => 'home',
                'controller' => [
                    'pointer' => 'QuimeraController::home',
                ],
            ],
            [
                'path' => 'cupoftea',
                'controller' => [
                    'pointer' => 'QuimeraController::pageUnderMaintenance',
                ],
            ],
            [
                'path' => '**',
                'controller' => [
                    'pointer' => 'QuimeraController::pageNotFound',
                ],
            ],
        ];
?>
