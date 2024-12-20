<?php
$server = $_ENV["server"];
$username = $_ENV["username"];
$password = $_ENV["password"];
$dbname = $_ENV["dbname"];
$connection = mysqli_connect($server, $username, $password, $dbname);
mysqli_set_charset($connection,'utf8mb4');
?>