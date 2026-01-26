<?php
    require_once 'models/base-model.php';

    class SessionModel extends BaseModel 
    {
        public $attributes = [
            // 'idSession' => 'int',
            'idUser' => 'int',
            'loginAtSession' => 'timestamp',
            'lastMoveAtSession' => 'timestamp',
        ];
    }

?>
