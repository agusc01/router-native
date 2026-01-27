<?php

    abstract class BaseModel
    {
        public $attributes = [];

        public function __construct($data = null)
        {
            if ($data) 
            {
                foreach ($this->attributes as $attribute => $type) 
                {
                    $this->$attribute = isset($data[$attribute]) ? $this->castValue($data[$attribute], $type) : "";
                }
            }
        }

        private function castValue($value, $type) 
        {
            switch ($type) 
            {
                case 'int':
                    if (!is_numeric($value)) 
                    {
                        throw new InvalidArgumentException("Non-numeric value for integer type");
                    }
                    return (int)$value;
                case 'float':
                    if (!is_numeric($value)) 
                    {
                        throw new InvalidArgumentException("Non-numeric value for decimal type.");
                    }
                    return (float)$value;
                case 'string':
                    return (string)$value;
                default:
                    return $value;
            }
        }

        public static function getAttributes($className)
        {
            $instance = new $className();
            return $instance->attributes;
        }

        public static function createInstance($className)
        {
            $instance = new $className();
            return $instance;
        }
    }

?>
