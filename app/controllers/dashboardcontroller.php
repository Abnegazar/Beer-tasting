<?php

class DashboardController extends BaseController implements Controller
{
    const viewDirectory = "dashboard/";

    public function __construct()
    {
        if (!Session::getConnectedUser()) {
            header("Location:" . PAGE_SIGNIN);
        }
    }

    public function render()
    {
        $content = false;
        $this->h1 = "dashboard";
        $this->description = "dashboard";
        $this->title = "TasteMyBeer - Dashboard";

        $view = "index.phtml";

        $lastUserTastings = Tasting::getUserTastings(Session::getConnectedUserId(), 0, 3);
        $lastTastings = Tasting::getAllTastings(0, 3);

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