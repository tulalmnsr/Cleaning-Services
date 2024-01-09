<?php
// Function to push testimonial from testimonials to admin_testimonial_view
function pushTestimonial($conn, $testimonialId) {
    // Get testimonial details
    $testimonialQuery = "SELECT * FROM testimonials WHERE testimonial_id = $testimonialId";
    $testimonialResult = $conn->query($testimonialQuery);

    if ($testimonialResult->num_rows > 0) {
        $testimonialData = $testimonialResult->fetch_assoc();

        // Insert testimonial into admin_testimonial_view
        $insertQuery = "INSERT INTO admin_testimonial_view (testimonial_id, user_id, name, position, stars, opinion)
                        VALUES (
                            {$testimonialData['testimonial_id']},
                            {$testimonialData['user_id']},
                            '{$testimonialData['name']}',
                            '{$testimonialData['position']}',
                            {$testimonialData['stars']},
                            '{$testimonialData['opinion']}'
                        )";
        $insertResult = $conn->query($insertQuery);

        if ($insertResult) {
            // Delete testimonial from testimonials table
            $deleteQuery = "DELETE FROM testimonials WHERE testimonial_id = $testimonialId";
            $conn->query($deleteQuery);

            echo "Testimonial pushed successfully!";
        } else {
            echo "Error pushing testimonial: " . $conn->error;
        }
    } else {
        echo "Testimonial not found.";
    }
}

// Function to delete testimonial from testimonials
function deleteTestimonial($conn, $testimonialId) {
    // Delete testimonial from testimonials table
    $deleteQuery = "DELETE FROM testimonials WHERE testimonial_id = $testimonialId";
    $deleteResult = $conn->query($deleteQuery);

    if ($deleteResult) {
        echo "Testimonial deleted successfully!";
    } else {
        echo "Error deleting testimonial: " . $conn->error;
    }
}
?>

