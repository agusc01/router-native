<?php
    require_once 'models/base-model.php';

    class JWTModel extends BaseModel 
    {
        public $attributes = [
            'idJWT' => 'int',
            'hashJWT' => 'string',
        ];
    }

?>
