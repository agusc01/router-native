<?php

    require_once 'controllers/base-controller.php';
    require_once 'controllers/query-controller.php';
    require_once 'models/jwt-model.php';
    require_once 'assets/jwt/_index.php';
    use \Firebase\JWT\JWT;
    use \Firebase\JWT\Key;
    
    class JWTController extends BaseController
	{
        // CREATE TABLE jwts (
        //     idJWT INT AUTO_INCREMENT PRIMARY KEY,
        //     hashJWT VARCHAR(255) NOT NULL
        // );
        // INSERT INTO jwts (hashJWT) VALUES ('d5bdaa6e0aff6ce7d0b4298ea2e6977d10ff589f4bfe85cfa282b97e75f92cda');

		public static $model = 'JWTModel';
		public static $table = 'jwts';
  
        public static function createPayload($user, $typeUser)
        {
            return [
                "iss" => WebSiteController::current()->urlWebsite ?? 'none.com',
                "aud" => WebSiteController::current()->urlWebsite ?? 'none.com',
                "iat" => time(), 
                "exp" => time() + (60 * DEFAULT_MINUTES_TO_DELETE_JWT), 
                "data" => [
                    "idUser" => $user->idUser,
                    "emailUser" => $user->emailUser,
                    "typeUser" => $typeUser, // that must be in the database as well
                ]
            ];
        }

        public static function saveJWTinSessionPHP($user, $typeUser)
        {
            $key = JWTController::getOneById(1)->hashJWT; 
            $payload = JWTController::createPayload($user, $typeUser);
            $jwt = JWT::encode($payload, $key, HASH_JWT);
            $_SESSION['jwt'] = $jwt;
        }

        public static function decode()
        {
            $jwt = SESSION::stringParameter('jwt');
            $hashJWT = JWTController::getOneById(1)->hashJWT; 

            $key = new Key($hashJWT, HASH_JWT);
            $data = JWT::decode($jwt, $key)->data;

            return [$data->idUser, $data->emailUser, $data->typeUser];
        }

	}

?>