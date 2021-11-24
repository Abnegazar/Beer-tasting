<?php
class BeerController extends BaseController implements Controller
{
    const viewDirectory = 'beers/';

    public function getSomeBeer($limit)
    {
        $view = "beer.phtml";
        $beers = Beer::getSomeBeers($limit);

        $content = App::get_content(
            self::viewDirectory . $view,
            array('beers' => $beers)
        );
        return $content;
    }

    public function getAllBeers()
    {
        $view = "beer.phtml";
        $beers = Beer::getAllBeers();

        $content = App::get_content(
            self::viewDirectory . $view,
            array('beers' => $beers)
        );
        return $content;
    }

    public function getBeerById($id)
    {
        $view = "beer.phtml";
        $beers = Beer::getBeerById($id);

        $content = App::get_content(
            self::viewDirectory . $view,
            array('beers' => $beers)
        );
        return $content;
    }

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
