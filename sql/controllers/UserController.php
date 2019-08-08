<?php


class UserController extends Controller
{
    // dashboard pour le client
    // accessible en utilisant soit: monsite.fr/user ou monsitefr/user/index
    public function index()
    {

        $this->isConnected();
        require "views/user/index.php";


     }

    public function login()
    {
        $this->isConnected();

        $error = null;
        if (isset($_POST['valider'])) {
            $user = User::getUserByEmail($_POST['email']);
            if ($user == false) {
                $error = "L'adresse mail n'existe pas";
            } else {
                if (password_verify($_POST['password'], $user->getPassword())) {
                    // La partie de la session // Création d'une classe  qui permet de gérer la session
                    $session = new Session();
                    $session->onUserLogin($user);
                    $this->redirectTo("/user");
                    // header("Location: http://localhost:3000/index.php/product");
                } else {
                    $error = "Le mot de passe saisie est faut";
                }
            }
        }
        require 'views/user/login.php';
    }

    public function register()
    {

        $this->isConnected();

        $error = null;
        if (isset($_POST["valider"])) {
            $user = new User();
            $user->setFirstName($_POST["firstName"]);
            $user->setLastName($_POST["lastName"]);
            $user->setEmail($_POST["email"]);
            $user->setPassword($_POST['password']);
            $user->setAdmin(0);
            if ($user->isValid()) {
                $user->save();
                // header("Location: http://localhost:3000/index.php/product");
                $this->redirectTo("/user");
            } else {
                $error = "Les données saisies sont invalides";
            }
        }

        require "views/user/register.php";
    }




    public function logout()
    {
        $session = new Session();
        $session->destroy();
        $this->redirectTo("/user/login");
    }

    
    public function profile()
    {
        $this->isConnected();
        $session = new Session();
        $user = User::getUserById($session->getLoggedUserId());
        require "views/user/profile.php";
    }



    public static function getOrderByUserId($id)
    {
        $cnx = new Connexion();
        $order = $cnx->getOne(
            "SELECT * FROM order WHERE user_id = ?",
            [$id],
            "Order"
        );

        return $order;
    }


}



