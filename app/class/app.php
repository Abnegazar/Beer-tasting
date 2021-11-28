<?php

class App
{

    public static function dateFr($this_date, $display_hour = false)
    {
        $return_date = false;
        if ($this_date != null && $this_date != '0000-00-00 00:00:00') {
            list($date, $heure_min_sec) = explode(' ', $this_date);
            list($annee, $mois, $jour) = explode('-', $date);
            $timestamp = mktime(0, 0, 0, $mois, $jour, $annee); //converts date string to UNIX timestamp
            $return_date = date('d/m/Y', $timestamp);  //puts the UNIX timestamp back into string format
            if ($display_hour && $heure_min_sec != '') {
                $return_date .= ' ' . $heure_min_sec;
            }
        }
        return $return_date; //exit function and return string
    } //end of function

    public static function dateUs($this_date, $display_hour = false)
    {
        $return_date = false;
        if ($this_date != null) {

            list($date, $heure_min_sec) = explode(' ', $this_date);
            list($jour, $mois, $annee) = explode('/', $date);
            $timestamp = mktime(0, 0, 0, $mois, $jour, $annee); //converts date string to UNIX timestamp
            if ($timestamp) $return_date = date('Y-m-d', $timestamp);  //puts the UNIX timestamp back into string format
            if ($display_hour && $heure_min_sec != '') {
                $return_date .= ' ' . $heure_min_sec;
            }
        }
        return $return_date; //exit function and return string
    } //end of function


    public static function logError($message)
    {
        App::log("LOG_ERROR : " . $message, 'error');
    }


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

    public static function get_partial($partial, $tab = array())
    {
        return self::get_content(PARTIALS_SUBFOLDER . $partial . '.phtml', $tab);
    }

    public static function getVisitorIP()
    {
        return (isset($_SERVER['REMOTE_ADDR'])) ? $_SERVER['REMOTE_ADDR'] : '127.0.0.1';
    }

    public static function test()
    {
        var_dump("hey");
    }


    public static function checkValue($values)
    {
        $errors = false;
        //score général
        foreach ($values as $testValue) {
            if (empty($testValue) && $testValue !== '0') {
                $errors[] = 'Veuillez renseigner tous les champs obligatoires.';
            } else if ((tasting::getFloat($testValue)) > 10) {
                $errors[] = 'Tous les scores donnés à la bière en général doivent être inférieurs ou égaux à 10.';
            }
        }
        return $errors;
    }
}
