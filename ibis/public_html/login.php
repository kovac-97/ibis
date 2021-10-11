<?php

session_start();
require_once('../controllers/LoginController.php');
require_once('../controllers/classes/CredentialsAuthenticator.php');
require_once('../models/User.php');


  $loginController = new LoginController(new CredentialsAuthenticator());

  
  if ($loginController->authenticate()) {
    setcookie('token', session_id());
    $_SESSION['token']=session_id();
  }

  $user=$loginController->getUser();

  
  if($user->isValid){
    $_SESSION[session_id()]=serialize($user); //zapamtimo koji je user logovan
    echo "<p class='valid'> Welcome $user->firstName $user->secondName</p>";
  }else{
    echo "<p class='invalid'>Please try again</p>";
  }


?>
