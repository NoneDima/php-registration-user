<?php 

namespace app\Controllers;

require 'app/Models/Users.php';

class RegistrationController {
    public static function view(){
        return require "app/Views/Registration/index.php";
    }

    public static function edit(){
        $user = new \app\Models\Users();
        $fullname = $_POST["firstname"];
        $lastname = $_POST["lastname"];
        $email = $_POST["email"];
        $phone = $_POST["phone"];
        $password = $_POST["password"];

        $values = self::parse($fullname, $lastname, $email, $phone, $password);

        $result = $user->insertUser($values);

        return $result;
    }

    private static function parse($fullname, $lastname, $email, $phone, $password){
        return [
            "FirstName" => "'$fullname'",
            "LastName" => "'$lastname'",
            "Email" => "'$email'",
            "Password" => "'$password'",
            "id_phone" => $phone
        ];
    }
}
