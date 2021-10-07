<?php

class LoginController extends BaseController implements Controller
{

    const viewDirectory = '/login';

    public function signIn()
    {
        $view = 'signIn.phtml';
        $errors = [];
        if (!empty($_POST)) {
        }
        $content = App::get_content(
            self::viewDirectory . $view,
            array(
                'errors'             => $errors
            )
        );
        return $content;
    }

    public function signUp()
    {
    }

    public function logOut()
    {
    }

    public function render()
    {
        $content = false;
        $operation = $_GET['operation'];
        switch ($operation) {
            case 'signUp':
                $content = $this->signUp();
                break;
            case 'logOut':
                $content = $this->logOut();
                break;
            case 'signIn':
            default:
                $content = $this->signIn();
                break;
        }
        return $content;
    }
}