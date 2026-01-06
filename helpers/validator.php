<?php
    class Validator
    {
        public static function string($field) 
        {
            return isset($field) && trim($field) !== '';
        }

        public static function stringMaxLength($field, $maxLength) 
        {
            return isset($field) && trim($field) !== '' && strlen(trim($field)) <= $maxLength;
        }

        public static function stringMinLength($field, $minLength) 
        {
            return isset($field) && trim($field) !== '' && strlen(trim($field)) >= $minLength;
        }

        public static function stringCustomLength($field, $minLength, $maxLength) 
        {
            return isset($field) && trim($field) !== '' && strlen(trim($field)) >= $minLength && strlen(trim($field)) <= $maxLength;
        }

        public static function number($field) 
        {
            return isset($field) && is_numeric($field);
        }

        public static function numberMin($field, $min) 
        {
            return isset($field) && is_numeric($field) && $field >= $min;
        }

        public static function numberMax($field, $max) 
        {
            return isset($field) && is_numeric($field) && $field <= $max;
        }

        public static function numberBetween($field, $min, $max) 
        {
            return isset($field) && is_numeric($field) && $field >= $min && $field <= $max;
        }

        public static function positiveNumber($field) 
        {
            return self::Number($field) && $field > 0;
        }

        public static function selectPositiveNumber($field) 
        {
            return self::positiveNumber($field);
        }

        public static function email($field) 
        {
            return isset($field) && filter_var($field, FILTER_VALIDATE_EMAIL);
        }

        public static function radioGroup($field) 
        {
            return self::PositiveNumber($field);
        }
    }
?>
