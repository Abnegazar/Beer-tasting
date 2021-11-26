<?php

class Db
{
    public static $instance;
    public static $dbInstance;

    // Un constructeur prive empece la création directe d'objet
    public function __construct()
    {
        self::$dbInstance = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        if (!self::$dbInstance) {
            header("HTTP/1.0 500 Internal Server Error");
            die();
        }
    }

    public function close()
    {
        if (self::$dbInstance) {
            mysqli_close(self::$dbInstance);
        }
        self::$dbInstance = null;
    }


    public static function getInstance()
    {
        gc_collect_cycles();
        if (!isset(self::$instance)) {
            $c = __CLASS__;
            self::$instance = new $c;
        }
        return self::$instance;
    }

    public static function getDbInstance()
    {
        return self::$dbInstance;
    }
}
