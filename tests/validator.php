<?php

require_once 'vendor/autoload.php';

require_once 'app/Models/Validator.php';

function testTrueValidateUser($user){
    $validators = [
        "FirstName" => (new app\Models\Validator())->required()->length(1, 50),
        "LastName" => (new app\Models\Validator())->required()->length(1, 50),
        "Email" => (new app\Models\Validator())->required()->email(),
        "Password" => (new app\Models\Validator())->required()->length(8),
        "PhoneNumber" => (new app\Models\Validator())->required()->phone(),
    ];

    return !is_array(app\Models\Validator::validateSchema($validators, $user)) ? "Right" : "False";
}

function testFalseValidateUser($user){
    $validators = [
        "FirstName" => (new app\Models\Validator())->required()->length(1, 50),
        "LastName" => (new app\Models\Validator())->required()->length(1, 50),
        "Email" => (new app\Models\Validator())->required()->email(),
        "Password" => (new app\Models\Validator())->required()->length(8),
        "PhoneNumber" => (new app\Models\Validator())->required()->phone(),
    ];

    return is_array(app\Models\Validator::validateSchema($validators, $user)) ? "Right" : "False";
}

$dataTrue = [
    [
        "FirstName" => "'test'",
        "LastName" => "'test'", 
        "Email" => "'Test@gmail.com'", 
        "Password" => "\"Don\'t protected password\"",
        "PhoneNumber" => "+14155552671"
    ],
];

$dataFalse = [
    [
        "FirstName" => "'test'",
        "LastName" => "'test'", 
        "Email" => "'@gmail.com'", 
        "Password" => "\"Don\'t protected password\"",
        "PhoneNumber" => "1"
    ],
];

echo testTrueValidateUser($dataTrue[0]) . "\n";
echo testFalseValidateUser($dataFalse[0]) . "\n";