<?php

class Beer
{

    const ID = "id_beer";
    const STYLE = "style";
    const BEERAROMA = "beer_aroma";
    const BEERAPPEARANCE = "beer_appearance";
    const BEERFLAVOR = "beer_flavor";
    const COMMENTS = "comments";
    const CORPS =  "corps";
    const INGREDIENTS = "ingredients";
    const STYLECOMPARISON = "style_comparison";
    const COMMERCIALEXAMPLE = "commercial_example";

    private $idBeer;
    private $style;
    private $beerAroma;
    private $beerAppearance;
    private $beerFlavor;
    private $comments;
    private $corps;
    private $ingredients;
    private $styleComparison;
    private $commercialExemple;
    private $createdAt;
    private $updateAt;

    public function __construct()
    {
        $this->id = false;
        $this->style = false;
        $this->beerAroma = false;
        $this->beerAppearance = false;
        $this->beerFlavor = false;
        $this->comments = false;
        $this->corps = false;
        $this->ingredients = false;
        $this->styleComparison = false;
        $this->commercialExample = false;
        $this->createdAt = false;
        $this->updateAt = false;
    }

    public function initValue(
        $id = false,
        $style,
        $beerAroma,
        $beerAppearance,
        $beerFlavor,
        $comments,
        $corps,
        $ingredients,
        $styleComparison,
        $commercialExemple
    ) {
        $this->idBeer = ($id) ? $id : false;
        $this->style = $style;
        $this->beerAroma = $beerAroma;
        $this->beerAppearance = $beerAppearance;
        $this->beerFlavor = $beerFlavor;
        $this->comments = $comments;
        $this->corps = $corps;
        $this->ingredients = $ingredients;
        $this->styleComparison = $styleComparison;
        $this->commercialExemple = $commercialExemple;
    }

    public function __initFromDbObject($o)
    {
        $this->idBeer = $o[Beer::ID];
        $this->style = $o[Beer::STYLE];
        $this->beerAroma = $o[Beer::BEERAROMA];
        $this->beerAppearance = $o[Beer::BEERAPPEARANCE];
        $this->beerFlavor = $o[Beer::BEERFLAVOR];
        $this->comments = $o[Beer::COMMENTS];
        $this->ingredients = $o[Beer::INGREDIENTS];
        $this->styleComparison = $o[Beer::STYLECOMPARISON];
        $this->commercialExemple = $o[Beer::COMMERCIALEXAMPLE];
    }

    public static function getBeerById($id = false)
    {
        $res = false;
        $dbInstance = Db::getInstance()->getDbInstance();
        $sql = 'SELECT * FROM beer WHERE id_beer = ' . (int)$id . '';
        $result = mysqli_query($dbInstance, $sql);

        if ($result) {
            $beer = new Beer();
            while ($row = mysqli_fetch_assoc($result)) {
                $beer->__initFromDbObject($row);
            }
            return $beer;
        } else {
            App::logError(mysqli_error($dbInstance) . "\r\n" . $sql);
        }
        return $res;
    }


    public static function getAllBeers()
    {
        $res = false;
        $dbInstance = Db::getInstance()->getDbInstance();
        $sql = 'SELECT * FROM beer ORDER BY created_at DESC';
        $result = mysqli_query($dbInstance, $sql);

        if ($result) {
            $beer = new Beer();
            while ($row = mysqli_fetch_assoc($result)) {
                $beer->__initFromDbObject($row);
            }
            return $beer;
        } else {
            App::logError(mysqli_error($dbInstance) . "\r\n" . $sql);
        }
        return $res;
    }
}