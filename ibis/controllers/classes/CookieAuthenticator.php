<?php


require_once('../controllers/interfaces/Authenticator.php');
require_once('../controllers/DatabaseController.php');
require_once('../models/User.php');
class CookieAuthenticator implements Authenticator {

    protected User $user;

    function __construct() {
        $this->user=new User('','',false); //dummy user
    }

    public function authenticate(){   
        if(isset($_SESSION['token']) && isset($_COOKIE['token']) && $_SESSION['token']===$_COOKIE['token']){              
            $this->user=unserialize($_SESSION[session_id()]);
            return true;
        }else{
            return false;
        }
    }

    public function getAuthenticatedUser()
    {
        return $this->user;
    }

}
?>
