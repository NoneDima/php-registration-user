<?php

require_once 'vendor/autoload.php';

require_once 'app/Models/Users.php';
require_once 'app/Models/MySQL/Users.php';
require_once 'app/Models/MySQL/PhoneNumbers.php';

function testListUsersModel(){
    (new \app\Models\MySQL\Users())->consoleListUsers();
}

function testGetUserModel(){
    print_r((new \app\Models\MySQL\Users())->getUser(1)->fetch_array());
}

function testInsertUserModel(){
    $user = new \app\Models\MySQL\Users();
    $user->insertUser([
        "FirstName" => "'test'",
        "LastName" => "'test'", 
        "Email" => "'Test@gmail.com'", 
        "Password" => "\"Don\'t protected password\"",
        "id_phone" => "NULL"
    ]);
    $user->consoleListUsers();
}

function testUpdateUserModel(){
    $user = new \app\Models\MySQL\Users();
    $user->updateById(1, [
        "FirstName" => "'test1'",
        "LastName" => "'test1'", 
        "Email" => "'Test1@gmail.com'", 
        "Password" => "\"Don\'t protected password\"",
        "id_phone" => "NULL"
    ]);
    $user->consoleListUsers();
}

function testInsertPhoneModel(){
    $phone = new \app\Models\MySQL\PhoneNumbers();
    $phone->insert([
        "catalog_phone_id" => "1",
        "number" => "12345",
    ]);
    $phone->consoleList();
}

function testUpdatePhoneModel(){
    $phone = new \app\Models\MySQL\PhoneNumbers();
    $phone->updateById(1, [
        "catalog_phone_id" => "1",
        "number" => "56789",
    ]);
    $phone->consoleList();
}

function testMakeDatabase(){
    $dotenv = \Dotenv\Dotenv::createImmutable(".");
    $dotenv->load();

    $servername = "mysql:" . $_ENV['FORWARD_DB_PORT'];

    $username = 'root';
    $password = $_ENV['DB_PASSWORD'];

    $_conn = mysqli_connect($servername, $username, $password);

    ob_start();
    $current_user = $_ENV['DB_USERNAME'];
    require 'migration/2-make-user-phone-catalog.sql';
    $query = ob_get_clean();

    print_r(mysqli_multi_query($_conn, $query));
}

function testInsertPhone(){
    $dotenv = \Dotenv\Dotenv::createImmutable(".");
    $dotenv->load();

    $servername = "mysql:" . $_ENV['FORWARD_DB_PORT'];

    $username = 'root';
    $password = $_ENV['DB_PASSWORD'];

    $_conn = mysqli_connect($servername, $username, $password, 'testforeign');
    
    $query = "INSERT PhoneNumbers(catalog_phone_id, number) VALUES (1, '123122');";

    mysqli_execute_query($_conn, $query);

    echo "Last insert id: " . mysqli_insert_id($_conn);

    echo "\n";
}

function testListUsersForeign(){
    (new \app\Models\Users())->consoleList();
}

function testGetUserForeign(){
    print_r((new \app\Models\Users())->get(1)->fetch_array());
}

testGetUserForeign();