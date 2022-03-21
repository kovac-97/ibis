<?php
require_once('../controllers/DatabaseController.php');

class SignupController
{
    public function CreateUser()
    {

        if (
            isset($_POST['firstName']) &&
            isset($_POST['secondName']) &&
            isset($_POST['email']) &&
            isset($_POST['password'])
        ) {
            $signupController = new SignupController();
            $salt = base64_encode(random_bytes(20));
            $hash = hash("sha256", $salt . $_POST['password']);
            $data = [
                $_POST['firstName'], $_POST['secondName'],
                $_POST['email'], $hash, $salt
            ];

            //pošto je email u bazi UNIQUE neće doći do unosa
            //ukoliko se korisnik pokuša registrovati sa postojećom
            //email adresom
            $DB = new DatabaseController('localhost', 'root', '', 'ibis');
            $query = "INSERT INTO `users` (`Ime`, `Prezime`, `E-mail`, `Password Hash`, `salt`) VALUES (?, ?, ?, ?, ?)";
            return $DB->STMTQuery($query, 'sssss', $data);
        } else {
            return false;
        }
    }
}
