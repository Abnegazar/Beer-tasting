<?php

DEFINE('APP_VERSION', '0.0.0.1');

DEFINE('DB_HOST', $_SERVER['host']);
DEFINE('DB_USER', $_SERVER['user']);
DEFINE('DB_PASSWORD', $_SERVER['password']);
DEFINE('DB_NAME', $_SERVER['database']);


DEFINE('PATTERN_PASSWORD', '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/');
DEFINE('PATTERN_PASSWORD_EXPL', '');

DEFINE('PATERN_TWO_DECIMAL_DIGIT_NUMBER', '/^([0-9]{1,2}\.)?[0-9]{1,2}$/');
DEFINE('PATERN_TWO_DECIMAL_DIGIT_NUMBER_EXPL', 'Veuillez entre une valeur décimale de deux chiffre au plus après la virgule.');

DEFINE('PATERN_ONE_DIGIT_BETWEEN_1_AND_5', '/^[1-5]$/');
DEFINE('PATERN_ONE_DIGIT_BETWEEN_1_AND_5_EXPL', 'Veuillez entre un chiffre compris entre 1 et 5.');

DEFINE('PATTERN_NAME', '/^[a-zA-Z0-9áàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ._\s-]{3,50}$/i');
DEFINE('PATTERN_NAME_EXPL', 'Votre nom et prénom doit comporter de 3 à 30 caractères alphanumériques. Les tirets \'-\' et \'_\' sont autorisés.');

DEFINE('DEFAULT_PAGINATION', 2);

require_once(CONFIG_FOLDER . 'routes.php');
