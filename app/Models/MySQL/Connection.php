<?php

namespace app\Models\MySQl;

class Connection {
    private $_conn;
    private static $connection;

    private function __construct(){
        $this->loadEnv();
        $this->connect();
    }

    public static function getConnection(){
        if(self::$connection){
            return self::$connection;
        } else {
            return self::$connection = new Connection();
        }
    }

    private function loadEnv(){
        $dotenv = \Dotenv\Dotenv::createImmutable(".");
        $dotenv->load();
    }

    private function connect(){
        $servername = "mysql:" . $_ENV['FORWARD_DB_PORT'];

        $username = $_ENV['DB_USERNAME'];
        $password = $_ENV['DB_USER_PASSWORD'];
        $database = $_ENV['DB_DATABASE'];

        $this->_conn = mysqli_connect($servername, $username, $password, $database);
    }

    public static function execute($query, $params = []){
        $connection = self::getConnection();

        return mysqli_execute_query($connection->_conn, $query, $params);
    }

    public static function execute_multi($query, $params = []){
        $connection = self::getConnection();

        return mysqli_multi_query($connection->_conn, $query, $params);
    }

    public static function lastInsertId(){
        if(self::$connection){
            return mysqli_insert_id(self::$connection->_conn);
        }

        return false;
    }
}