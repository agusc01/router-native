<?php
    $filesToRequireOnce = glob(__DIR__ . '/*.php');

    if(!isset($routes))
    {
        $routes = [];
    }

    foreach ($filesToRequireOnce as $fileToRequireOnce)
    {
        if (basename($fileToRequireOnce) !== '_index.php')
        {
            require_once $fileToRequireOnce;
        }
    }
?>
