<?php

class ProfileController extends BaseController implements Controller
{
    const viewDirectory = "profile/";

    public function __construct()
    {
        if (!Session::getConnectedUser()) {
            header("Location:" . PAGE_SIGNIN);
        }
    }

    public function render()
    {
        $content = false;
        $this->h1 = "My account";
        $this->description = "My account";
        $this->title = "My account | TasteMyBeer";

        $view = "index.phtml";

        $content = App::get_content(
            self::viewDirectory . $view,
            array()
        );
        return $content;
    }
}