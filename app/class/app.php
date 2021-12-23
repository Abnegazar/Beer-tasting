<?php
/**
 * A class for static function
 * @author PDL groupe 4
 */
class App
{
    /**
     * Transform the date into french format
     * @param this_date The date to be formatted
     * @param display_hour To decide whether to display the time or only the date
     * @return return_date the formatted date
     */
    public static function dateFr($this_date, $display_hour = false)
    {
        $return_date = false;
        if ($this_date != null && $this_date != '0000-00-00 00:00:00') {
            list($date, $heure_min_sec) = explode(' ', $this_date);
            list($annee, $mois, $jour) = explode('-', $date);
            $timestamp = mktime(0, 0, 0, $mois, $jour, $annee);
            $return_date = date('d/m/Y', $timestamp);
            if ($display_hour && $heure_min_sec != '') {
                $return_date .= ' ' . $heure_min_sec;
            }
        }
        return $return_date;
    }
    /**
     * Transform the date into US format
     * @param this_date The date to be formatted
     * @param display_hour To decide whether to display the time or only the date
     * @return return_date the formatted date
     */
    public static function dateUs($this_date, $display_hour = false)
    {
        $return_date = false;
        if ($this_date != null) {

            list($date, $heure_min_sec) = explode(' ', $this_date);
            list($jour, $mois, $annee) = explode('/', $date);
            $timestamp = mktime(0, 0, 0, $mois, $jour, $annee);
            if ($timestamp) $return_date = date('Y-m-d', $timestamp);
            if ($display_hour && $heure_min_sec != '') {
                $return_date .= ' ' . $heure_min_sec;
            }
        }
        return $return_date;
    }

    /**
     * Display an error message into the log
     * @param message The error message
     */
    public static function logError($message)
    {
        App::log("LOG_ERROR : " . $message, 'error');
    }

      /**
     * Display a message into the log
     * @param message The message to display
     * @param file Decide if the message is displaying into a file or into a log
     */
    public static function log($message, $file = false)
    {
        if (!file_exists(LOGS_FOLDER)) {
            @mkdir(LOGS_FOLDER, 0755, true);
        }
        $filename = LOGS_FOLDER . $file . '_' . date('Ymd') . '.log';
        $user = Session::getConnectedUser();
        $line = date("d/m/Y H:i:s") . "\t userId:" . (($user) ? $user->id : '-') . "\t @" . $_SERVER['REMOTE_ADDR'] . "\t" . $message . "\n";
        if (defined('DEBUG')) echo $line;
        if (!@file_put_contents($filename, $line, FILE_APPEND)) {
        }
    }

     /**
     * Get a content 
     * @param file the content file name
     * @param tab an array who contains parameters for the file
     * @param inViewsFolder Decide if the content is in the views folder or not
     * @return content the content 
     */
    public static function get_content($file, $tab = array(), $inViewsFolder = true)
    {
        if ($inViewsFolder) $file = VIEWS_FOLDER . $file;
        $var = (object)$tab;

        ob_start();

        include $file;

        $content = ob_get_contents();
        ob_end_clean();


        return $content;
    }
     /**
     * Get a partial content
     * @param partial the partial name file
     * @param tab an array who contains parameters for the file
     * @return partial the partial content
     */
    public static function get_partial($partial, $tab = array())
    {
        return self::get_content(PARTIALS_SUBFOLDER . $partial . '.phtml', $tab);
    }
     /**
     * Get a visitor ip adress
     */
    public static function getVisitorIP()
    {
        return (isset($_SERVER['REMOTE_ADDR'])) ? $_SERVER['REMOTE_ADDR'] : '127.0.0.1';
    }
     /**
     * Test elements
     */
    public static function test()
    {
        var_dump("hey");
    }

     /**
     * Test values validities
     * @param values the values to test
     * @return errors an array containing all the rules not respected
     */
    public static function checkValue($values)
    {
        $errors = false;
        //score général
        foreach ($values as $testValue) {
            if (empty($testValue) && $testValue !== '0') {
                $errors[] = 'Veuillez renseigner tous les champs obligatoires.';
            }
        }
        return $errors;
    }
     /**
     * transform the date into US date format
     * @param this_date the date to format
     * @return date  the date in US format whitout hours
     */
    public static function dateUsOnlyDate($this_date)
    {
        return substr($this_date, 0, 10);
    }
     /**
     * transform SQL date into US date format
     * @param this_date the date to format
     * @param display_hour To decide whether to display the time or only the date
     * @return date the sql date into US format 
     */
    public static function dateSqlToUs($this_date, $display_hour = false)
    {
        $return_date = false;
        if ($this_date != null) {

            return substr($this_date, 0, 10);
        }
        return $return_date; //exit function and return string
    } //end of function

    /**
     * Get offFlavor name by her variable 
     * @param value the offFlavor variable
     * @return string the offFlavor name
     */
    public static function renameOffFlavor($value)
    {
        switch ($value) {
            case OffFlavor::IS_ACETALDEHYDE:
                return 'Acetaldehyde';
                break;
            case OffFlavor::IS_ACIDIC:
                return 'Acidic';
                break;
            case OffFlavor::IS_ASTRINGENT:
                return 'Astringent';
                break;
            case OffFlavor::IS_DIACETYL:
                return 'Diacetyl';
                break;
            case OffFlavor::IS_DMS:
                return 'DMS';
                break;
            case OffFlavor::IS_ESTERY:
                return 'Estery';
                break;
            case OffFlavor::IS_GRASSY:
                return 'Grassy';
                break;
            case OffFlavor::IS_LIGHT_STRUCK:
                return 'Light struck';
                break;
            case OffFlavor::IS_METALLIC:
                return 'Metallic';
                break;
            case OffFlavor::IS_MUSTY:
                return 'Musty';
                break;
            case OffFlavor::IS_OXIDIZED:
                return 'Oxidized';
                break;
            case OffFlavor::IS_PHENOLIC:
                return 'Phenolic';
                break;
            case OffFlavor::IS_SOLVENT:
                return 'Solvent';
                break;
            case OffFlavor::IS_SULFUR:
                return 'Sulfur';
                break;
            case OffFlavor::IS_VEGETAL:
                return 'Vegetal';
                break;
            case OffFlavor::IS_YEASTY:
            default:
                return 'Yeasty';
                break;
        }
    }
    /**
     * Get offFlavor comment text by her name
     * @param value the offFlavor name
     * @return string the offFlavor comment text
     */
    public static function getOffFlavorText($value)
    {
        switch ($value) {
            case 'Acetaldehyde':
                return ACETALDEHYDE_MESSAGE;
                break;
            case 'Acidic':
                return SOURACIDIC_MESSAGE;
                break;
            case 'Astringent':
                return ASTRINGENT_MESSAGE;
                break;
            case 'Diacetyl':
                return DIACETYL_MESSAGE;
                break;
            case 'DMS':
                return DMS_MESSAGE;
                break;
            case 'Estery':
                return ESTERY_MESSAGE;
                break;
            case 'Grassy':
                return GRASSY_MESSAGE;
                break;
            case 'Light struck':
                return LIGHTSTRUCK_MESSAGE;
                break;
            case 'Metallic':
                return METALLIC_MESSAGE;
                break;
            case 'Musty':
                return MUSTY_MESSAGE;
                break;
            case 'Oxidized':
                return OXIDIZED_MESSAGE;
                break;
            case 'Phenolic':
                return PHENOLIC_MESSAGE;
                break;
            case 'Solvent':
                return SOLVENT_MESSAGE;
                break;
            case 'Sulfur':
                return SULFUR_MESSAGE;
                break;
            case 'Vegetal':
                return VEGETAL_MESSAGE;
                break;
            case 'Yeasty':
            default:
                return  YEASTY_MESSAGE;
                break;
        }
    }
    /**
     * Get appropriate comment for a mark
     * @param value the mark
     * @return string the appropriate comment
     */
    public static function getComment($value)
    {
        switch ($value) {
            case tasting::OUTSTANDING['label']:
                return OUTSTANDING_COMMENT;
                break;
            case tasting::EXCELLENT['label']:
                return EXCELLENT_COMMENT;
                break;
            case tasting::VERY_GOOD['label']:
                return VERY_GOOD_COMMENT;
                break;
            case tasting::GOOD['label']:
                return GOOD_COMMENT;
                break;
            case tasting::FAIR['label']:
                return FAIR_COMMENT;
                break;
            default:
                return PROBLEMATIC_COMMENT;
                break;
        }
    }
    /**
     * Hash password
     * @param value the password
     * @return string the password hash correspondance
     */
    public static function createPasswordHash($password)
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }
     /**
     * Convert date in an appropriate lang
     * @param value the date to convert
     * @return date the date in appropriate lang
     */
    public static function convertDate($date)
    {
        switch (Session::getUserLang()) {
            case Session::LANG_FR:
                return App::dateFr($date);
                break;
            case Session::LANG_EN:
            default:
                return App::dateUsOnlyDate($date);
        }
    }
}