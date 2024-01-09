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

// Implement logic to delete the testimonial
// Update the query based on your database structure and requirements
$deleteQuery = "DELETE FROM testimonials WHERE testimonial_id = $testimonialId";

if ($conn->query($deleteQuery) === TRUE) {
    echo "Testimonial deleted successfully!";
} else {
    echo "Error deleting testimonial: " . $conn->error;
}

$conn->close();
?>

