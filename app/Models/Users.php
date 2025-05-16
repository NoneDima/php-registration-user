<?php

namespace app\Models;
require_once __DIR__ . '/MySQL/PhoneNumbers.php';
require_once __DIR__ . '/MySQL/Users.php';
require_once __DIR__ . '/MySQL/Connection.php';

use app\Models\MySQl\Users as UsersMySQL;
use app\Models\MySQl\PhoneNumbers;
use app\Models\MySQl\Connection;

class Users {
    protected $columns = [
        "id",
        "FirstName", 
        "LastName", 
        "Email", 
        "Password", 
        "PhoneNumber"
    ];

    protected $usersModel;
    protected $phonesModel;

    public function __construct(){
        $this->usersModel = new UsersMySQL();
        $this->phonesModel = new PhoneNumbers();
    }

    public function updateById($id, $array){
        
    }

    public function insert($array){
        $user = $this->usersModel;
        $phone = $this->phonesModel;

        $id_phone = $phone->insert([
            "catalog_phone_id" => "1",
            "number" => $array['PhoneNumber'],
        ]);
        
        return $user->insertUser([
            "FirstName" => $array["FirstName"],
            "LastName" => $array["LastName"], 
            "Email" => $array["Email"],
            "Password" => $this->hashPassword($array["Password"]),
            "id_phone" => $id_phone
        ]);
    }

    private function hashPassword($password){
        return md5($password);
    }

    public function get($id){
        $t1 = $this->usersModel->tableName;
        $t2 = $this->phonesModel->tableName;

        $query = "SELECT $t1.id, $t1.FirstName, $t1.LastName, $t1.Email, $t1.Password, $t2.number FROM $t1 LEFT JOIN $t2 ON id_phone = $t2.id OR id_phone is NULL WHERE catalog_phone_id = 1 and $t1.id = $id;";
        
        return Connection::execute($query);
    }

    public function list(){
        $t1 = $this->usersModel->tableName;
        $t2 = $this->phonesModel->tableName;

        $query = "SELECT $t1.id, $t1.FirstName, $t1.LastName, $t1.Email, $t1.Password, $t2.number FROM $t1 LEFT JOIN $t2 ON id_phone = $t2.id OR id_phone is NULL WHERE catalog_phone_id = 1;";
        
        return Connection::execute($query);
    }

    public function consoleList(){
        foreach ($this->list() as $row) {
            foreach ($row as $column => $value) {
                printf("%-10s: %s\n", $column, $value);
            }
            echo "\n";
        }
    }
}