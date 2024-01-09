<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project1";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
include 'testimonial_functions.php';
// Calculate average stars for user-added testimonials
$averageStarsQuery = "SELECT AVG(stars) as average_stars FROM testimonials WHERE user_id IS NOT NULL";
$averageStarsResult = $conn->query($averageStarsQuery);

if ($averageStarsResult) {
    $averageStarsRow = $averageStarsResult->fetch_assoc();
    $averageStars = $averageStarsRow['average_stars'];
} else {
    $averageStars = 0; // Default value if there are no user-added testimonials
}

// Fetch user-added testimonials for display
$query = "SELECT * FROM testimonials WHERE user_id IS NOT NULL";
$result = $conn->query($query);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- Boxicons -->
    <link
      href="https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css"
      rel="stylesheet"/>
    
    
    <link rel="stylesheet" href="path/to/dark-mode.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha384-glCJ3IBTtXaWHP-3tW3jWsr3zRjN/6M8R5ZL+HUaL7cWCDaUjNp9ff0b1jJP9MUp" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
    <!-- My CSS -->
    <link rel="stylesheet" href="reviews.css" />
    <title>UltraTidy Admin</title>
    <link rel="shortcut icon" type="image/png" href="./img/favicon.ico" />

  </head>
  <body>
   <!-- SIDEBAR -->
<section id="sidebar">
  <a href="#" class="brand">
    <i class="fas fa-broom"></i>
    <span class="text">UltraTidy Admin </span>
  </a>
  <ul class="side-menu top">
    <li>
      <a href="dashboard.html">
        <i class="bx bxs-dashboard"></i>
        <span class="text">Dashboard</span>
      </a>
    </li>
    <li>
      <a href="payment.html">
        <i class="bx bxs-shopping-bag-alt"></i>
        <span class="text">My Store</span>
      </a>
    </li>
    <li>
      <a href="analytics.html">
        <i class="bx bxs-doughnut-chart"></i>
        <span class="text">Analytics</span>
      </a>
    </li>
    <li>
      <a href="messages.html">
        <i class="bx bxs-message-dots"></i>
        <span class="text">Message</span>
      </a>
    </li>
    <li>
      <a href="team.html">
        <i class="bx bxs-group"></i>
        <span class="text">Team</span>
      </a>
    </li>
    <!-- Pages section with subpages -->
    <li class="has-submenu" id="pages-menu">
      <a href="javascript:void(0);">
        <i class="bx bx-file"></i>
        <span class="text">Pages</span>
        <i class="bx bx-chevron-down"></i>
      </a>
      <ul class="submenu">
        <li><a href="services.html">Services</a></li>
        <li><a href="reviews.html">Reviews</a></li>
        <li><a href="appointment.html">Appointment</a></li>
        <li><a href="clients.html">Clients</a></li>
        <li><a href="blog.html">Blog</a></li>
        <li><a href="gallery.html">Gallery</a></li>
        <li><a href="analytics.html">Analytics</a></li>
      </ul>
    </li>
  </ul>
  <ul class="side-menu">
    <li>
      <a href="settings.html">
        <i class="bx bxs-cog"></i>
        <span class="text">Settings</span>
      </a>
    </li>
    <li>
      <a href="LogIn.html" class="logout">
        <i class="bx bxs-log-out-circle"></i>
        <span class="text">Logout</span>
      </a>
    </li>
  </ul>
</section>
<!-- SIDEBAR -->


    <!-- CONTENT -->
    <section id="content">
      <!-- NAVBAR -->
      <nav>
        <i id="sidebarToggle" class="bx bx-menu"></i>

        <a href="services.html" class="nav-link">Categories</a>
        <form action="#">
          <div class="form-input">
            <input type="text" placeholder="Search..."  id="searchInput"/>
            <button onclick="searchReviews()" class="search-btn">
              <i class="bx bx-search"></i>
            </button>
          </div>
        </form>
        <input type="checkbox" id="switch-mode" hidden />
        <label for="switch-mode" class="switch-mode"></label>
        <a href="profileInfo.html" class="profile">
          <img src="profile1.jpg" />
        </a>
      </nav>
      <!-- NAVBAR -->
      <div class="testimonial-content">
    <h1>Testimonials</h1>
    <h3>What Our Clients Say?</h3>
    <p>Average Stars: <?php echo number_format($averageStars, 2); ?></p>
</div>

<div class="row mt-5">
    <?php
    while ($row = $result->fetch_assoc()) {
        echo '<div class="col-md-4 mb-4">';
        echo '<div class="box">';
        echo '<i class="fas fa-quote-left quote"></i>';
        echo '<p>' . $row['opinion'] . '</p>';
        echo '<div class="content">';
        echo '<div class="info">';
        echo '<div class="name">User ID: ' . $row['user_id'] . '</div>';
        echo '<div class="stars">';

        for ($i = 1; $i <= 5; $i++) {
            if ($i <= $row['stars']) {
                echo '<i class="fas fa-star"></i>';
            } else {
                echo '<i class="far fa-star"></i>';
            }
        }

        echo '</div>';
        echo '</div>';

// Testimonial actions (push and delete)
echo '<div class="testimonial-actions">';
echo '<button onclick="pushTestimonial(' . $row['testimonial_id'] . ')"><i class="fas fa-arrow-up"></i> Push</button>';
echo '<button onclick="deleteTestimonial(' . $row['testimonial_id'] . ')"><i class="fas fa-trash"></i> Delete</button>';
echo '</div>';


        echo '</div>';
        echo '</div>';
        echo '</div>';
    }
    ?>
</div>

       <!-- footer -->
    <div class="footer">
        <p>Made with Love by <a href="#">Zeina_Batoul_Mariam_Zeina </a> <span id="date"></span></p>
      </div>
      <!-- End of footer -->      
    <!-- Include jQuery -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="reviews.js"></script>


    </body>
  </html>
  
<?php
// Close the database connection
$conn->close();
?>