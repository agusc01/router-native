<?php
    trait HTTP
    {
        private static function _requestHttp()
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
            return isset(self::_requestHttp()[$name]) && (int)self::_requestHttp()[$name] > -1 
                ? (int)self::_requestHttp()[$name] 
                : $default;
        }

        public static function floatPositiveParameter($name, $default = -1)
        {
            return isset(self::_requestHttp()[$name]) && (float)self::_requestHttp()[$name] > -1 
                ? (float)self::_requestHttp()[$name] 
                : $default;
        }

        public static function stringParameter($name, $default = '')
        {
            return isset(self::_requestHttp()[$name]) ? self::_requestHttp()[$name] : $default;
        }

        public static function arrayParameter($name, $default = [])
        {
            return isset(self::_requestHttp()[$name]) && is_array(self::_requestHttp()[$name]) 
                ? self::_requestHttp()[$name] 
                : $default;
        }

        public static function hiddenParameter($name)
        {
            return isset(self::_requestHttp()[$name]);
        }

    }
?>