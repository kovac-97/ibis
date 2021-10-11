<?php

require_once('../controllers/SignupController.php');


if (
    isset($_POST['firstName']) &&
    isset($_POST['secondName']) &&
    isset($_POST['email']) &&
    isset($_POST['password'])
) {
    $signupController = new SignupController();
    $data = [$_POST['firstName'], $_POST['secondName'], 
             $_POST['email'], hash('sha256', $_POST['password'])];


    if ($signupController->CreateUser($data)) {
        echo "<p class='valid'> Thank you for Signing Up! You can Log In now.</p>";
    } else {
        echo "<p class='invalid'>That E-mail is already taken. Please try again</p>";
    }
}
