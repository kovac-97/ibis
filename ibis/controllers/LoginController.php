<?php
require_once('../controllers/interfaces/Authenticator.php');
class LoginController {
    protected Authenticator $auth;

    function __construct(Authenticator $auth){
        $this->auth=$auth;
    }

    public function authenticate(){
        return $this->auth->authenticate();
    }

    public function getUser(){
        return $this->auth->getAuthenticatedUser();
    }
}


?>