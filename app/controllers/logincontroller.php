<?php

class LoginController extends BaseController implements Controller
{

    const viewDirectory = 'login/';

    public function __construct()
    {
        if (Session::getConnectedUser()) {
            header('Location:' . PAGE_DASHBOARD);
        }
    }

    public function signIn()
    {
        $view = 'signin.phtml';
        $errors = [];
        if (!empty($_POST)) {

            //email validation
            if (!isset($_POST['email']) or empty(trim($_POST['email']))) {
                $errors[] = 'L\'email est obligatoire.';
            } else if (!filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL)) {
                $errors[] = 'L\'email saisi n\'est pas correct.';
            }

            //password validation
            if (!isset($_POST['password']) or empty(trim($_POST['password']))) {
                $errors[] = 'Le mot de passe est obligatoire.';
            }

            if (empty($errors)) {
                $email = $_POST['email'];
                $password = $_POST['password'];
                $user = false;
                $email = trim($_POST['email']);
                $password = trim($_POST['password']);

                //check if user exists
                $user = User::logIn($email, $password);
                if ($user) {
                    //if the user exists, create the session variable and do the redirection
                    Session::setConnectedUser($user);
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
        $success = false;
        if (!empty($_POST)) {
            //name validation
            if (!isset($_POST['firstName'])) {
                $errors[] = 'Le prénom est obligatoire. ';
            } else if (!preg_match(PATTERN_NAME, $_POST['firstName'])) {
                $errors[] = PATTERN_NAME_EXPL;
            }

            if (!isset($_POST['lastName'])) {
                $errors[] = 'Le nom est obligatoire. ';
            } else if (!preg_match(PATTERN_NAME, $_POST['name'])) {
                $errors[] = PATTERN_NAME_EXPL;
            }

            //email validation
            if (!isset($_POST['email']) || empty($_POST['email'])) {
                $errors[] = 'L\'email est obligatoire. ';
            } else if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                $errors[] = 'L\'email saisi n\'est pas correct. ';
            }

            //password validation
            if (!isset($_POST['password']) || empty(($_POST['password']))) {
                $errors[] = "Le mot de passe est obligatoire";
            } else if (!preg_match(PATTERN_PASSWORD, $_POST['password'])) {
                $errors[] = "Le mot de passe n'est pas correct";
            }

            if (empty($errors)) {
                $email = $_POST['email'];
                //check if user already exists
                if (!User::isUserExists($email)) {
                    //if not saving the user in the database
                    $firstName = $_POST['firstName'];
                    $lastName = $_POST['firstName'];
                    $password = $_POST['password'];
                    $user = new User();
                    $user->initValue(false, $firstName, $lastName, $email, $password);
                    if ($user->save()) {
                        $success = "Votre compte utilisateur a été créé. Vous allez recevoir un email de confirmation. ";
                    } else {
                        $errors[] = "Une erreur s'est produite lors de la création du compte";
                    }
                } else {
                    $errors[] = 'Cet email est déjà associé à un compte. Vous pouvez utiliser la fonction "mot de passe oublié".';
                }
            }
        }
        $content = App::get_content(
            self::viewDirectory . $view,
            array(
                'errors'             => $errors,
                'success'            => $success
            )
        );
        return $content;
    }

    public function logOut()
    {
        Session::deleteConnectedUser();
        header('location:' . PAGE_HOME);
        die();
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
