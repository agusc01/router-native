


<?php include_once 'pages/nitsuga/views/components/head.php'; ?>
<!-- More links or scripts -->
</head>
<body>
<?php
    require_once 'helpers/email.php';
    require_once 'controllers/website-controller.php';

    echo "Email. Nitsuga<hr>";
    include_once 'pages/nitsuga/views/components/navbar.php';

    echo "<pre>";
    var_dump(WebsiteController::current());
    echo "</pre>";
    
    // $sendTo = "your_email@mail.com";
    // $response = Email::send($sendTo, 'Body things', 'My custom header') ? '' : 'NO';
    // echo "The email was $response send";

?>
</body>
</html>