<?php

require_once('../controllers/SignupController.php');

$signupController = new SignupController();
if ($signupController->CreateUser()) {
    echo "<p class='valid'> Thank you for Signing Up! You can Log In now.</p>";
} else {
    echo "<p class='invalid'>That E-mail is already taken. Please try again</p>";
}
