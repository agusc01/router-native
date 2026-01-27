<?php
    $filesToRequireOnce = glob(__DIR__ . '/pages/*/routes.php');

    if (!isset($routes))
    {
        $routes = [];
    }

    foreach ($filesToRequireOnce as $fileToRequireOnce)
    {
        require_once $fileToRequireOnce;
    }
?>
