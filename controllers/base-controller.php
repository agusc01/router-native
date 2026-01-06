<?php
    
    require_once 'database/_index.php';
    require_once 'config/_index.php';

    class BaseController
    {
        public static $table;
        public static $model;

        public static function createOne($object)
        {
            try
            {
                $accessObject = DatabaseAdapter::giveAccessObject();
                $attributes = call_user_func([static::$model, 'getAttributes'], static::$model);
                $columns = array_keys($attributes);

                // README: Remove "id" because it's an INSERT INTO with AUTO_INCREMENT 
                $filtered_columns = preg_grep('/^id' . static::$model . '/', $columns, PREG_GREP_INVERT);
                $filtered_values = array_intersect_key($attributes, array_flip($filtered_columns));

                $text_columns = implode(', ', $filtered_columns);
                $text_values = ':' . implode(', :', $filtered_columns);

                $query = "INSERT INTO " . static::$table . " ($text_columns) VALUES ($text_values)";

                $queryPDO = $accessObject->prepare($query);

                foreach ($filtered_values as $attribute => $type)
                {
                    $valor = $object->$attribute ?? '';
                    $param = PDO::PARAM_STR;
                    if(
                        $type == 'int'
                        || $attribute == 'limite' 
                        || $attribute == 'offset'
                        || str_starts_with($attribute, 'id')
                        || str_starts_with($attribute, 'orden')
                        || str_starts_with($attribute, 'quantity')
                    )
                    {
                        $valor = $object->$attribute ?? 0;
                        $param = PDO::PARAM_INT;
                    }
                    $queryPDO->bindValue(':' . $attribute, $valor , $param);
                }

                $retornoPDO = $queryPDO->execute();

                return $retornoPDO ? $accessObject->lastIdInsert() : false;
            }
            catch (PDOException $e) { DatabaseAdapter::showErrors($e); }
        }

        public static function getAll($where = '', $orden = '')
        {
            try
            {
                $accessObject = DatabaseAdapter::giveAccessObject();
                $attributes = call_user_func([static::$model, 'getAttributes'], static::$model);
                if($orden == '') 
                {
                    $orden = array_key_exists('orden'.static::$model, $attributes) ? ' ORDER BY orden'.static::$model.' ' : '';
                }

                $query = 'SELECT * FROM ' . static::$table . ' ' . $where . ' ' . $orden . ';';
                $queryPDO = $accessObject->prepare($query);
                $queryPDO->execute();
                return $queryPDO->fetchAll(PDO::FETCH_OBJ);
            }
            catch (PDOException $e) { DatabaseAdapter::showErrors($e); }
        }

        public static function getOneById($id)
        {
            try
            {
                $accessObject = DatabaseAdapter::giveAccessObject();
                $attributes = call_user_func([static::$model, 'getAttributes'], static::$model);
                $primaryKey = array_key_first($attributes);

                $query = 'SELECT * FROM ' . static::$table . " WHERE $primaryKey = :$primaryKey";
                $queryPDO = $accessObject->prepare($query);
                $queryPDO->bindValue(":$primaryKey", $id, PDO::PARAM_INT);
                $queryPDO->execute();

                return $queryPDO->fetch(PDO::FETCH_OBJ);
            }
            catch (PDOException $e) { DatabaseAdapter::showErrors($e); }
        }

        public static function updateOne($object)
        {
            try
            {
                $attributes = call_user_func([static::$model, 'getAttributes'], static::$model);
                $primaryKey = array_key_first($attributes);
                $columns = array_keys($attributes);

                if (!self::getOneById($object->$primaryKey)) {
                    return false;
                }

                $accessObject = DatabaseAdapter::giveAccessObject();
                $setValues = [];
                foreach ($columns as $column)
                {
                    if ($column != $primaryKey)
                    {
                        $setValues[] = "$column = :$column";
                    }
                }
                $setValuesString = implode(", ", $setValues);

                $query = 'UPDATE ' . static::$table . " SET $setValuesString WHERE $primaryKey = :$primaryKey;";
                $queryPDO = $accessObject->prepare($query);

                $queryPDO->bindValue(':' . $primaryKey, $object->$primaryKey, PDO::PARAM_INT);

                foreach ($attributes as $attribute => $type)
                {
                    $valor = $object->$attribute ?? '';
                    $param = PDO::PARAM_STR;
                    if(
                        $type == 'int'
                        || $attribute == 'limite' 
                        || $attribute == 'offset'
                        || str_starts_with($attribute, 'id')
                        || str_starts_with($attribute, 'orden')
                        || str_starts_with($attribute, 'quantity')
                    )
                    {
                        $valor = $object->$attribute ?? 0;
                        $param = PDO::PARAM_INT;
                    }
                    $queryPDO->bindValue(':' . $attribute, $valor , $param);
                }

                return $queryPDO->execute();
            }
            catch (PDOException $e) { DatabaseAdapter::showErrors($e); }
        }

        public static function deleteOneById($id)
        {
            try
            {
                if (!self::getOneById($id)) { return false; }

                $accessObject = DatabaseAdapter::giveAccessObject();
                $query = "DELETE FROM " . static::$table . " WHERE id" . static::$model . " = :id;";
                $queryPDO = $accessObject->prepare($query);
                $queryPDO->bindValue(":id", $id, PDO::PARAM_INT);

                return $queryPDO->execute();
            }
            catch (PDOException $e) { DatabaseAdapter::showErrors($e); }
        }
    }

?>
