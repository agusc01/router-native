<?php

    include_once 'helpers/post.php';
    include_once 'helpers/url.php';
    include_once 'controllers/user-controller.php';
    include_once 'controllers/session-controller.php';

    if(POST::isPOST())
    {
        $validations = [
                'email' => [ 'validator' => 'Validator::email' ,  'name' => "email's user" ],
                'password' => [ 'validator' => 'Validator::stringCustomLength' , 'minLength' => '6', 'maxLength' => '14', 'name' => "password's user" ],
        ];

        $inputs = POST::validation($validations);

        if(empty(POST::getErrorMessages()))
        {
            if(isset($inputs['email']) && isset($inputs['password']))
            {
                $user = UserController::getOneByEmailAndPassword([
                    ':emailUser' => [ 'value' => $inputs['email'] ],
                    ':passwordUser' => [ 'value' => $inputs['password'] ],
                ]); 
                // var_dump($user);
                if($user)
                {
                    $_SESSION['isAdmin'] = 'yes';
                    $_SESSION['idUser'] = $user->idUser;
                    $userSession = new SessionModel([
                        'idUser' => $user->idUser,
                        'loginAtSession' => SessionController::date(),
                        'lastMoveAtSession' => SessionController::date(),
                    ]);
                    $session = SessionController::createOne($userSession);
                    URL::redirectTo('auth/dashboard');
                }
            }
        }
        
        var_dump(POST::getErrorMessages());
    }
    else
    {
        $idUser = SESSION::stringParameter('idUser');
        if(SESSION::stringParameter('isAdmin') 
            && UserController::getOneById($idUser)
            && SessionController::getOneByIdUser([':idUser' => ['value' => $idUser]])
        )
        {
            URL::redirectTo('auth/dashboard');
        }
    }
?>
<?php include_once 'pages/nitsuga/views/components/head.php'; ?>
<!-- More links or scripts -->
</head>
<body>
    <?php
        echo "Login. Nitsuga <hr>";
        include_once 'pages/nitsuga/views/components/navbar.php';
    ?>
    <form action="" method="POST">
        <input type="email" name="email" id="email"  placeholder="email" value="admin@mail.com">
        <input type="password" name="password" id="password" placeholder="password">
        <button>sent</button>
    </form>
</body>
</html>