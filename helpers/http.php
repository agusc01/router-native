<?php
    abstract class HTTP
    {
        protected static $data;

        private static function requestMethod()
        {
            switch (get_called_class()) 
            {
                case 'GET':
                    return $_GET;
                    break;
                case 'POST':
                    return $_POST;
                    break;
                case 'SESSION':
                    session_start();
                    return $_SESSION;
                    break;
                default:
                    throw new InvalidArgumentException('Unimplemented class');
            }
        }

        public static function positiveParameter($name, $default = -1)
        {
            return isset(self::requestMethod()[$name]) && (int)self::requestMethod()[$name] > -1 
                ? (int)self::requestMethod()[$name] 
                : $default;
        }

        public static function floatPositiveParameter($name, $default = -1)
        {
            return isset(self::requestMethod()[$name]) && (float)self::requestMethod()[$name] > -1 
                ? (float)self::requestMethod()[$name] 
                : $default;
        }

        public static function stringParameter($name, $default = '')
        {
            return isset(self::requestMethod()[$name]) ? self::requestMethod()[$name] : $default;
        }

        public static function arrayParameter($name, $default = [])
        {
            return isset(self::requestMethod()[$name]) && is_array(self::requestMethod()[$name]) 
                ? self::requestMethod()[$name] 
                : $default;
        }

        public static function hiddenParameter($name)
        {
            return isset(self::requestMethod()[$name]);
        }

    }
?>