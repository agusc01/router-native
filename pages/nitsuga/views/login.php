<?php

    require_once 'config/_index.php';
    require_once 'helpers/post.php';
    require_once 'helpers/url.php';
    require_once 'controllers/user-controller.php';
    require_once 'controllers/session-controller.php';

    require_once 'helpers/session.php';
    
    require_once 'assets/jwt/_index.php';
    use \Firebase\JWT\JWT;
    use \Firebase\JWT\Key;
    require_once 'guards/nitsuga-guard.php';

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
                
                if($user)
                {
                    JWTController::saveJWTinSessionPHP($user,'admin'); //TODO: typeUser in DB
                    SessionController::createOne(new SessionModel([
                        'idUser' => $user->idUser,
                        'loginAtSession' => SessionController::date(),
                        'lastMoveAtSession' => SessionController::date(),
                    ]));
                    URL::redirectTo('auth/dashboard');
                }
            }
        }
        
        // var_dump(POST::getErrorMessages());
    }
    else if(NitsugaGuard::isAdmin('login', false))
    {
        URL::redirectTo('auth/dashboard');
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