<?php

// include require files
include_once(APP_ROOT . '/vendor/autoload.php');

include_once(APP_ROOT . '\vendor\phpmailer\phpmailer\src\PHPMailer.php');
include_once(APP_ROOT . '\vendor\phpmailer\phpmailer\src\Exception.php');
include_once(APP_ROOT . '\vendor\phpmailer\phpmailer\src\SMTP.php');



//use <library>  

//include_once("init.php");

//Import PHPMailer classes into the global namespace; define namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

class Mailer
{

    static function sendMail($userEmail, $message, $subject)
    {
        try {

            //Create an instance; passing `true` enables exceptions
            $mail = new PHPMailer(true);


            //Server settings
            //$mail->SMTPDebug = 0;                      //Enable verbose debug output
            //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = ENV['MAILGUN_SMTP_SERVER'];                       //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = ENV['MAILGUN_SMTP_LOGIN'];                  //SMTP username     //gmail username
            $mail->Password   = ENV['MAILGUN_SMTP_PASSWORD'];  //Hello world !!!            //SMTP password     //gmail password
            $mail->SMTPSecure = 'tls';            //Enable implicit TLS encryption
            $mail->Port       = ENV['MAILGUN_SMTP_PORT']; //587;                              //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->From = EMAIL_FROM;
            $mail->FromName = APP_NAME;
            //$mail->setFrom($mail->Username, EMAIL_FROM);
            //$mail->addAddress('joe@example.net', 'Joe User');     //Add a recipient
            $mail->addAddress($userEmail);               //Name is optional
            //$mail->addReplyTo('info@example.com', 'Information');
            //$mail->addCC('cc@example.com');
            //$mail->addBCC('bcc@example.com');

            //Attachments
            //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
            //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = $subject;
            $mail->Body    = $message;
            //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
            if (!$mail->send()) {
                return false;
            }
            if (!$mail->send()) {
                echo "Message hasn't been sent.";
                App::logError('Mailer Error: ' . $mail->ErrorInfo . "n");
                $mail->smtpClose();

                return false;
            } else {
                echo "Message has been sent  n";
                $mail->smtpClose();
                return true;
            }
        } catch (Exception $e) {
            $mail->smtpClose();
            App::logError('Mailer Error: ' . $e . "n");
            return false;
        }
    }
}