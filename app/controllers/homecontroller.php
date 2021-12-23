<?php

class HomeController extends BaseController implements Controller
{
    const viewDirectory = "home/";

    public function __construct()
    {
        if (Session::getConnectedUser()) {
            header("Location:" . PAGE_DASHBOARD);
        }
    }

    public function render()
    {
        $this->breadCrumbs[""] = PAGE_HOME;
        $content = false;
        $this->h1 = "Home";
        $this->description = "Home";
        $this->title = "Home | TasteMyBeer";

        $view = "index.phtml";

        $content = App::get_content(
            self::viewDirectory . $view,
            array()
        );
        return $content;
    }
}