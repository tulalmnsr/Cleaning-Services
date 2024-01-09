<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project1";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$testimonialId = $_POST['testimonialId'];

// Implement logic to push the testimonial (e.g., move to another table)
// Updthe query basate ed on your database structure and requirements
$updateQuery = "UPDATE testimonials SET pushed = 1 WHERE testimonial_id = $testimonialId";

if ($conn->query($updateQuery) === TRUE) {
    echo "Testimonial pushed successfully!";
} else {
    echo "Error pushing testimonial: " . $conn->error;
}

$conn->close();
?>
