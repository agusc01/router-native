<?php
    
    require_once 'controllers/jwt-controller.php';
    require_once 'controllers/session-controller.php';
    require_once 'helpers/url.php';
    
    try
    {
        [$idUser, $emailUser, $typeUser] = JWTController::decode();
    }
    catch (ExpiredException $e)
    {
        // echo 'Token has expired: ' . $e->getMessage();
    }
    catch (Exception $e)
    {
        // echo 'Token has expired: ' . $e->getMessage();
    }
    finally
    {
        SessionController::deleteOneById($idUser ?? -1);
        session_destroy(); // $_SESSION('jwt') = ''
        URL::redirectTo('home');
    }
    
?>
