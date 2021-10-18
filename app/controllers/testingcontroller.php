<?php

class TestingController extends BaseController implements Controller
{
    const viewDirectory = "testing/";

    public function __construct()
    {
        if (Session::getConnectedUser()) {
            header("Location:" . PAGE_DASHBOARD);
        }
    }

    public function render()
    {
        $content = false;
        $this->h1 = "test";
        $this->description = "test";
        $this->title = "test";

        $view = "test.php";

        $content = App::get_content(
            self::viewDirectory . $view,
            array()
        );
        return $content;
    }
}
