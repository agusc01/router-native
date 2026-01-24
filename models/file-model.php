<?php
    require_once 'models/base-model.php';

    class File extends BaseModel 
    {
        public $attributes = [
            'idFile' => 'int',
            'nameFile' => 'string',
            'urlFile' => 'string',
        ];
    }

?>
