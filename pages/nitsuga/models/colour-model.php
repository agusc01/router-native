<?php
    
    require_once 'models/_index.php';

    class Colour extends BaseModel 
    {
        public $attributes = [
            'idColour' => 'int',
            'nameColour' => 'string',
            'hexaColour' => 'string',
            'ordenColour' => 'int',
        ];
    }

?>
