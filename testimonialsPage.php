<?php
// Establish a connection to your MySQL database
$servername = "localhost"; // Assuming your database is on the same server
$username = "root"; // Default XAMPP username
$password = ""; // Default XAMPP password is usually empty
$dbname = "project1"; // Replace with your actual database name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch testimonials from the database
$sql = "SELECT * FROM testimonials";
// Warning: Undefined variable $conn in C:\xampp\htdocs\submit_feedback.php on line 11

$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Testimonials Page</title>
    <link rel="stylesheet" href="testimonialsPage.css">
    <link href='https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <!-- Add your existing head content here -->
</head>
<body>
    <!-- Navbar -->
    <!-- Navbar One -->
    <nav class="navbar-one flex">
        <div class="left flex">
            <div class="email">
                <i class="fa fa-envelope"></i>
                <span>Working Hours: 08:00 AM - 10:00 PM (MON-SAT)</span>
            </div>
        </div>
        <div class="call">
            <i class="fa fa-phone-alt"></i>
            <span>Call Us : ########</span>
        </div>
    </nav>

   <!-- Navbar Two -->
<nav class="navbar-two flex">
  <label class="logo">
      <h1>UltraTidy</h1>
  </label>
  <div class="menu-icon" onclick="toggleMenu()">
      <i class="fas fa-bars"></i>
  </div>
  <ul class="flex"  id="navbar-links">
      <li><a class="item" href="homePage.html">HOME</a></li>
      <li><a class="item" href="homePge.html">SERVICES</a></li>
      <li><a class="item" href="aboutPage.html">ABOUT US</a></li>
      <li><a class="item" href="blogPage.html">BLOG</a></li>
      <li><a class="item" href="contactPage.html">CONTACT</a></li>
      <?php
      // Check if the user is logged in (you need to implement this logic)
      session_start();
      $isLoggedIn = isset($_SESSION['user_id']); // Example, replace with your actual login check
  
      if ($isLoggedIn) {
          echo '<li><a class="button" href="logout.php">Logout</a></li>';
      } else {
          echo '<li class="dropdown">
                  <a href="#" class="button">Log In <i class="fas fa-caret-down"></i></a>
                  <div class="dropdown-content">
                      <a href="loginUser.html">User Login</a>
                      <a href="loginAdmin.html">Admin Login</a>
                  </div>
              </li>
              <li class="dropdown">
                  <a href="#" class="button">Sign Up <i class="fas fa-caret-down"></i></a>
                  <div class="dropdown-content">
                      <a href="signUpUser.html">User Sign up</a>
                      <a href="signUpAdmin.html">Admin Sign up</a>
                  </div>
              </li>';
      }
      ?>
  </nav>

    <!-- Slider Section -->
    <div class="slider-container">
        <!-- Slider Content above the three images -->
        <div class="slider-content">
            <h2>Cleaning Service Company</h2>
            <p>Your trusted partner in professional cleaning services.</p>
        </div>
        <div class="slider">
            <div class="slide">
                <img src="slider-image-1.jpg" alt="Slider Image 1">
            </div>
            <div class="slide">
                <img src="slider-image-2.jpg" alt="Slider Image 2">
            </div>
            <div class="slide">
                <img src="slider-image-3.jpg" alt="Slider Image 3">
            </div>
        </div>
    </div>
    
    <!-- Testimonials -->
    <br><br><br>
    <div class="testimonial-content">
        <h2>Testimonials</h2>
        <p>What Our Clients Say?</p>
    </div><br><br><br>
    <div class="row mt-5">
    <?php
    // Loop through each testimonial and display it
    while ($row = $result->fetch_assoc()) {
        echo '<div class="col-md-4 mb-4">';
        echo '<div class="box">';
        echo '<i class="fas fa-quote-left quote"></i>';
        echo '<p>' . $row['opinion'] . '</p>';
        echo '<div class="content">';
        echo '<div class="stars">';

        // Display stars based on the 'stars' column value
        for ($i = 1; $i <= 5; $i++) {
            if ($i <= $row['stars']) {
                echo '<i class="fas fa-star"></i>';
            } else {
                echo '<i class="far fa-star"></i>';
            }
        }

        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }
    ?>
</div>


    <!-- Add Your Feedback (Form) -->
   <!-- Add Your Feedback (Form) -->
<div class="wrapper">
    <h3>Add Your Feedback</h3>
    <form action="submit_feedback.php" method="post">
        <!-- Use a hidden input for user_id -->
        <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']; ?>">

        <!-- Use a visible input for stars (rating) -->
        <div class="rating">
            <input type="number" name="stars" hidden>
            <i class='bx bx-star star' style="--i: 0;"></i>
            <i class='bx bx-star star' style="--i: 1;"></i>
            <i class='bx bx-star star' style="--i: 2;"></i>
            <i class='bx bx-star star' style="--i: 3;"></i>
            <i class='bx bx-star star' style="--i: 4;"></i>
        </div>
        <textarea name="opinion" cols="30" rows="5" placeholder="Your opinion..."></textarea>
        <div class="btn-group">
            <button type="submit" class="btn submit">Submit</button>
            <button type="button" class="btn cancel">Cancel</button>
        </div>
    </form>
</div>

    <!-- footer -->
    <footer>
        <div class="social-links">
            <a href="#"><i class="fab fa-facebook-f"></i></a>
            <a href="#"><i class="fab fa-twitter"></i></a>
            <a href="#"><i class="fab fa-instagram"></i></a>
            <a href="#"><i class="fab fa-youtube"></i></a>
        </div>
        <span>UltraTidy Cleaning Services Testimonial Page</span>
    </footer>
    <!-- end of footer -->

    <?php
    // Close the database connection
    $conn->close();
    ?>

    <script src="testimonialsPage.js"></script>
</body>
</html>


