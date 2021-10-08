<?php

class LoginController extends BaseController implements Controller
{

    const viewDirectory = 'login/';

    public function signIn()
    {
        $view = 'signin.phtml';
        $errors = [];
        if (!empty($_POST)) {
            $email = $_POST['email'];
            $password = $_POST['password'];
            if (!isset($email) or empty(trim($email))) {
                $errors[] = 'L\'email est obligatoire.';
            } else if (!filter_var(trim($email), FILTER_VALIDATE_EMAIL)) {
                $errors[] = 'L\'email saisi n\'est pas correct.';
            }
            if (!isset($password) or empty(trim($password))) {
                $errors[] = 'Le mot de passe est obligatoire.';
            }
            if (empty($errors)) {
                $user = false;
                $email = trim($_POST['email']);
                $password = trim($_POST['password']);
                $user = User::logIn($email, $password);
                if ($user) {
                    Session::setConnectedUser($user);
                    var_dump(Session::getConnectedUser());
                    exit;
                    header("Location:" . PAGE_DASHBOARD);
                } else {
                    $errors[] = "Les identifiants fournis sont incorrects.";
                }
            }
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
        $view = 'signup.phtml';
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