<?php
    require_once 'controllers/base-controller.php';
    require_once 'controllers/query-controller.php';
    require_once 'models/website-model.php';
    
    class WebsiteController extends BaseController
	{
        // CREATE TABLE `websites` (
        //   `idWebsite` int UNSIGNED NOT NULL,
        //   `urlWebsite` varchar(100) NOT NULL,
        //   `telephoneWebsite` varchar(100) NOT NULL,
        //   `whatsAppWebsite` varchar(100) NOT NULL,
        //   `emailWebsite` varchar(100) NOT NULL,
        //   `nameWebsite` varchar(100) NOT NULL,
        //   `urlLogoWebsite` varchar(100) NOT NULL,
        //   `urlFaviconWebsite` varchar(100) NOT NULL,
        //   `tokenMailWebsite` varchar(40) NOT NULL,
        //   `mailFromTokenWebsite` varchar(100) NOT NULL
        // );
        // INSERT INTO `websites` (`idWebsite`, `urlWebsite`, `telephoneWebsite`, `whatsAppWebsite`, `emailWebsite`, `nameWebsite`, `urlLogoWebsite`, `urlFaviconWebsite`, `tokenMailWebsite`, `mailFromTokenWebsite`) 
        // VALUES (1, 'fakesite.com', '911', '911', 'fake@mail.com', 'Fake site', 'fake.png', 'fake.png', 'hidden', 'fakemaik@mail.com');

		public static $model = 'Website';
		public static $table = 'websites';

        private static function getOneCurrentPage()
        {
            $query = "SELECT 
                            sw.*
                            FROM websites AS sw
                            WHERE sw.urlWebSite = '" . self::currentURL() . "'
                        ";

            return QueryController::basic($query, true);
        }

        public static function current()
        {
            return WebsiteController::getOneCurrentPage();
        }

        public static function currentURL()
        {
            return SERVER_HTTP_HOST;
        }
	}

?>