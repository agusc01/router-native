<?php
    require_once 'models/base-model.php';

    class Website extends BaseModel 
    {
        public $attributes = [
            'idWebsite' => 'int',
            'urlWebsite' => 'string',
            'telephoneWebsite' => 'string',
            'emailWebsite' => 'string',
            'nameWebsite' => 'string',
            'urlLogoWebsite' => 'string',
            'urlFaviconWebsite' => 'string',
            'tokenMailWebsite' => 'string',
            'mailFromTokenWebsite' => 'string',
        ];
    }



?>
