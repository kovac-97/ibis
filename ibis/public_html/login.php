<?php
require_once('../controllers/LoginController.php');
require_once('../controllers/classes/CredentialsAuthenticator.php');
require_once('../models/User.php');
$loginController = new LoginController(new CredentialsAuthenticator());
if ($loginController->authenticate()) {
  $loginController->generateCookie();
  $user = $loginController->getUser();
  echo "<p class='valid'> Welcome $user->firstName $user->secondName</p>";
} else {
  echo "<p class='invalid'>Please try again</p>";
}
