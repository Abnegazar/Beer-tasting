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



    public function viewProfile()
    {
        $this->breadCrumbs[dashboard] = PAGE_DASHBOARD;
        $this->breadCrumbs[account] = "";
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

    public function deleteAccount()
    {
        if (User::delete()) {
            Session::deleteConnectedUser();
            header("Location:" . PAGE_HOME);
        }
    }

    public function render()
    {
        $content = false;
        $operation = $_GET['operation'];
        switch ($operation) {
            case 'deleteAccount':
                $content = $this->deleteAccount();
                break;
            case 'viewProfile':
            default:
                $content = $this->viewProfile();
                break;
        }
        return $content;
    }
}