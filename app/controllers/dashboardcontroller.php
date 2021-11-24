<?php

class DashboardController extends BaseController implements Controller
{
    const viewDirectory = "beer-test/";

    public function __construct()
    {
       /* if (!Session::getConnectedUser()) {
            header("Location:" . PAGE_SIGNIN);
        }*/
    }

    public function render()
    {
        $content = false;
        $this->h1 = "dashboard";
        $this->description = "dashboard";
        $this->title = "TasteMyBeer - Dashboard";

        $view = "show.phtml";

        $lastUserTastings = ["hey" => 56];
        $lastTastings = [];

        $content = App::get_content(
            self::viewDirectory . $view,
            array(
                "lastUserTastings" => $lastUserTastings,
                "lastTastings"     => $lastTastings
            )
        );
        return $content;
    }
}