<?php
    require_once 'helpers/http.php';
    require_once 'helpers/messages-post.php';
    require_once 'helpers/validator.php';
    require_once 'helpers/session.php';

    class POST
    {
        use HTTP;
        use MessagesPOST;
        
        public static function isPOST()
        {
            return $_SERVER["REQUEST_METHOD"] === "POST";
        }

        public static function validation($validations)
        {
            $newEntity = [];
            if(self::isPOST())
            {
                foreach ($validations as $field => $options) 
                {
                    $value = $_POST[$field] ?? null;

                    if ($options['validator'] === null) 
                    {
                        if (isset($options['type']) && $options['type'] === 'number') 
                        {
                            $newEntity[$field] = intval(trim(htmlspecialchars($_POST[$field] ?? 0)));
                        } 
                        else 
                        {
                            $newEntity[$field] = trim(htmlspecialchars($_POST[$field] ?? ''));
                        }
                    }
                    else
                    {
                        $validador = $options['validator'];
                        $params = [$value];

                        if (isset($options['maxLength']) && $options['validator'] == 'Validator::stringMaxLength')
                        {
                            $params[] = $options['maxLength'];
                        }
                        elseif (isset($options['minLength']) && ($options['validator'] == 'Validator::stringMinLength' ))
                        {
                            $params[] = $options['minLength'];
                        }
                        elseif (isset($options['minLength']) && isset($options['maxLength']) && $options['validator'] == 'Validator::stringCustomLength')
                        {
                            $params[] = $options['minLength'];
                            $params[] = $options['maxLength'];
                        }
                        elseif (isset($options['min']) && $options['validator'] == 'Validator::numberMin')
                        {
                            $params[] = $options['min'];
                        }
                        elseif (isset($options['max']) && $options['validator'] == 'Validator::numberMax')
                        {
                            $params[] = $options['max'];
                        }
                        elseif (isset($options['min']) && isset($options['max']) && $options['validator'] == 'Validator::numberBetween')
                        {
                            $params[] = $options['min'];
                            $params[] = $options['max'];
                        }
                                        
                        if (call_user_func($validador, ...$params))  
                        {
                            if (
                                $options['validator'] == 'Validator::selectPositiveNumber' ||
                                $options['validator'] == 'Validator::positiveNumber' ||
                                $options['validator'] == 'Validator::number' ||
                                $options['validator'] == 'Validator::radioGroup'
                            ) 
                            {
                                $newEntity[$field] = intval(trim(htmlspecialchars($_POST[$field] ?? 0)));
                            } 
                            else 
                            {
                                $newEntity[$field] = trim(htmlspecialchars($_POST[$field] ?? ''));
                            }
                        } 
                        else 
                        {
                            $messageError = 'The field ' . ($options['name'] ?? 'unknown') . ' do not pass the validation';
                            if (isset($_SESSION['user_id'])) 
                            {
                                SESSION::setErrorMessage($field, $messageError);
                            } 
                            else 
                            {
                                self::setErrorMessage($field, $messageError);
                            }
                        }
                    }
                }
            }

            return $newEntity;
        }

    }
?>
