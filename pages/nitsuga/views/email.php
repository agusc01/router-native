<?php
    require_once 'controllers/email-controller.php';
    require_once 'controllers/website-controller.php';

    echo "Email. Nitsuga<br>";

    var_dump(WebsiteController::current());
    
    // $sendTo = "your_email@mail.com";
    // $response = EmailController::send($sendTo, 'Hola', 'Testing') ? '' : 'NO';
    // echo "The email was $response send";

?>
