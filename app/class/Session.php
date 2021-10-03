<?php
class Session
{

    const USER = 'user';
    const USER_ID = 'user_id';

    private static function setConnectedUserId($user_id)
    {
        $_SESSION[self::USER_ID] = $user_id;
        return true;
    }

    public static function getConnectedUserId()
    {
        $user_id = false;
        if (isset($_SESSION[self::USER_ID])) {
            $user_id = $_SESSION[self::USER_ID];
        }

        return $user_id;
    }

    private static function deleteConnectedUserId()
    {
        unset($_SESSION[self::USER_ID]);
    }


    public static function setConnectedUser($user)
    {
        if ($user) {
            $_SESSION[self::USER] = serialize($user);
            self::setConnectedUserId($user->id);
        }
        return true;
    }

    public static function getConnectedUser()
    {
        $user = false;
        if (isset($_SESSION[self::USER])) {
            $user = unserialize($_SESSION[self::USER]);
        }

        return $user;
    }

    public static function deleteConnectedUser()
    {
        unset($_SESSION[self::USER]);
        self::deleteConnectedUserId();
    }
}