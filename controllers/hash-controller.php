<?php
    class HashController
    {
        public static function createOne($value = 'duck', $secret = 'duck')
        {
            $uniqueValue = $value . '|' . $secret . '|' . time();
            $hash = hash('sha256', $uniqueValue);
            return $hash;
        }
    }
?>