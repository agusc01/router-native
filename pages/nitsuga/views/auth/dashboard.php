<?php
    require_once 'helpers/post.php';
    require_once 'helpers/session.php';
    require_once 'controllers/session-controller.php';
    
    if(POST::isPOST())
    {
        if(POST::isset('logout'))
        {
            session_destroy();
            SessionController::deleteOneById(SESSION::stringParameter('idUser'));
            URL::redirectTo('home');
        }
        else if(POST::isset('home'))
        {
            URL::redirectTo('home');
        }

    }
    
?>
<?php include_once 'pages/nitsuga/views/components/head.php'; ?>
<!-- More links or scripts -->
</head>
<body>
    <?php
        echo "Dashboard [You're an Admin]. Nitsuga <hr>";
    ?>
    <form action="" method="POST">
        <button name="home" id="home">home</button>
        <button name="logout" id="logout">logout</button>
    </form>
</body>
</html>