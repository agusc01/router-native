<?php
    class Fetch
    {
        public static function response($header, $jsonEncode) 
        {
            header($header);
            echo json_encode($jsonEncode);
            exit;
        }
    
        public static function badResponse($jsonEncode)
        {
            $jsonEncode['sucess'] = false;
            self::response('HTTP/1.1 400 Bad Request',$jsonEncode);
        }
    
        public static function okResponse($jsonEncode)
        {
            $jsonEncode['sucess'] = true;
            self::response('HTTP/1.1 200 OK',$jsonEncode);
        }
    }
?>