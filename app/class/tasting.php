<?php

class Tasting
{
    const ID = 'id';
    const TITLE = 'title';

    const USER_ID = 'user_id';
    const BEER_STYLE_ID = 'beer_style_id';

    const AROMA_COMMENT = 'aroma_comment';
    const APPEARANCE_COMMENT = 'appearance_comment';
    const FLAVOR_COMMENT = 'flavor_comment';
    const MOUTHFEEL_COMMENT = 'mouthfeel_comment';
    const OVERALL_COMMENT = 'flavor_comment';

    const AROMA_SCORE = 'aroma_score';
    const APPEARANCE_SCORE = 'appearance_score';
    const FLAVOR_SCORE = 'flavor_score';
    const MOUTHFEEL_SCORE = 'mouthfeel_score';
    const OVERALL_SCORE = 'flavor_score';
    const TOTAL = 'total';

    const IS_ACETALDEHYDE = 'is_acetaldehyde';
    const IS_ALCOHOLIC = 'is_alcoholic';
    const IS_ASTRINGENT = 'is_astringent';
    const IS_DIACETYL = 'is_diacetyl';
    const IS_DMS = 'is_dms';
    const IS_ESTERY = 'is_estery';
    const IS_GRASSY = 'is_grassy';
    const IS_LIGHT_STRUCK = 'is_light_struck';
    const IS_METALLIC = 'is_metallic';
    const IS_MUSTY = 'is_musty';
    const IS_OXIDIZED = 'is_oxidized';
    const IS_PHENOLIC = 'is_phenolic';
    const IS_SOLVENT = 'is_solvent';
    const IS_ACIDIC = 'is_acidic';
    const IS_SULFUR = 'is_sulfur';
    const IS_VEGETAL = 'is_vegetal';
    const IS_BOTTLE_OK = 'is_bottle_ok';
    const IS_YEASTY = 'is_yeasty';

    const STYLISTIC_ACCURACY = 'stylistic_accuracy';
    const INTANGIBLES = 'intangibles';
    const TECHNICAL_MERIT = 'technical_merit';

    const OUTSTANDING = array('label' => 'Outstanding', 'range' => array('start' => 45, 'end' => 50));
    const EXCELLENT = array('label' => 'Excellent', 'range' => array('start' => 38, 'end' => 44));
    const VERY_GOOD = array('label' => 'Very good', 'range' => array('start' => 30, 'end' => 37));
    const GOOD = array('label' => 'Good', 'range' => array('start' => 21, 'end' => 29));
    const FAIR = array('label' => 'Fair', 'range' => array('start' => 14, 'end' => 20));
    const PROBLEMATIC = array('label' => 'Problematic', 'range' => array('start' => 0, 'end' => 13));

    private $userId;
    private $beerId;

    private $id;
    private $title;

    private $aromaComment;
    private $appearanceComment;
    private $flavorComment;
    private $mouthfeelComment;
    private $overallComment;

    private $aromaScore;
    private $appearanceScore;
    private $flavorScore;
    private $mouthfeelScore;
    private $overallScore;
    private $total;
    private $score;

    private $isAcetaldehyde;
    private $isAlcoholic;
    private $isAstringent;
    private $isDiacetyl;
    private $isDms;
    private $isEstery;
    private $isGrassy;
    private $isLightStruck;
    private $isMetallic;
    private $isMusty;
    private $isOxidized;
    private $isPhenolic;
    private $isSolvent;
    private $isAcidic;
    private $isSulfur;
    private $isVegetal;
    private $isBottleOk;
    private $isYeasty;

    private $stylisticAccuracy;
    private $intangibles;
    private $technicalMerit;


    public function __construct()
    {
        $this->userId = false;
        $this->beerId = false;
        $this->id = false;
        $this->title = false;

        $this->aromaComment = false;
        $this->appearanceComment = false;
        $this->flavorComment = false;
        $this->mouthfeelComment = false;
        $this->overallComment = false;
        $this->aromaScore = false;
        $this->appearanceScore = false;
        $this->flavorScore = false;
        $this->mouthfeelScore = false;
        $this->overallScore = false;
        $this->total = false;
        $this->score = false;

        $this->isAcetaldehyde = 0;
        $this->isAlcoholic = 0;
        $this->isAstringent = 0;
        $this->isDiacetyl = 0;
        $this->isDms = 0;
        $this->isEstery = 0;
        $this->isGrassy = 0;
        $this->isLightStruck = 0;
        $this->isMetallic = 0;
        $this->isMusty = 0;
        $this->isOxidized = 0;
        $this->isPhenolic = 0;
        $this->isSolvent = 0;
        $this->isAcidic = 0;
        $this->isSulfur = 0;
        $this->isVegetal = 0;
        $this->isBottleOk = 0;
        $this->isYeasty = 0;

        $this->stylisticAccuracy = false;
        $this->intangibles = false;
        $this->technicalMerit = false;
    }


    public function __initValues()
    {
    }

    public function __initFromDbObject($o)
    {
        $this->id                = (int)$o[self::ID];
        $this->title             = $o[self::TITLE];
        $this->userId            = (int)$o[self::USER_ID];
        $this->beerId            = (int)$o[self::BEER_STYLE_ID];

        $this->aromaComment      = $o[self::AROMA_COMMENT];
        $this->appearanceComment = $o[self::APPEARANCE_COMMENT];
        $this->flavorComment     = $o[self::APPEARANCE_COMMENT];
        $this->mouthfeelComment  = $o[self::MOUTHFEEL_COMMENT];
        $this->overallComment    = $o[self::OVERALL_COMMENT];

        $this->aromaScore        = (float)$o[self::AROMA_SCORE];
        $this->appearanceScore   = (float)$o[self::APPEARANCE_SCORE];
        $this->flavorScore       = (float)$o[self::OVERALL_SCORE];
        $this->mouthfeelScore    = (float)$o[self::MOUTHFEEL_SCORE];
        $this->overallScore      = (float)$o[self::OVERALL_SCORE];

        $this->total             = (float)$o[self::TOTAL];
        $this->calculateScore();

        $this->isAcetaldehyde    = (int)$o[self::IS_ACETALDEHYDE];
        $this->isAlcoholic       = (int)$o[self::IS_ALCOHOLIC];
        $this->isAstringent      = (int)$o[self::IS_ASTRINGENT];
        $this->isDiacetyl        = (int)$o[self::IS_DIACETYL];
        $this->isDms             = (int)$o[self::IS_DMS];
        $this->isEstery          = (int)$o[self::IS_ESTERY];
        $this->isGrassy          = (int)$o[self::IS_GRASSY];
        $this->isLightStruck     = (int)$o[self::IS_LIGHT_STRUCK];
        $this->isMetallic        = (int)$o[self::IS_METALLIC];
        $this->isMusty           = (int)$o[self::IS_MUSTY];
        $this->isOxidized        = (int)$o[self::IS_OXIDIZED];
        $this->isPhenolic        = (int)$o[self::IS_PHENOLIC];
        $this->isSolvent         = (int)$o[self::IS_SOLVENT];
        $this->isAcidic          = (int)$o[self::IS_ACIDIC];
        $this->isSulfur          = (int)$o[self::IS_SULFUR];
        $this->isVegetal         = (int)$o[self::IS_VEGETAL];
        $this->isBottleOk        = (int)$o[self::IS_BOTTLE_OK];
        $this->isYeasty          = (int)$o[self::IS_YEASTY];

        $this->stylisticAccuracy = (int)$o[self::STYLISTIC_ACCURACY];
        $this->intangibles       = (int)$o[self::INTANGIBLES];
        $this->technicalMerit    = (int)$o[self::TECHNICAL_MERIT];
    }

    public function calculateScore()
    {
        switch (true) {
            case in_array($this->total, range(self::OUTSTANDING['range']['start'], self::OUTSTANDING['range']['end'])):
                $this->score = array(
                    "score" => $this->total,
                    "label" => self::OUTSTANDING['label']
                );
                break;
            case in_array($this->total, range(self::EXCELLENT['range']['start'], self::EXCELLENT['range']['end'])):
                $this->score = array(
                    "score" => $this->total,
                    "label" => self::EXCELLENT['label']
                );
                break;
            case in_array($this->total, range(self::VERY_GOOD['range']['start'], self::VERY_GOOD['range']['end'])):
                $this->score = array(
                    "score" => $this->total,
                    "label" => self::VERY_GOOD['label']
                );
                break;
            case in_array($this->total, range(self::GOOD['range']['start'], self::GOOD['range']['end'])):
                $this->score = array(
                    "score" => $this->total,
                    "label" => self::GOOD['label']
                );
                break;
            case in_array($this->total, range(self::FAIR['range']['start'], self::FAIR['range']['end'])):
                $this->score = array(
                    "score" => $this->total,
                    "label" => self::FAIR['label']
                );
                break;
            case in_array($this->total, range(self::PROBLEMATIC['range']['start'], self::PROBLEMATIC['range']['end'])):
            default:
                $this->score = array(
                    "score" => $this->total,
                    "label" => self::PROBLEMATIC['label']
                );
        }
    }

    public static function getUserTastings($userId, $offset = false, $limit = false)
    {
        $res = false;
        $dbInstance = Db::getInstance()->getDbInstance();
        $userId = ($userId) ? (int)$userId : Session::getConnectedUserId();
        $sql = "SELECT * FROM tasting WHERE tasting.user_id = " . $userId . "";
        if ($limit) {
            $sql .= ' LIMIT ' . $offset . ', ' . $limit;
        }
        $result = mysqli_query($dbInstance, $sql);
        if ($result) {
            $tastings = [];
            while ($row = mysqli_fetch_assoc($result)) {
                $tasting = new Tasting();
                $tasting->__initFromDbObject($row);
                array_push($tastings, $tasting);
            }
            return $tastings;
        } else {
            App::logError(mysqli_error($dbInstance) . "\r\n" . $sql);
        }
        return $res;
    }

    public static function getAllTastings($offset = false, $limit = false)
    {
        $res = false;
        $dbInstance = Db::getInstance()->getDbInstance();

        $offset = ($offset) ? $offset : 0;
        $sql = "SELECT * FROM tasting";
        if ($limit) {
            $sql .= ' LIMIT ' . $offset . ', ' . $limit;
        }
        $result = mysqli_query($dbInstance, $sql);
        if ($result) {
            $tastings = [];
            while ($row = mysqli_fetch_assoc($result)) {
                $tasting = new Tasting();
                $tasting->__initFromDbObject($row);
                array_push($tastings, $tasting);
            }
            return $tastings;
        } else {
            App::logError(mysqli_error($dbInstance) . "\r\n" . $sql);
        }
        return $res;
    }

    public static function getSomeTastings($limit)
    {
        $res = false;
        $dbInstance = Db::getInstance()->getDbInstance();
        $sql = "SELECT * FROM tasting ORDER BY created_time DESC limit" . $limit . "";
        $result = mysqli_query($dbInstance, $sql);
        if ($result) {
            $tastings = [];
            while ($row = mysqli_fetch_assoc($result)) {
                $tasting = new Tasting();
                $tasting->__initFromDbObject($row);
                array_push($tastings, $tasting);
            }
            return $tastings;
        } else {
            App::logError(mysqli_error($dbInstance) . "\r\n" . $sql);
        }
        return $res;
    }

    public static function getSomeUserTastings($userId = false, $limit)
    {
        $res = false;
        $dbInstance = Db::getInstance()->getDbInstance();
        $userId = ($userId) ? (int)$userId : Session::getConnectedUserId();
        $sql = "SELECT * FROM tasting WHERE tasting.user_id = " . $userId . " LIMIT " . $limit . "";
        $result = mysqli_query($dbInstance, $sql);
        if ($result) {
            $tastings = [];
            while ($row = mysqli_fetch_assoc($result)) {
                $tasting = new Tasting();
                $tasting->__initFromDbObject($row);
                array_push($tastings, $tasting);
            }
            return $tastings;
        } else {
            App::logError(mysqli_error($dbInstance) . "\r\n" . $sql);
        }
        return $res;
    }
}
