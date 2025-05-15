<?php

require_once 'vendor/autoload.php';

require 'app/Models/Users.php';

function testListUsers(){
    (new Users())->consoleListUsers();
}

function testGetUser(){
    print_r((new Users())->getUser(1)->fetch_array());
}

function testInsertUser(){
    $user = new \app\Models\Users();
    $user->insertUser([
        "FirstName" => "'test'",
        "LastName" => "'test'", 
        "Email" => "'Test@gmail.com'", 
        "Password" => "\"Don\'t protected password\"",
        "id_phone" => 1
    ]);
    $user->consoleListUsers();
}

function testUpdateUser(){
    $user = new \app\Models\Users();
    $user->updateUserById(1, [
        "FirstName" => "'test1'",
        "LastName" => "'test1'", 
        "Email" => "'Test1@gmail.com'", 
        "Password" => "\"Don\'t protected password\"",
        "id_phone" => 1
    ]);
    $user->consoleListUsers();
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

testMakeDatabase();