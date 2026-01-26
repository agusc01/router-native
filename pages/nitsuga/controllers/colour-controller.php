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

        // INSERT INTO colours (nameColour, hexaColour, ordenColour) VALUES 
        // ('Red', '#FF0000', 1),
        // ('Green', '#00FF00', 2),
        // ('Blue', '#0000FF', 3),
        // ('Yellow', '#FFFF00', 4),
        // ('Cyan', '#00FFFF', 5),
        // ('Magenta', '#FF00FF', 6),
        // ('Orange', '#FFA500', 7),
        // ('Purple', '#800080', 8),
        // ('Brown', '#A52A2A', 9),
        // ('Pink', '#FFC0CB', 10);

		public static $model = 'Colour';
		public static $table = 'colours';
	}


?>