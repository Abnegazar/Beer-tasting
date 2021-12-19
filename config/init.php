<?php

DEFINE('APP_VERSION', '0.0.0.1');
DEFINE('APP_NAME', 'TasteMyBeer');


DEFINE('DB_HOST', $_SERVER['host']);
DEFINE('DB_USER', $_SERVER['user']);
DEFINE('DB_PASSWORD', $_SERVER['password']);
DEFINE('DB_NAME', $_SERVER['database']);

DEFINE('DEFAULT_PAGINATION', '10');

DEFINE('PATTERN_PASSWORD', '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/');
DEFINE('PATTERN_PASSWORD_EXPL', '');

DEFINE('PATERN_TWO_DECIMAL_DIGIT_NUMBER', '/^([0-9]{1,2}\.)?[0-9]{1,2}$/i');
DEFINE('PATERN_TWO_DECIMAL_DIGIT_NUMBER_EXPL', 'Veuillez entre une valeur décimale de deux chiffre au plus après la virgule.');

DEFINE('PATERN_ONE_DIGIT_BETWEEN_1_AND_5', '/^[1-5]$/');
DEFINE('PATERN_ONE_DIGIT_BETWEEN_1_AND_5_EXPL', 'Veuillez entre un chiffre compris entre 1 et 5.');

DEFINE('PATTERN_NAME', '/^[a-zA-Z0-9áàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ._\s-]{3,50}$/i');
DEFINE('PATTERN_NAME_EXPL', 'Votre nom doit comporter de 3 à 30 caractères alphanumériques. Les tirets \'-\' et \'_\' sont autorisés.');
DEFINE('PATTERN_FIRST_NAME_EXPL', str_replace('nom', 'prénom', PATTERN_NAME_EXPL));

if (
    !empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off'
    || (isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == 443)
) {
    DEFINE('SITE_PROTOCOL', 'https');
} else {
    DEFINE('SITE_PROTOCOL', 'http');
}

DEFINE('SITE_URL', SITE_PROTOCOL . '://' . SERVER_NAME . '/');
DEFINE('VENDOR_DIR', '../vendor/');

DEFINE('EMAIL_FROM',             'no-reply@tastemybeer.com');
DEFINE('EMAIL_FROM_NAME',         APP_NAME);

require_once(CONFIG_FOLDER . 'routes.php');

DEFINE('AROMA_MESSAGE', 'Comment on malt, hops, esters, and other aromatics');
DEFINE('APPEARANCE_MESSAGE', 'Comment on color, clarity, and head (retention, color, and texture)');
DEFINE('FLAVOR_MESSAGE', 'Comment on malt, hops, fermentation characteristics, balance, finish/aftertaste, and other flavor characteristics');
DEFINE('MOUTHFEEL_MESSAGE', 'Comment on body, carbonation, warmth, creaminess, astringency, and other palate sensations');
DEFINE('OVERALL_MESSAGE', 'Comment on overall drinking pleasure associated with entry, give suggestions for improvement');
DEFINE('BOTTLE_MESSAGE', 'Appropriate size, cap, fill level, label removal, etc');
DEFINE('ACETALDEHYDE_MESSAGE', 'Green apple-like aroma and flavor');
DEFINE('ALCOHOLIC_MESSAGE', 'The aroma, flavor, and warming effect of
ethanol and higher alcohols. Sometimes described as hot');
DEFINE('ASTRINGENT_MESSAGE', 'Puckering, lingering harshness and/or dryness
in the finish/aftertaste; harsh graininess; huskiness');
DEFINE('DIACETYL_MESSAGE', 'Artificial butter, butterscotch, or toffee aroma
and flavor. Sometimes perceived as a slickness on the tongue');
DEFINE('DMS_MESSAGE', 'At low levels a sweet, cooked or
canned corn-like aroma and flavor');
DEFINE('ESTERY_MESSAGE', 'Aroma and/or flavor of any ester (fruits, fruit
flavorings, or roses)');
DEFINE('GRASSY_MESSAGE', 'Aroma/flavor of fresh-cut grass or green leaves');
DEFINE('LIGHTSTRUCK_MESSAGE', 'Similar to the aroma of a skunk');
DEFINE('METALLIC_MESSAGE', 'Tinny, coiny, copper, iron, or blood-like flavor');
DEFINE('MUSTY_MESSAGE', 'Stale, musty, or moldy aromas/flavors');
DEFINE('OXIDIZED_MESSAGE', 'Any one or combination of stale, winy/vinous,
cardboard, papery, or sherry-like aromas and flavors');
DEFINE('PHENOLIC_MESSAGE', 'Spicy (clove, pepper), smoky, plastic, plastic
adhesive strip, and/or medicinal (chlorophenolic)');
DEFINE('SOLVENT_MESSAGE', 'Aromas and flavors of higher alcohols (fusel
alcohols). Similar to acetone or lacquer thinner aromas');
DEFINE('SOURACIDIC_MESSAGE', 'Tartness in aroma and flavor. Can be sharp
and clean (lactic acid), or vinegar-like (acetic acid)');
DEFINE('SULFUR_MESSAGE', 'The aroma of rotten eggs or burning matches');
DEFINE('VEGETAL_MESSAGE', '– Cooked, canned, or rotten vegetable aroma and
flavor (cabbage, onion, celery, asparagus, etc.)');
DEFINE('YEASTY_MESSAGE', '– A bready, sulfury or yeast-like aroma or flavor');

DEFINE('STYLISTIC_MESSAGE_START', 'Not to style');
DEFINE('STYLISTIC_MESSAGE_END', 'Classic example');
DEFINE('TECHNICALMERIT_MESSAGE_START', 'Significant flaws');
DEFINE('TECHNICALMERIT_MESSAGE_END', 'Flawless');
DEFINE('INTANGIBLES_MESSAGE_START', 'Lifeless');
DEFINE('INTANGIBLES_MESSAGE_END', 'Wonderful');