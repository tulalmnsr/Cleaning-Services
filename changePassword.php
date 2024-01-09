<?php
session_start();

// Check if 'admin_id' is set in the session
if (!isset($_SESSION["admin_id"])) {
    // Redirect to login page if not logged in
    header("Location: loginAdmin.php");
    exit();
}

$admin_id = $_SESSION["admin_id"];

// Include your database connection file (e.g., db.php)
require_once "db.php";

// Assuming you have the connection in $project1

// Get the current password from the database for the given admin_id
$selectCurrentPasswordQuery = "SELECT password FROM admin WHERE admin_id = $admin_id";

try {
    $result = mysqli_query($project1, $selectCurrentPasswordQuery);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $currentPasswordFromDatabase = $row['password'];

        // Check if form is submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Validate form data
            $newPassword = mysqli_real_escape_string($project1, $_POST['newPassword']);
            $confirmNewPassword = mysqli_real_escape_string($project1, $_POST['confirmNewPassword']);

            if ($newPassword != $confirmNewPassword) {
                die("New password and confirm password do not match.");
            }

            // Update password in the database
            $hashedNewPassword = password_hash($newPassword, PASSWORD_DEFAULT);
            $updatePasswordQuery = "UPDATE admin SET password = '$hashedNewPassword' WHERE admin_id = $admin_id";

            $updateResult = mysqli_query($project1, $updatePasswordQuery);

            if ($updateResult) {
                // Password updated successfully, redirect to success page
                header("Location: dashboard.php");
                exit();
            } else {
                die("Error updating password: " . mysqli_error($project1));
            }
        }
    } else {
        die("Error selecting current password: " . mysqli_error($project1));
    }
} catch (mysqli_sql_exception $e) {
    die("Error: " . $e->getMessage());
}

// Close the database connection
mysqli_close($project1);
?>
