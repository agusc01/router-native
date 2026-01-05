<?php
    if(!isset($routes))
    {
        $routes = [];
    }

    $routes['localhost'] = 
        [
            [
                'path' => '',
                'controller' => [
                    'pointer' => 'NitsugaController::home',
                ],
            ],
            [
                'path' => 'index',
                'controller' => [
                    'pointer' => 'NitsugaController::home',
                ],
            ],
            [
                'path' => 'home',
                'controller' => [
                    'pointer' => 'NitsugaController::home',
                ],
            ],
            [
                'path' => 'cupoftea',
                'controller' => [
                    'pointer' => 'NitsugaController::pageUnderMaintenance',
                ],
            ],
            [
                'path' => '**',
                'controller' => [
                    'pointer' => 'NitsugaController::pageNotFound',
                ],
            ],
        ];
?>
