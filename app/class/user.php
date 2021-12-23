<?php
/**
 * a class for the Users model
 * @author PDL groupe 4
 */
class User
{
    const ID = 'user_id';
    const FIRST_NAME = 'first_name';
    const LAST_NAME = 'last_name';
    const EMAIL = 'email';
    const IS_VERIFIED = 'is_verified';

    public $id;
    public $firstName;
    public $lastName;
    public $email;
    public $password;
    public $tastings;
    /**
     * Constructor to initialize all elements
     */
    public function __construct()
    {
        $this->id = false;
        $this->firstName = false;
        $this->lastName = false;
        $this->email = false;
        $this->password = false;
        $this->isVerified = false;
    }
    /**
     * Init a user with specific value
     * @param id the user id
     * @param firstName the user first name
     * @param lastName the user last name
     * @param email the user email
     * @param password the user password
     */
    public function initValue($id = false, $firstName, $lastName, $email, $password = false)
    {
        $this->id = ($id) ? $id : false;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->password = ($password) ? $password : false;
    }
    /**
     * Init a user with a database object
     * @param o the database object
     */
    public function __initFromDbObject($o)
    {
        $this->id = (int)$o[self::ID];
        $this->firstName = $o[self::FIRST_NAME];
        $this->lastName = $o[self::LAST_NAME];
        $this->email = $o[self::EMAIL];
        $this->tastings = Tasting::getUserTastings($this->id);
    }
    /**
     * save an user in the database 
     * @return boolean the operation answer
     */
    public function save()
    {
        $res = false;
        $dbInstance = Db::getInstance()->getDbInstance();
        $sql = 'INSERT INTO user (first_name, last_name, email, `password`)
                    VALUES (
                        \'' . mysqli_real_escape_string($dbInstance, $this->firstName) . '\', 
                        \'' . mysqli_real_escape_string($dbInstance, $this->lastName) . '\', 
                        \'' . mysqli_real_escape_string($dbInstance, $this->email) . '\', 
                        \'' . App::createPasswordHash(mysqli_real_escape_string($dbInstance, $this->password)) . '\'
                    )';
        $result = mysqli_query($dbInstance, $sql);
        if ($result) {
            return true;
        } else {
            App::logError(mysqli_error($dbInstance) . "\r\n" . $sql);
        }
        return $res;
    }

    /**
     * Provide a user by her id
     * @param id the user id
     * @return res an instance of user or false if the operation failed
     */
    public static function getUserById($id = false)
    {
        $res = false;
        $dbInstance = Db::getInstance()->getDbInstance();
        $id = ($id) ? $id : Session::getConnectedUserId();
        $sql = 'SELECT * FROM user WHERE user.user_id = ' . (int)$id . '';
        $result = mysqli_query($dbInstance, $sql);
        if ($result) {
            $user = new User();
            while ($row = mysqli_fetch_assoc($result)) {
                $user->__initFromDbObject($row);
            }
            return $user;
        } else {
            App::logError(mysqli_error($dbInstance) . "\r\n" . $sql);
        }
        return $res;
    }
    /**
     * Connect a user to the app by her email and her password
     * @param email an user email
     * @param password an user password
     * @return res an user instance or false if the operation failed
     */
    public static function logIn($email, $password)
    {
        $res = false;
        $dbInstance = Db::getInstance()->getDbInstance();
        $email = mysqli_real_escape_string($dbInstance, $email);
        $password = mysqli_real_escape_string($dbInstance, $password);
        $sql = 'SELECT * FROM user WHERE email=\'' . $email . '\'';
        $result = mysqli_query($dbInstance, $sql);
        if ($result) {
            if (mysqli_num_rows($result) == 1) {
                $row = mysqli_fetch_assoc($result);
                if ($row[self::IS_VERIFIED] == 0) {
                    if (password_verify($password, $row['password'])) {
                        $user = new User();
                        $user->__initFromDbObject($row);
                        return $user;
                    }
                }
            }
        }
        return $res;
    }
    /**
     * Check if the user exists in the database by her email
     * @param email the user email
     * @return boolean the operation answer
     */
    public static function isUserExists($email)
    {
        $res = false;
        $dbInstance = Db::getInstance()->getDbInstance();
        $email = mysqli_real_escape_string($dbInstance, $email);
        $sql = 'SELECT * FROM user WHERE email=\'' . $email . '\'';
        $result = mysqli_query($dbInstance, $sql);
        if ($result) {
            if (mysqli_num_rows($result) == 1) {
                $res = true;
            }
        }
        return $res;
    }
   /**
    * Remove the connected user of the database
    *@return boolean the operation answer
    */
    public static function delete()
    {
        $res = false;
        if (Tasting::deleteUserTasting()) {
            $dbInstance = Db::getInstance()->getDbInstance();
            $sql = "DELETE FROM user WHERE user_id= " . Session::getConnectedUserId();
            $result = mysqli_query($dbInstance, $sql);
            if ($result) {
                $res = true;
            }
        }
        return $res;
    }
    /**
     * Check if a value is equals at the old user password
     * @param oldPassword the value
     * @return boolean the operation answer
     */
    public static function checkOldPassword($oldPassword)
    {
        $res = false;
        $dbInstance = Db::getInstance()->getDbInstance();
        $sql = "SELECT user.password FROM user WHERE user_id=" . Session::getConnectedUserId();
        $result = mysqli_query($dbInstance, $sql);
        if ($result) {
            $row = mysqli_fetch_assoc($result);
            $oldPassword = mysqli_real_escape_string($dbInstance, $oldPassword);
            if (password_verify($oldPassword, $row['password'])) {
                $res = true;
            }
        } else {
            App::logError(mysqli_error($dbInstance) . "\r\n" . $sql);
        }
        return $res;
    }
    /**
     * Update the connected  user password 
     * @param oldPassword the old password
     * @param newPassword the new password
     * @return boolean the operation answers
     */
    public static function updatePassword($oldPassword, $newPassword)
    {
        $res = false;
        if (User::checkOldPassword($oldPassword)) {
            $dbInstance = Db::getInstance()->getDbInstance();
            $password = App::createPasswordHash(mysqli_real_escape_string($dbInstance, $newPassword));
            $sql = "UPDATE user SET user.password = \"" . $password . "\" WHERE user_id= " . Session::getConnectedUserId();
            $result = mysqli_query($dbInstance, $sql);
            if ($result) {
                $res = true;
            } else {
                App::logError(mysqli_error($dbInstance) . "\r\n" . $sql);
            }
        }
        return $res;
    }

    /**
     * Check if the user name match with the name rules
     * @return boolean the operation answer
     */
    public static function checkUserName($text)
    {
        return preg_match(PATTERN_NAME, $text);
    }
    /**
     * Update the connected user name
     * @param first_name the user first name
     * @param last_name the user last name
     * @return boolean the operation answer
     */
    public static function updateUsername($first_name, $last_name)
    {
        $res = false;
        $dbInstance = Db::getInstance()->getDbInstance();

        $first_name = mysqli_real_escape_string($dbInstance, $first_name);
        $last_name = mysqli_real_escape_string($dbInstance, $last_name);

        $sql = "UPDATE user SET user.first_name = '" . $first_name . "', user.last_name = '" . $last_name . "' WHERE user_id= " . Session::getConnectedUserId();
        $result = mysqli_query($dbInstance, $sql);

        if ($result) {
            $res = true;
        } else {
            App::logError(mysqli_error($dbInstance) . "\r\n" . $sql);
        }
        return $res;
    }
}
