<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION["admin_id"])) {
    header("Location: loginAdmin.php");
    exit();
}

// Include your database connection file here
include "db.php";

$admin_id = $_SESSION["admin_id"];

// Implement your logic for account deletion
// Example: Delete account (replace this with your actual database logic)
$deleteAccountQuery = "DELETE FROM admin WHERE admin_id = $admin_id";

if (mysqli_query($your_connection, $deleteAccountQuery)) {
    // Clear session
    session_unset();
    session_destroy();

    // Redirect to the login page
    header("Location: loginAdmin.php");
    exit();
} else {
    echo "Error deleting account: " . mysqli_error($your_connection);
}

// Close the database connection
mysqli_close($your_connection);
?>
