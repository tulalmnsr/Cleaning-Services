<?php
// Assuming you have established a database connection
$servername = "localhost";
$username = "root";
$password = "";
$database = "project1";

$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Retrieve notifications from the database
$sql = "SELECT * FROM notifications WHERE is_read = false ORDER BY created_at DESC";
$result = mysqli_query($conn, $sql);

// Display notifications
while ($row = mysqli_fetch_assoc($result)) {
    echo "<p>{$row['message']}</p>";
}

// Mark notifications as read
$updateSql = "UPDATE notifications SET is_read = true WHERE is_read = false";
mysqli_query($conn, $updateSql);

// Close the database connection
mysqli_close($conn);
?>
