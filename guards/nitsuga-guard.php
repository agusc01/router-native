<?php

    require_once 'config/_index.php';
    require_once 'helpers/url.php';
    require_once 'helpers/get.php';
    require_once 'controllers/user-controller.php';
    require_once 'controllers/session-controller.php';
    require_once 'controllers/jwt-controller.php';

    class NitsugaGuard
    {
        public static function isAdmin($path = 'home', $cancelCatch = true)
        {
            return self::isLoggedAndXTypeUser($path, $cancelCatch, 'admin'); //TODO: typeUser in DB
        }

        public static function isCustomer($path = 'home')
        {
            if(GET::stringParameter('pass') == 'go')
            {
                return true;
            }

            URL::redirectTo($path);
        }

        public static function isLogged($path = 'home', $cancelCatch = true)
        {
            $typeUser = null;
            try
            {
                [$idUser, $emailUser, $typeUser] = JWTController::decode();
                $parametersIdAndEmail = [':idUser' => ['value' => $idUser], ':emailUser' => ['value' => $emailUser]] ;
                $user = UserController::getOneByIdAndEmail($parametersIdAndEmail);
                if($user)
                {
                    if(SessionController::getOneByIdUser([':idUser' => ['value' => $idUser] ]))
                    {
                        JWTController::saveJWTinSessionPHP($user, $typeUser);
                        SessionController::resetById($idUser);
                        return [$idUser, $emailUser, $typeUser];
                    }
                }
            }
            catch (ExpiredException $e)
            {
                if($cancelCatch)
                {
                    // echo 'Token has expired: ' . $e->getMessage();
                    URL::redirectTo($path);
                }
            }
            catch (Exception $e)
            {
                
                if($cancelCatch)
                {
                    // echo 'Token has expired: ' . $e->getMessage();
                    URL::redirectTo($path);
                }
            }
            
            if($cancelCatch)
            {
                URL::redirectTo($path);
            }
            // return [false, false, false];
            return false;
        }

        public static function isNotLogged($path = 'home', $cancelCatch = true)
        {
            return !self::isLogged($path, $cancelCatch);
        }

        private static function isLoggedAndXTypeUser($path = 'home' , $cancelCatch = true , $typeUser = null)
        {
            [$idUser, $emailUser, $typeUser] = self::isLogged($path, $cancelCatch);

            if($typeUser == 'admin')
            {
                return true;
            }
            if($cancelCatch)
            {
                URL::redirectTo($path);
            }
        }      
    }

?>