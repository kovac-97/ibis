<?php

require_once('../controllers/LoginController.php');
require_once('../controllers/classes/CookieAuthenticator.php');

//samo određuje da li će se u headeru prikazati Sign Up ili Log Out dugme
class Header
{
    public string $button;

    function __construct()
    {

        $loginController = new LoginController(new CookieAuthenticator());

        if ($loginController->authenticate()) {
            $this->button = "<a onclick='logOut()' class='logOut' href='#'>Log Out</a>";
        } else {
            $this->button = "<a onclick='openModal(0)' class='signUp' href='#'>Sing Up</a>";
        }
    }
}
