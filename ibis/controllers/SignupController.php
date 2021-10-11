<?php
require_once('../controllers/DatabaseController.php');

class SignupController
{
    public function CreateUser($data)
    {
        //pošto je email u bazi UNIQUE neće doći do unosa
        //ukoliko se korisnik pokuša registrovati sa postojećom
        //email adresom
        $DB = new DatabaseController('localhost', 'root', '', 'ibis');
        $query = "INSERT INTO `users` (`Ime`, `Prezime`, `E-mail`, `Password Hash`) VALUES (?, ?, ?, ?)";
        return $DB->STMTQuery($query, 'ssss', $data);
    }
}
