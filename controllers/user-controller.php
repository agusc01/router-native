<?php

    require_once 'controllers/base-controller.php';
    require_once 'controllers/query-controller.php';
    require_once 'models/user-model.php';
    
    class UserController extends BaseController
	{
        // CREATE TABLE users (
        //     idUser INT AUTO_INCREMENT PRIMARY KEY,
        //     emailUser VARCHAR(50) NOT NULL,
        //     passwordUser VARCHAR(15) NOT NULL,
        //     createdAtUser TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        //     modifiedAtUser TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        // );
        // INSERT INTO users (emailUser, passwordUser) VALUES ('admin@mail.com','123123');

		public static $model = 'User';
		public static $table = 'users';
  
        public static function getOneByEmailAndPassword($parameters)
        {
            $query = "SELECT 
                            u.*
                            FROM users AS u
                            WHERE u.emailUser = :emailUser
                                AND u.passwordUser = :passwordUser
                        ";
            return QueryController::parameters($query, $parameters, true);
        }
	}

?>