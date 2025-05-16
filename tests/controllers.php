<?php

require_once 'vendor/autoload.php';

require_once 'app/Controllers/RegistrationController.php';

use app\Controllers\RegistrationController;

function testAuthentificationUser(){
    $email = "test@test.com";
    $password = "14155552671";

    $result = RegistrationController::authenticateUser($email, $password);

    print_r($result);
}

testAuthentificationUser();