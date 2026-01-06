<?php
    trait MessagesSESSION
    {
        public static function getSuccessMessages()
        {
            return $_SESSION['successMessages'] ?? [];
        }

        public static function getInfoMessages()
        {
            return $_SESSION['infoMessages'] ?? [];
        }

        public static function getWarnMessages()
        {
            return $_SESSION['warnMessages'] ?? [];
        }

        public static function getErrorMessages()
        {
            return $_SESSION['errorMessages'] ?? [];
        }

        public static function setSuccessMessage($title, $text)
        {
            if (!isset($_SESSION['successMessages']))
            {
                $_SESSION['successMessages'] = [];
            }
            $_SESSION['successMessages'][$title] = $text;
        }

        public static function setInfoMessage($title, $text)
        {
            if (!isset($_SESSION['infoMessages']))
            {
                $_SESSION['infoMessages'] = [];
            }
            $_SESSION['infoMessages'][$title] = $text;
        }

        public static function setWarnMessage($title, $text)
        {
            if (!isset($_SESSION['warnMessages']))
            {
                $_SESSION['warnMessages'] = [];
            }
            $_SESSION['warnMessages'][$title] = $text;
        }

        public static function setErrorMessage($title, $text)
        {
            if (!isset($_SESSION['errorMessages']))
            {
                $_SESSION['errorMessages'] = [];
            }
            $_SESSION['errorMessages'][$title] = $text;
        }

        public static function cleanSuccessMessages()
        {
            $_SESSION['successMessages'] = [];
        }

        public static function cleanInfoMessages()
        {
            $_SESSION['infoMessages'] = [];
        }

        public static function cleanWarnMessages()
        {
            $_SESSION['warnMessages'] = [];
        }

        public static function cleanErrorMessages()
        {
            $_SESSION['errorMessages'] = [];
        }
    }
?>
