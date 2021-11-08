<?php

DEFINE('APP_VERSION', '0.0.0.1');

DEFINE('DB_HOST', $_SERVER['host']);
DEFINE('DB_USER', $_SERVER['user']);
DEFINE('DB_PASSWORD', $_SERVER['password']);
DEFINE('DB_NAME', $_SERVER['database']);


DEFINE('PATTERN_PASSWORD', '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/');
DEFINE('PATTERN_PASSWORD_EXPL', '');

DEFINE('PATTERN_NAME', '/^[a-zA-Z0-9áàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ._\s-]{3,50}$/i');
DEFINE('PATTERN_NAME_EXPL', 'Votre nom et prénom doit comporter de 3 à 30 caractères alphanumériques. Les tirets \'-\' et \'_\' sont autorisés.');

require_once(CONFIG_FOLDER . 'routes.php');