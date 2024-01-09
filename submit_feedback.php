<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    die("User is not logged in.");
}

$userId = $_SESSION['user_id'];
$opinion = $_POST['opinion'];
$stars = $_POST['stars'];

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project1";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$insertQuery = "INSERT INTO testimonials (user_id, stars, opinion) VALUES ($userId, $stars, '$opinion')";

if ($conn->query($insertQuery) === TRUE) {
    echo "Feedback submitted successfully!";
} else {
    echo "Error: " . $insertQuery . "<br>" . $conn->error;
}

$conn->close();
?>
