<?php
    $filesToRequireOnce = glob(__DIR__ . '/*.php');

    foreach ($filesToRequireOnce as $fileToRequireOnce)
    {
        if (basename($fileToRequireOnce) !== '_index.php')
        {
            require_once $fileToRequireOnce;
        }
    }
?>
