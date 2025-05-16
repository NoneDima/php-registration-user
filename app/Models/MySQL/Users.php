<?php

namespace app\Models\MySQL;
require_once 'Connection.php';

class Users {
    public $columns = [
        "id",
        "FirstName", 
        "LastName", 
        "Email", 
        "Password", 
        "id_phone"
    ];

    public $tableName = "Users";

    public function updateUserById($id, $array){
        $str_content = "";
        $i = 0;
        foreach($array as $column => $value){
            if(++$i == count($array)){
                $str_content .= "$column = $value";
            } else {
                $str_content .= "$column = $value, ";
            }
        }

        $query = "UPDATE {$this->tableName} SET $str_content WHERE id = $id;";

        return Connection::execute($query);
    }

    public function insertUser($array){
        $str_columns = "(";
        $str_values = "(";
        $i = 0;
        foreach($array as $column => $value){
            $str_columns .= $column;
            $str_values .= $value;

            if(++$i == count($array)){
                $str_columns .= ")";
                $str_values .= ")";
            } else {
                $str_columns .= ", ";
                $str_values .= ", ";
            }
        }

        $query = "INSERT INTO {$this->tableName} $str_columns VALUES $str_values;";

        Connection::execute($query);

        return Connection::lastInsertId();
    }

    public function getUser($id){
        $query = "SELECT * FROM {$this->tableName} where id = $id;";
        
        return Connection::execute($query);
    }

    public function listUsers(){
        $query = "SELECT * FROM {$this->tableName};";
        
        return Connection::execute($query);
    }

    public function consoleListUsers(){
        foreach ($this->listUsers() as $row) {
            foreach ($row as $column => $value) {
                printf("%-10s: %s\n", $column, $value);
            }
            echo "\n";
        }
    }
}