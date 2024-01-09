<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project1";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $testimonialId = $_POST['testimonialId'];

    // Fetch the testimonial details from testimonials table
    $fetchQuery = "SELECT * FROM testimonials WHERE testimonial_id = $testimonialId";
    $fetchResult = $conn->query($fetchQuery);

    if ($fetchResult->num_rows > 0) {
        $testimonialData = $fetchResult->fetch_assoc();

        // Insert the testimonial into admin_testimonial_view
        $insertQuery = "INSERT INTO admin_testimonial_view (testimonial_id, user_id, name, position, stars, opinion) 
                        VALUES ('$testimonialData[testimonial_id]', '$testimonialData[user_id]', 'User', 'Position', '$testimonialData[stars]', '$testimonialData[opinion]')";
        
        if ($conn->query($insertQuery) === TRUE) {
            echo "Testimonial pushed successfully.";
        } else {
            echo "Error pushing testimonial: " . $conn->error;
        }
    } else {
        echo "Testimonial not found.";
    }
} else {
    echo "Invalid request.";
}

$conn->close();
?>
