<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project1";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the email from the form
    $email = $_POST["email"];

    // Validate the email (you can add more validation if needed)
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Check if the email already exists
        $checkQuery = "SELECT * FROM newsletter_subscriptions WHERE email = '$email'";
        $result = $conn->query($checkQuery);

        if ($result->num_rows > 0) {
            echo "Error: Email is already subscribed.";
        } else {
            // Insert the email into the database
            $insertQuery = "INSERT INTO newsletter_subscriptions (email) VALUES ('$email')";
            if ($conn->query($insertQuery) === TRUE) {
                echo "Subscription successful!";
            } else {
                echo "Error: " . $insertQuery . "<br>" . $conn->error;
            }
        }
    } else {
        echo "Error: Invalid email address.";
    }
}

// Close the database connection
$conn->close();
?>
