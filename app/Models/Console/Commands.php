<?php

class Commands{
    public static function initDatabase(){
        $dotenv = \Dotenv\Dotenv::createImmutable(".");
        $dotenv->load();
    
        $servername = "mysql:" . $_ENV['FORWARD_DB_PORT'];
    
        $username = 'root';
        $password = $_ENV['DB_PASSWORD'];
    
        $_conn = mysqli_connect($servername, $username, $password);
    
        ob_start();
        $current_user = $_ENV['DB_USERNAME'];
        $database = $_ENV['DB_DATABASE'];
        require 'migration/2-make-user-phone-catalog.sql';
        $query = ob_get_clean();
    
        mysqli_multi_query($_conn, $query);
    }
}