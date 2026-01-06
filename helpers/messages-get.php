<?php
    trait MessagesGET
    {
        public static function getSuccessMessages()
        {
            return $_GET['successMessages'] ?? [];
        }

        public static function getInfoMessages()
        {
            return $_GET['infoMessages'] ?? [];
        }

        public static function getWarnMessages()
        {
            return $_GET['warnMessages'] ?? [];
        }

        public static function getErrorMessages()
        {
            return $_GET['errorMessages'] ?? [];
        }

        public static function setSuccessMessage($title, $text)
        {
            if (!isset($_GET['successMessages']))
            {
                $_GET['successMessages'] = [];
            }
            $_GET['successMessages'][$title] = $text;
        }

        public static function setInfoMessage($title, $text)
        {
            if (!isset($_GET['infoMessages']))
            {
                $_GET['infoMessages'] = [];
            }
            $_GET['infoMessages'][$title] = $text;
        }

        public static function setWarnMessage($title, $text)
        {
            if (!isset($_GET['warnMessages']))
            {
                $_GET['warnMessages'] = [];
            }
            $_GET['warnMessages'][$title] = $text;
        }

        public static function setErrorMessage($title, $text)
        {
            if (!isset($_GET['errorMessages']))
            {
                $_GET['errorMessages'] = [];
            }
            $_GET['errorMessages'][$title] = $text;
        }

        public static function cleanSuccessMessages()
        {
            $_GET['successMessages'] = [];
        }

        public static function cleanInfoMessages()
        {
            $_GET['infoMessages'] = [];
        }

        public static function cleanWarnMessages()
        {
            $_GET['warnMessages'] = [];
        }

        public static function cleanErrorMessages()
        {
            $_GET['errorMessages'] = [];
        }
    }
?>
