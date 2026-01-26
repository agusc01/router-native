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
        session_destroy(); // $_SESSION('jwt') = ''
        SessionController::deleteOneById($idUser ?? -1);
        URL::redirectTo('home');
    }
    
?>
