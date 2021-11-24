<?php

class TastingController extends BaseController implements Controller
{

    const viewDirectory = 'tastings/';

    public function getAllTastings()
    {

        $view = "tastings.phtml";

        $limit = DEFAULT_PAGINATION;

        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

        $offset = ($page - 1) * $limit;

        $tastings = Tasting::getAllTastings($offset, $limit);

        $content = App::get_content(
            self::viewDirectory . $view,
            array(
                'tastings' => $tastings
            )
        );
        return $content;
    }


    public function getUserTastings($userId)
    {
        $view = "tastings.phtml";

        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

        $limit = DEFAULT_PAGINATION;

        $offset = ($page - 1) * $limit;

        $tastings = Tasting::getUserTastings($userId, $offset, $limit);

        $content = App::get_content(
            self::viewDirectory . $view,
            array('tastings' => $tastings)
        );
        return $content;
    }

    //TODO METHOD getTastingById

    //TODO METHOD FOR SAVING A NEW USER TASTINGS

    public function render()
    {
        $content = false;
        $operation = $_GET['operation'];
        switch ($operation) {
            case 'getAllTastings':
                $content = $this->getAllTastings();
                break;
            case 'getUserTastings':
                $content = $this->getUserTastings($_GET['userId']);
                break;
            default:
                break;
        }
        return $content;
    }
}