<?php

    require_once 'config/_index.php';
    require_once 'controllers/base-controller.php';
    require_once 'controllers/query-controller.php';
    require_once 'models/session-model.php';
    
    class SessionController extends BaseController
	{
        // CREATE TABLE sessions (
        //     idSession INT AUTO_INCREMENT PRIMARY KEY,
        //     idUser INT NOT NULL,
        //     loginAtSession TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        //     lastMoveAtSession TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        //     FOREIGN KEY (idUser) REFERENCES users(idUser) ON DELETE CASCADE
        // );
        
		public static $model = 'SessionModel';
		public static $table = 'sessions';
  
        public static function getOneByIdUser($parameters)
        {
            $query = "SELECT 
                            s.*
                            FROM sessions AS s
                            WHERE s.idUser = :idUser
                        ";
            return QueryController::parameters($query, $parameters, true);
        }

        public static function deleteOneByIdAtAfterXMinutes($parameters)
        {
            if(!isset($parameters[':time']))
            {
                $parameters[':time'] = ['value' => DEFAULT_MINUTES_TO_DELETE_SESSION];
            }

            $currentDate = self::date();
            
            $query = "DELETE FROM sessions
                          WHERE idUser = :idUser && lastMoveAtSession < DATE_SUB('$currentDate', INTERVAL :time MINUTE);";

            return QueryController::parameters($query, $parameters, false);
        }
	}

?>