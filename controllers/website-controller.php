<?php
    require_once 'controllers/base-controller.php';
    require_once 'controllers/query-controller.php';
    
    class WebsiteController extends BaseController
	{
        // CREATE TABLE `websites` (
        //   `idWebsite` int UNSIGNED NOT NULL,
        //   `urlWebsite` varchar(100) NOT NULL,
        //   `telephoneWebsite` varchar(100) NOT NULL,
        //   `emailWebsite` varchar(100) NOT NULL,
        //   `nameWebsite` varchar(100) NOT NULL,
        //   `urlLogoWebsite` varchar(100) NOT NULL,
        //   `urlFaviconWebsite` varchar(100) NOT NULL,
        //   `tokenMailWebsite` varchar(40) NOT NULL,
        //   `mailFromTokenWebsite` varchar(100) NOT NULL
        // );

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