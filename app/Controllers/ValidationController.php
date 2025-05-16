<?php 

namespace app\Controllers;

require_once 'app/Models/Validator.php';

class ValidationController {
    public static function validateRegisterUser($fullname, $lastname, $email, $password, $phone){
        $schema = [
            "FirstName" => (new \app\Models\Validator())->required()->length(1, 50),
            "LastName" => (new \app\Models\Validator())->required()->length(1, 50),
            "Email" => (new \app\Models\Validator())->required()->email(),
            "Password" => (new \app\Models\Validator())->required()->length(8),
            "PhoneNumber" => (new \app\Models\Validator())->required()->phone(),
        ];

        $user = [
            "FirstName" => $fullname,
            "LastName" => $lastname,
            "Email" => $email,
            "Password" => $password,
            "PhoneNumber" => $phone,
        ];

        return \app\Models\Validator::validateSchema($schema, $user);
    }

    public static function validateAuthUser($email, $password){
        $schema = [
            "Email" => (new \app\Models\Validator())->required()->email(),
            "Password" => (new \app\Models\Validator())->required()->length(8),
        ];

        $user = [
            "Email" => $email,
            "Password" => $password,
        ];

        return \app\Models\Validator::validateSchema($schema, $user);
    }
}
