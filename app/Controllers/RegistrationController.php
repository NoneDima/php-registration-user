<?php 

namespace app\Controllers;

require 'app/Models/Users.php';

use app\Models\Users;

class RegistrationController {
    public static function showRegistrationForm(){
        return require "app/Views/Registration/edit.php";
    }

    public static function showLoginForm(){
        return require "app/Views/Registration/index.php";
    }

    public static function registerUser($fullname, $lastname, $email, $password, $phone){
        $user = new Users();

        $values = self::parseRegistration($fullname, $lastname, $email, $password, $phone);

        $result = $user->insert($values);

        return $result;
    }

    public static function authenticateUser(){
        $user = new Users();
        $email = $_POST["email"];
        $password = $_POST["password"];

        $values = self::parseLogin($fullname, $lastname, $email, $password, $phone);

        $result = $user->get($values);

        return $result;
    }

    private static function parseLogin($email, $password){
        return [
            "Email" => $email,
            "Password" => $password
        ];
    }

    private static function parseRegistration($fullname, $lastname, $email, $password, $phone){
        return [
            "FirstName" => $fullname,
            "LastName" => $lastname,
            "Email" => $email,
            "Password" => $password,
            "PhoneNumber" => $phone
        ];
    }
}
