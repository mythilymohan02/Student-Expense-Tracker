<?php

$host = "db01.dbhost.dev";
$user = "user_452je8a3p";
$password = "p452je8a3p";
$database = "db_452je8a3p";
$port = 5051;

$conn = new mysqli($host, $user, $password, $database,$port);

if ($conn->connect_error) {
    die("Database Connection Failed: " . $conn->connect_error);
}

$conn->set_charset("utf8mb4");

?>