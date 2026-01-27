<?php
    $filesToRequireOnce = glob(__DIR__ . '/pages/*/guards.php');

    foreach ($filesToRequireOnce as $fileToRequireOnce)
    {
        require_once $fileToRequireOnce;
    }
?>