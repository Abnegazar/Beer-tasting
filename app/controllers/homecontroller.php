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
        $content = false;
        $this->h1 = "home";
        $this->description = "home";
        $this->title = "TasteMyBeer - Home";

        $view = "landing.phtml";

        $content = App::get_content(
            self::viewDirectory . $view,
            array()
        );
        return $content;
    }
}