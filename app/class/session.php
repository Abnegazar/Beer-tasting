<?php
/**
 * a class for the User session
 * @author PDL groupe 4
 */
class Session
{

    const USER = 'user';
    const USER_ID = 'userId';
    const LANG = 'lang';
    const LANG_FR = 'fr';
    const LANG_EN = 'en';

    /**
     * Put the user as connected
     * @param userId the connected user id
     * @return boolean true for say that the user is really connected
     */
    public static function setConnectedUserId($userId)
    {
        $_SESSION[self::USER_ID] = $userId;
        return true;
    }
    /**
     * Get the connected user session
     * @return int the connected user id
     */
    public static function getConnectedUserId()
    {
        $user_id = false;
        if (isset($_SESSION[self::USER_ID])) {
            $user_id = $_SESSION[self::USER_ID];
        }
        return $user_id;
    }
    /**
     * Delete the session of the connected user
     */
    public static function deleteConnectedUserId()
    {
        unset($_SESSION[self::USER_ID]);
    }

    /**
     * Save the connected user instance
     * @param user the connected user instance
     * @return boolean true for say that the instance has been successfully saved
     */
    public static function setConnectedUser($user)
    {
        if ($user) {
            $_SESSION[self::USER] = serialize($user);
            self::setConnectedUserId($user->id);
        }
        return true;
    }
    /**
     * Save the session language 
     * @param lang the session language
     * @return boolean true for say that the language has been successfully saved
     */
    public static function setUserLang($lang)
    {
        $_SESSION[self::LANG] = $lang;
        return true;
    }
    /**
     * Provide the session language
     * @return lang the session language
     */
    public static function getUserLang()
    {
        $lang = false;
        if (isset($_SESSION[self::LANG])) {
            $lang = $_SESSION[self::LANG];
        }
        return $lang;
    }
    /**
     * Provide the connected user instance
     * @return user the connected user instance
     */
    public static function getConnectedUser()
    {
        $user = false;
        if (isset($_SESSION[self::USER])) {
            $user = unserialize($_SESSION[self::USER]);
        }

        return $user;
    }
    /**
     * Delete the connected user instance
     */
    public static function deleteConnectedUser()
    {
        unset($_SESSION[self::USER]);
        self::deleteConnectedUserId();
    }
}