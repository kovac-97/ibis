<?php
session_start();
require_once('../controllers/LoginController.php');
require_once('../controllers/classes/CookieAuthenticator.php');

//izvršimo provjeru da li je korisnik već logovan
//ako nije proslijedimo mu view za logovanje
$loginController = new LoginController(new CookieAuthenticator());
if ($loginController->authenticate()) {
  include '../views/MainView.php';
} else {
  include '../views/LoginView.php';
}
