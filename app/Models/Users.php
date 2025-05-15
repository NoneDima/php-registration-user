<?php

require_once 'vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . "/../../");
$dotenv->load();

$servername = "mysql:" . $_ENV['FORWARD_DB_PORT'];

$username = $_ENV['DB_USERNAME'];
$password = $_ENV['DB_PASSWORD'];
$database = $_ENV['DB_DATABASE'];

$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully\n";

$query = <<<SQL
SELECT * FROM UsersTest1;
SQL;

$result = mysqli_execute_query($conn, $query);

foreach ($result as $row) {
    foreach ($row as $column => $value) {
        printf("%-10s: %s\n", $column, $value);
    }
    echo "\n";
}