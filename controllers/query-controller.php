<?php

    class QueryController
    {
        public static function basic($query, $one = false)
        {
            try
            {
                $accessObject = DatabaseAdapter::giveAccessObject();
                $queryPDO = $accessObject->prepare($query);
                $queryPDO->execute();

                if(!$one) { return $queryPDO->fetchAll(PDO::FETCH_OBJ); }
                $_return = $queryPDO->fetch(PDO::FETCH_OBJ);
                if($_return === false) { return []; }
                return $_return;
            }
            catch (PDOException $e) { DatabaseAdapter::showErrors($e); }
        }

        public static function parameters($query, $parameters = [], $one = false)
        {
            try 
            {
                $accessObject = DatabaseAdapter::giveAccessObject();
                $queryPDO = $accessObject->prepare($query); 
                foreach ($parameters as $parameter => $detail) 
                {
                    $value = $detail['value'];
                    $dataType = $detail['type'] ?? PDO::PARAM_STR;
                    if(
                        $parameter == ':limite' 
                        || $parameter == ':offset'
                        || str_starts_with($parameter, ':id')
                        || str_starts_with($parameter, ':orden')
                        || str_starts_with($parameter, ':cantidad')
                    )
                    {
                        // esto es para el HOSTING
                        $dataType = PDO::PARAM_INT;
                    }
                    $queryPDO->bindValue($parameter, $value, $dataType);
                }
                $queryPDO->execute();
                if(!$one) { return $queryPDO->fetchAll(PDO::FETCH_OBJ); }
                $_return = $queryPDO->fetch(PDO::FETCH_OBJ);
                if($_return === false) { return []; }
                return $_return;
            }
            catch (PDOException $e) { DatabaseAdapter::showErrors($e); }
        }

        public static function mostrar($query, $parameters = [], $one = false, $die = true)
        {
            $queryWithValues = $query;
            if (is_array($parameters) || is_object($parameters))
                {
                foreach ($parameters as $key => $value)
                {
                    $valueProcesado = is_string($value['value']) ? "'" . $value['value'] . "'" : $value['value'];
                    $queryWithValues = str_replace($key, $valueProcesado, $queryWithValues);
                }
            }
            // hidden loder
            echo "<pre>";
            echo "<hr/>";
            echo "query:<br>";
            var_dump($query);
            echo "<hr/>";
            echo "parameters:<br>";
            var_dump($parameters);
            echo "<hr/>";
            echo "query con valuees:<br>";
            var_dump($queryWithValues);
            echo "<hr/>";
            echo "</pre>";
            if($die)
            {
                die();
            }
        }

    }

?>