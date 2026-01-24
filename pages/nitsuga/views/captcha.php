<?php

    require_once 'controllers/captcha-controller.php';

    [$url, $numbers] = CaptchaController::create();

    echo "Captcha. Nitsuga <hr>";
    include_once 'pages/nitsuga/views/components/navbar.php';
    echo "<img src='$url' />";
    echo "<h1>$numbers</h1>";

    $captcha = CaptchaController::save($url, $numbers, true);

?>