<?php

class TastingController extends BaseController implements Controller
{
    const viewDirectory = 'tasting/';

    public function __construct()
    {
        if ((isset($_GET['mode']))) {
            if (($_GET['mode'] != "visitor")) {
                header("Location:" . PAGE_SIGNIN);
            }
        } else if (!Session::getConnectedUser()) {
            header("Location:" . PAGE_SIGNIN);
        }
    }

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
            case 'getUserTastings':
                $content = $this->getUserTastings($_GET['userId']);
                break;
            case 'getAllTastings':
            default:
                $content = $this->getAllTastings();
        }
        return $content;
    }
}