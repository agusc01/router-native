<?php
    require_once 'models/base-model.php';

    class User extends BaseModel 
    {
        public $attributes = [
            'idUser' => 'int',
            'emailUser' => 'string',
            'passwordUser' => 'string',
            'createdAtUser' => 'timestamp',
            'modifiedAtUser' => 'timestamp',
        ];
    }

?>
