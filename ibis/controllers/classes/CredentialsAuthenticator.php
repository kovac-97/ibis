<?php

require_once('../controllers/interfaces/Authenticator.php');
require_once('../controllers/DatabaseController.php');
require_once('../models/User.php');
class CredentialsAuthenticator implements Authenticator
{
    protected User $user;

    function __construct()
    {
        //dummy user
        $this->user = new User('', '', false);
    }

    public function authenticate()
    {
        if (!isset($_POST['email']) || !isset($_POST['email'])) {
            return false;
        }

        //izvlačimo korisnika iz baze pomoću STMT Querya
        $DB = new DatabaseController('localhost', 'root', '', 'ibis');
        $email = $_POST['email'];
        $queryResult = $DB->STMTQuery("SELECT `salt` FROM `USERS` WHERE `E-mail`= ?", 's', [$email]);
        if ($queryResult->num_rows == 1) {
            $data = $queryResult->fetch_assoc();
            $salt = $data['salt'];
        } else {
            return false;
        }
        $passwordHash = hash('sha256', $salt . $_POST['password']);
        $queryResult = $DB->STMTQuery("SELECT `Ime`, `Prezime` FROM `USERS` WHERE `E-mail`= ? AND `Password Hash`='$passwordHash'", 's', [$email]);


        if ($queryResult->num_rows == 1) {
            $data = $queryResult->fetch_assoc();
            $this->user = new User($data['Ime'], $data['Prezime'], true);
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
