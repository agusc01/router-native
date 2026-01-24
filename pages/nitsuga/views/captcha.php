<?php

    require_once 'controllers/captcha-controller.php';
    require_once 'models/captcha-model.php';
    require_once 'config/_index.php';

    [$url, $numbers] = CaptchaController::create();

    echo "<img src='$url' />";
    echo "<h1>$numbers</h1>";

    $captcha = CaptchaController::save($url, $numbers, true);

?>