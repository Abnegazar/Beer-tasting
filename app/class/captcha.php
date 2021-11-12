<?php

class Captcha
{

    public static function isCaptchaOk($response)
    {
        $secretKey = "6LcV_ysdAAAAAF9l1j_Li5Smzr0dBu-xA1qbB2O_";
        // "6LcyDSwdAAAAAJlaG5eb6Z4-gL2LhuocvVf-rIHv" (pour le serveur de prod)

        $ip = $_SERVER['REMOTE_ADDR'];

        $url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($secretKey) . '&response=' . urlencode($captchaResponse);
        $response = file_get_contents($url);
        $responseKeys = json_decode($response, true);

        if ($responseKeys["success"]) {
            return true;
        } else {
            return false;
        }
    }
}