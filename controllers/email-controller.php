<?php

    require_once 'config/_index.php';
    require_once 'database/database-adapter.php';
    require_once 'controllers/website-controller.php';
    
    class EmailController
    {
        private static function sendCustom($recipientEmail, $bodyContent, $header)
        {
            require_once 'assets/PHPMailer-6.9.3/src/PHPMailer.php';
            require_once 'assets/PHPMailer-6.9.3/src/Exception.php';
            require_once 'assets/PHPMailer-6.9.3/src/SMTP.php';

            $mail = new PHPMailer\PHPMailer\PHPMailer(true);

            try
            {
                if (empty($recipientEmail)) { throw new Exception("Recipient email error", 1); }
                if (empty($bodyContent)) { throw new Exception("Email bodyContent error", 1); }
                if (empty($header)) { throw new Exception("Email header error", 1); }

                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = WebsiteController::current()->mailFromTokenWebsite;
                $mail->Password = WebsiteController::current()->tokenMailWebsite;
                $mail->SMTPSecure = 'tls'; // Enable TLS encryption
                $mail->Port = 587; // TCP port for TLS
                $mail->CharSet = 'utf-8';

                // Disable certificate verification (only for development)
                $mail->SMTPOptions = array(
                    'ssl' => array(
                        'verify_peer' => false,
                        'verify_peer_name' => false,
                        'allow_self_signed' => true
                    )
                );

                $mail->setFrom(WebsiteController::current()->mailFromTokenWebsite, WebsiteController::current()->nameWebsite);
                $mail->addAddress($recipientEmail);

                $mail->isHTML(true);
                $mail->Subject = $header;
                $mail->Body = $bodyContent;

                $mail->send();
                return true;
            }
            catch (PDOException $e) { DatabaseAdapter::showError($e); }
        }

        public static function send($recipientEmail, $bodyContent, $header = '')
        {
            if (SEND_EMAIL)
            {
                return self::sendCustom($recipientEmail, $bodyContent, $header);
            }
            return true;
        }
    }

?>
