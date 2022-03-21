<?php


require_once('../controllers/interfaces/Authenticator.php');
require_once('../models/User.php');
class CookieAuthenticator implements Authenticator
{

    protected User $user;

    function __construct()
    {
        //koristimo dummy korisnika koji nije autentifikovan
        $this->user = new User('', '', false);
    }

    public function authenticate()
    {
        if(!isset($_SESSION)){
            session_start();
        }
        //autentifikacija pomoću cookie-a
        if (isset($_SESSION['token']) && isset($_COOKIE['token']) && $_SESSION['token'] === $_COOKIE['token']) {
            $this->user = unserialize($_SESSION['user']);
            return true;
        } else {
            return false;
        }
    }

    public function getAuthenticatedUser()
    {
        return $this->user;
    }
}
