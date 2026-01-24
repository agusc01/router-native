<?php
    require_once 'models/base-model.php';

    class Captcha extends BaseModel 
    {
        public $attributes = [
            // 'idCaptcha' => 'int',
            'valueCaptcha' => 'string',
            'urlCaptcha' => 'string',
            'createdAtCaptcha' => 'timestamp',
        ];
    }

?>
