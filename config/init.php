<?php

DEFINE('APP_VERSION', '0.0.0.1');

DEFINE('DB_HOST', $_SERVER['host']);
DEFINE('DB_USER', $_SERVER['user']);
DEFINE('DB_PASSWORD', $_SERVER['password']);
DEFINE('DB_NAME', $_SERVER['database']);

require_once(CONFIG_FOLDER . 'routes.php');