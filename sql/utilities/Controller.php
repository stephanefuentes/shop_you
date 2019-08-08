<?php


class Controller
{


    public function isConnected()
    {
        $session = new Session();
        if ($session->isLogged()) {

            if ($session->isAdmin()) {
                $this->redirectTo("/admin");
            } else {
                $this->redirectTo("/user");
            }
        }
    }


    public function isAdminConnected()
    {
        $session = new Session();
        if ($session->isLogged()) {

            if (!$session->isAdmin()) {
                $this->redirectTo("/");
            }
        }
    }
    

    public function redirectTo($url)
    {
        header("Location: http://" . $_SERVER['HTTP_HOST'] . $_SERVER['SCRIPT_NAME'] . $url);
    }
}
