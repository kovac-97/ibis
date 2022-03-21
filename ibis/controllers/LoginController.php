<?php
require_once('../controllers/interfaces/Authenticator.php');
class LoginController
{
    protected Authenticator $auth;

    function __construct(Authenticator $auth)
    {
        $this->auth = $auth;
    }

    public function authenticate()
    {
        return $this->auth->authenticate();
    }

    public function getUser()
    {
        return $this->auth->getAuthenticatedUser();
    }

    public function generateCookie()
    {
        if (!isset($_SESSION)) {
            session_start();
        }
        $token = base64_encode(random_bytes(20));
        setcookie('token', $token);
        $_SESSION['token'] = $token;
        $_SESSION['user'] = serialize($this->getUser());
    }
}
