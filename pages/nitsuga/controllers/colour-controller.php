<?php

    require_once 'controllers/base-controller.php';
    require_once 'pages/nitsuga/models/colour-model.php';

    class ColourController extends BaseController
	{
        // CREATE TABLE colours (
        //     idColour INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
        //     nameColour VARCHAR(100) NOT NULL,
        //     hexaColour VARCHAR(7) NOT NULL,
        //     ordenColour INT NOT NULL
        // );

		public static $model = 'Colour';
		public static $table = 'colours';
	}


?>