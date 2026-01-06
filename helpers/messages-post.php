<?php
    trait MessagesPOST
    {
        public static function getSuccessMessages()
        {
            return $_POST['successMessages'] ?? [];
        }

        public static function getInfoMessages()
        {
            return $_POST['infoMessages'] ?? [];
        }

        public static function getWarnMessages()
        {
            return $_POST['warnMessages'] ?? [];
        }

        public static function getErrorMessages()
        {
            return $_POST['errorMessages'] ?? [];
        }

        public static function setSuccessMessage($title, $text)
        {
            if (!isset($_POST['successMessages']))
            {
                $_POST['successMessages'] = [];
            }
            $_POST['successMessages'][$title] = $text;
        }

        public static function setInfoMessage($title, $text)
        {
            if (!isset($_POST['infoMessages']))
            {
                $_POST['infoMessages'] = [];
            }
            $_POST['infoMessages'][$title] = $text;
        }

        public static function setWarnMessage($title, $text)
        {
            if (!isset($_POST['warnMessages']))
            {
                $_POST['warnMessages'] = [];
            }
            $_POST['warnMessages'][$title] = $text;
        }

        public static function setErrorMessage($title, $text)
        {
            if (!isset($_POST['errorMessages']))
            {
                $_POST['errorMessages'] = [];
            }
            $_POST['errorMessages'][$title] = $text;
        }

        public static function cleanSuccessMessages()
        {
            $_POST['successMessages'] = [];
        }

        public static function cleanInfoMessages()
        {
            $_POST['infoMessages'] = [];
        }

        public static function cleanWarnMessages()
        {
            $_POST['warnMessages'] = [];
        }

        public static function cleanErrorMessages()
        {
            $_POST['errorMessages'] = [];
        }
    }
?>
