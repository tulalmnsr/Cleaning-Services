<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "project1";

$your_connection = mysqli_connect($servername, $username, $password, $database);

if (!$your_connection) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
