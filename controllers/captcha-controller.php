<?php
    require_once 'controllers/base-controller.php';
    require_once 'controllers/query-controller.php';
    
    class CaptchaController extends BaseController
	{
		public static $model = 'Captcha';
		public static $table = 'captchas';

        // CREATE TABLE captchas (
        //     -- idCaptcha INT AUTO_INCREMENT PRIMARY KEY,
        //     valueCaptcha VARCHAR(10) NOT NULL,
        //     urlCaptcha VARCHAR(30) NOT NULL,
        //     createdAtCaptcha TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        // );

        public static function getOneByValueAndUrlCaptcha($parameters)
        {
            $query = "SELECT * from captchas AS ca
                            WHERE valorCaptcha = :valorCaptcha
                                AND urlImagenCaptcha = :urlImagenCaptcha
                        ";

            return QueryController::parameters($query, $parameters, true);
        }

        //public
        private static function getAllAfterXMinutes($parameters = [':time' => ['value' => DEFAULT_MINUTES_TO_DELETE_CAPTCHAS] ] )
        {
            $currentDate = date("Y-m-d H:i:s");
            
            $query = "SELECT * FROM captchas AS ca
                          WHERE createdAtCaptcha < DATE_SUB('$currentDate', INTERVAL :time MINUTE);";

            return QueryController::parameters($query, $parameters, false);
        }

        //public
        private static function deleteAfterXMinutes($parameters = [':time' => ['value' => DEFAULT_MINUTES_TO_DELETE_CAPTCHAS] ] )
        {
            $currentDate = date("Y-m-d H:i:s");
            
            $query = "DELETE FROM captchas
                          WHERE createdAtCaptcha < DATE_SUB('$currentDate', INTERVAL :time MINUTE);";

            return QueryController::parameters($query, $parameters, true);
        }

        public static function clean($parameters = [':time' => ['value' => DEFAULT_MINUTES_TO_DELETE_CAPTCHAS] ] )
        {
            require_once 'config/_index.php';

            $captchas = self::getAllAfterXMinutes($parameters);
            foreach ($captchas as $captcha)
            {   
                $urlCaptcha = CAPTCHA_URL_OUTPUT . $captcha->urlCaptcha;
                if (file_exists($urlCaptcha))
                {
                    unlink($urlCaptcha);
                }
            }
            self::deleteAfterXMinutes($parameters);
        }

        public static function create($imageCount = -1, $captchaFileName = '')
        {
            $totalWidth = 0;
            $maxHeight = 0;
            $xOffset = 0;
            $imageResources = [];
            $randomNumbers = [];

            if($imageCount == -1)
            {
                $imageCount = rand(2, 9); 
            }
            if($captchaFileName == '')
            {
                $captchaFileName = CAPTCHA_URL_OUTPUT . time() . '_' . uniqid() . '.jpg';
            }
            
            for ($i = 0; $i < $imageCount; $i++)
            {
                $folder = rand(0,5);
                $randomNumbers[] = rand(0, 9);
                $imagePath = CAPTCHA_URL_INPUT . $folder . '/' . $randomNumbers[$i] . '.jpg'; 

                $info = getimagesize($imagePath); 
                $totalWidth += $info[0];
                $maxHeight = max($maxHeight, $info[1]);
                $imageResources[] = imagecreatefromjpeg($imagePath);
            }

            $backgroundImage = imagecreatetruecolor($totalWidth, $maxHeight);
            
            foreach ($imageResources as $resource)
            {
                imagecopy($backgroundImage, $resource, $xOffset, 0, 0, 0, imagesx($resource), imagesy($resource)); 
                $xOffset += imagesx($resource);
                imagedestroy($resource);  // Free resource
            }
            
            imagejpeg($backgroundImage, $captchaFileName); // Save the resulting image   
            imagedestroy($backgroundImage); // Free resource

            $randomNumbersString = implode('', $randomNumbers);
            return [$captchaFileName, $randomNumbersString];
        }

        public static function save($url, $value, $delete = true, $parameters = [':time' => ['value' => DEFAULT_MINUTES_TO_DELETE_CAPTCHAS] ] )
        {
            require_once 'models/captcha-model.php';
            $captcha = new Captcha([
                'valueCaptcha' => $value,
                'urlCaptcha' => str_replace(CAPTCHA_URL_OUTPUT, '', $url),
                'createdAtCaptcha' => date('Y-m-d H:i:s'),
            ]);
            if($delete)
            {
                self::clean($parameters);
            }
            return self::createOne($captcha);
        }
	}


?>