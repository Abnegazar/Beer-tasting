<?php

class degustController extends BaseController implements Controller
{
    const viewDirectory = "beer-test/";

    public function __construct()
    {
        /*if (Session::getConnectedUser()) {
            header("Location:" . PAGE_DASHBOARD);
        }*/
    }

    public function render()
    {
        $content = false;
        $this->h1 = "degustation test";
        $this->description = "Show particular degustation";
        $this->title = "degustation_show";

        $view = "show.php";

        $content = App::get_content(
            self::viewDirectory . $view,
            array()
        );
        return $content;
    }
}
