<?php
class BeerController extends BaseController implements Controller
{
    const viewDirectory = 'beers/';

    public function getSomeBeer($limit)
    {
        $view = "beer.phtml";
        $beers = Beer::getSomeBeers($limit);

        return App::get_content(
            self::viewDirectory . $view,
            array('beers' => $beers)
        );
    }

    public function getAllBeers()
    {
        $view = "beer.phtml";
        $beers = Beer::getAllBeers();

        return App::get_content(
            self::viewDirectory . $view,
            array('beers' => $beers)
        );
    }

    public function getBeerById($id)
    {
        $view = "beer.phtml";
        $beers = Beer::getBeerById($id);

        return App::get_content(
            self::viewDirectory . $view,
            array('beers' => $beers)
        );
    }

    /**
     * @return false|string
     */
    public function render()
    {
        $content = false;
        $operation = $_GET['operation'];
        switch ($operation) {
            case 'getAll':
                $content = $this->getAllBeers();
                break;
            case 'getOne':
                $content = $this->getBeerById($id);
                break;
            default:
                break;
        }
        return $content;
    }
}
