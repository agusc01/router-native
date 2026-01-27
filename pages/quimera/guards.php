<?php

    require_once 'config/_index.php';
    require_once 'helpers/session.php';
    require_once 'helpers/url.php';

    class QuimeraGuard
    {
        public static function isAdmin($path = 'home')
        {
            if(self::isAnActiveUser() /* && SESSION::idUserType() == ID_USER_TYPE_ADMIN */)
            {
                return true;
            }

            URL::redirectTo($path);
        }

        public static function isCustomer($path = 'home')
        {
            if(self::isAnActiveUser() /* && SESSION::idUserType() == ID_USER_TYPE_CUSTOMER*/)
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