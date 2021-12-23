<?php

class Captcha
{
    public static function isCaptchaOk($response)
    {
        $secretKey = "6LcyDSwdAAAAAJlaG5eb6Z4-gL2LhuocvVf-rIHv";

        $ip = $_SERVER['REMOTE_ADDR'];

        $url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($secretKey) . '&response=' . urlencode($response);
        $response = file_get_contents($url);
        $responseKeys = json_decode($response, true);

        if ($responseKeys["success"]) {
            return true;
        } else {
            return false;
        }
    }
}