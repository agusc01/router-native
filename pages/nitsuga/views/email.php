


<?php include_once 'pages/nitsuga/views/components/head.php'; ?>
<!-- More links or scripts -->
</head>
<body>
<?php
    require_once 'controllers/email-controller.php';
    require_once 'controllers/website-controller.php';

    echo "Email. Nitsuga<hr>";
    include_once 'pages/nitsuga/views/components/navbar.php';

    echo "<pre>";
    var_dump(WebsiteController::current());
    echo "</pre>";
    
    // $sendTo = "your_email@mail.com";
    // $response = EmailController::send($sendTo, 'Hola', 'Testing') ? '' : 'NO';
    // echo "The email was $response send";

?>
</body>
</html>