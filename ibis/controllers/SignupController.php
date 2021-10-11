<?php
require_once('../controllers/DatabaseController.php');

class SignupController {

    public function CreateUser($data){
    
        $DB=new DatabaseController('localhost','root','','ibis');
        $query="INSERT INTO `users` (`Ime`, `Prezime`, `E-mail`, `Password Hash`) VALUES (?, ?, ?, ?)";       
       

        return $DB->STMTQuery($query, 'ssss', $data);

    
    }
   
}


?>