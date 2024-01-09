<?php
session_start();

if (!isset($_SESSION["admin_id"])) {
    // Redirect to login page if not logged in
    header("Location: profileInfo.php");
    exit();
}

$servername = "localhost";
$username = "root";
$password = "";
$database = "your_database_name";

$your_connection = mysqli_connect($servername, $username, $password, $database);

if (!$your_connection) {
    die("Connection failed: " . mysqli_connect_error());
}

$admin_id = $_SESSION["admin_id"];

// Assuming you have form fields like fullName, age, occupation, etc.
$fullName = mysqli_real_escape_string($your_connection, $_POST['fullName']);
$age = mysqli_real_escape_string($your_connection, $_POST['age']);
$occupation = mysqli_real_escape_string($your_connection, $_POST['occupation']);
$work = mysqli_real_escape_string($your_connection, $_POST['work']);
$gender = mysqli_real_escape_string($your_connection, $_POST['gender']);
$country = mysqli_real_escape_string($your_connection, $_POST['country']);
$contact = mysqli_real_escape_string($your_connection, $_POST['contact']);
$facebookLink = mysqli_real_escape_string($your_connection, $_POST['facebookLink']);
$googleLink = mysqli_real_escape_string($your_connection, $_POST['googleLink']);
$linkedinLink = mysqli_real_escape_string($your_connection, $_POST['linkedinLink']);

// Update the admin table
$updateSql = "UPDATE admin SET full_name='$fullName', age=$age, occupation='$occupation', work='$work', gender='$gender', country='$country', contact_email='$contact', 
              facebook_url='$facebookLink', google_url='$googleLink', linkedin_url='$linkedinLink' WHERE admin_id=$admin_id";

try {
    if (mysqli_query($your_connection, $updateSql)) {
        // Redirect to profileInfo.php after successful update
        header("Location: profileInfo.php");
        exit();
    } else {
        echo "Error updating profile: " . mysqli_error($your_connection);

    }
} catch (mysqli_sql_exception $e) {
    echo "Error: " . $e->getMessage();
}
// Example debugging statement
echo "Debug Point 1";
error_log("Debug Point 2");

// Close the database connection
mysqli_close($your_connection);
?>

