<?php

    require_once 'config/_index.php';
    require_once 'helpers/url.php';
    require_once 'helpers/get.php';
    require_once 'helpers/session.php';
    require_once 'controllers/user-controller.php';
    require_once 'controllers/session-controller.php';

    class NitsugaGuard
    {
        public static function isAdmin($path = 'home')
        {
            if(self::isAnActiveUser() && SESSION::stringParameter('isAdmin'))
            {
                $idUser = SESSION::stringParameter('idUser');
                if(UserController::getOneById($idUser))
                {
                    $parametersUser = [':idUser' => ['value' => $idUser]];
                    SessionController::deleteOneByIdAtAfterXMinutes($parametersUser);
                    $currentSession = SessionController::getOneByIdUser($parametersUser);
                    if($currentSession)
                    {   
                        $currentSession->lastMoveAtSession = SessionController::date();
                        SessionController::updateOne($currentSession);
                        return true;
                    }
                }
            }
            URL::redirectTo($path);
        }

        public static function isCustomer($path = 'home')
        {
            if(self::isAnActiveUser() && GET::stringParameter('pass') == 'go')
            {
                return true;
            }

            URL::redirectTo($path);
        }

        public static function isVendor($path = 'home')
        {
            if(self::isAnActiveUser() /* && SESSION::idUserType() == ID_USER_TYPE_VENDOR */)
            {
                return true;
            }

            URL::redirectTo($path);
        }

        public static function isAnActiveUser()
        {
            return true;
            // return SESSION::stringParameter('user_state') == USER_STATE_ACTIVE;
        }
    }

?>