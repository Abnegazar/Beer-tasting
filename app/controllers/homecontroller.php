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
        //$subject = "Bienvenue";
        //$message = "Votre compte utilisateur a été créé. Vous allez recevoir un email de confirmation. ";
        //MailSender::sendMail('kudux01@gmail.com', $message, $subject);
        //exit;
        $content = false;
        $this->h1 = "home";
        $this->description = "home";
        $this->title = "TasteMyBeer - Home";

        $view = "index.phtml";

        $content = App::get_content(
            self::viewDirectory . $view,
            array()
        );
        return $content;
    }
}