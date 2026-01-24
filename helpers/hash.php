<?php
    class Hash
    {
        public static function new($value = 'duck', $secret = 'duck')
        {
            $uniqueValue = $value . '|' . $secret . '|' . time();
            $hash = hash('sha256', $uniqueValue);
            return $hash;
        }
    }
?>