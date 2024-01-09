<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <title>Blog Page</title>
    <!-- css link -->
    <link rel="stylesheet" href="blogPage.css" />
    <!-- box icons -->
    <link
      rel="stylesheet"
      href="https://unpkg.com/boxicons@latest/css/boxicons.min.css"
    />
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

    <!-- banner -->
    <div class="banner">
      <div class="banner-content">
        <h1>Time to Get Your House Clean </h1>
        <p>
          Experience the ultimate deep cleaning service for your home. Our expert team ensures a spotless and refreshed living space, leaving no corner untouched.
        </p>
        <a href="blogPost.php" class="button">Read Article</a>
      </div>
    </div>

    <!-- featured post -->
    <section>
      <div class="featured-post">
        <div class="featured-left">
          <div class="featured-card">
            <img src="image3.jpg" alt="" />
            <h2 class="">Deep Cleaning for a Spotless Home</h2>
            <p>
              Discover the best tips and tricks for effective carpet cleaning. Our experts share valuable insights to keep your carpets looking fresh and vibrant.
            </p>
            <a href="blogPost.html" class="button">Read Article</a>
          </div>
          <div class="featured-card">
            <img src="blog-6.jpg" alt="" />
            <h2>Carpet Cleaning Tips and Tricks</h2>
            <p>
              Discover the best tips and tricks for effective carpet cleaning. Our experts share valuable insights to keep your carpets looking fresh and vibrant.
            </p>
            <a href="blogPost.php" class="button">Read Article</a>
          </div>
        </div>
        <div class="featured-right">
          <div>
            <h3>Green Cleaning: Eco-Friendly Solutions</h3>
            <p>
              Embrace eco-friendly cleaning solutions with our green cleaning service. We use environmentally conscious methods to ensure a clean and sustainable living environment.
            <a href="blogPost.php" class="readme-btn">Read in 3 minutes</a>
          </div>
          <div>
            <h3>Organizing Tips for a Tidy Space</h3>
            <p>
              Transform your space with our organizing tips. Achieve a tidy and efficient living area with our expert recommendations for decluttering and organizing.
            </p>
            <a href="blogPost.php" class="readme-btn">Read in 8 minutes</a>
          </div>
          <div>
            <h3>Window Cleaning Techniques</h3>
            <p>
              Achieve a streak-free shine with our window cleaning techniques. Learn the best methods for sparkling clean windows that enhance the natural light in your home.
            </p>
            <a href="blogPost.php" class="readme-btn">Read in 3 minutes</a>
          </div>
        </div>
      </div>
    </section>

    <section>
      <div class="blog-header">
        <h2 class="title">The Latest New Articles </h2>
        <div><a href="blogPost.php" class="button">Read Article</a></div>
      </div>

      <div class="SmartUV">
        <div class="blog-card">
          <img src="blog-1.jpg" alt="" />
          <h3>Chemical Free Cleaning</h3>
          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellendus, veniam? Inventore tempora numquam autem architecto quibusdam, recusandae nulla laborum iste doloremque dolore impedit fuga amet, ipsum praesentium quae hic consequuntur.</p>
          <a href="blogPost.php" class="readme-btn">Read in 2 minutes</a>
        </div>
        <div class="blog-card">
          <img src="blog-2.jpg" alt="" />
          <h3>10-Tips for Best Cleaning</h3>
          <p>
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellendus, veniam? Inventore tempora numquam autem architecto quibusdam, recusandae nulla laborum iste doloremque dolore impedit fuga amet, ipsum praesentium quae hic consequuntur.
          </p>
          <a href="blogPost.php" class="readme-btn">Read in 8 minutes</a>
        </div>
        <div class="blog-card">
          <img src="blog-3.jpg" alt="" />
          <h3>Bathroom Cleaning Hacks You Need to Know</h3>
          <p>
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellendus, veniam? Inventore tempora numquam autem architecto quibusdam, recusandae nulla laborum iste doloremque dolore impedit fuga amet, ipsum praesentium quae hic consequuntur.
          </p>
          <a href="blogPost.php" class="readme-btn">Read in 1 minutes</a>
        </div>
        <div class="blog-card">
          <img src="blog-4.jpg" alt="" />
          <h3>Window Cleaning Techniques</h3>
          <p>
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellendus, veniam? Inventore tempora numquam autem architecto quibusdam, recusandae nulla laborum iste doloremque dolore impedit fuga amet, ipsum praesentium quae hic consequuntur.
          </p>
          <a href="blogPost.php" class="readme-btn">Read in 12 minutes</a>
        </div>
      </div>
    </section>

    <!-- newsletter -->
    <div class="newsletter">
        <div>
            <h2>Subscribe to our Weekly Newsletter.</h2>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellendus, veniam? Inventore tempora numquam autem architecto quibusdam, recusandae nulla laborum iste doloremque dolore impedit fuga amet, ipsum praesentium quae hic consequuntur.</p>

            <form action="subscribe.php" method="post" class="form">
              <input type="email" name="email" id="email" placeholder="Enter your email address">
              <input type="submit" value="Subscribe" class="btn">
          </form>
          
        </div>
    </div>

    <!--footer start -->
<footer class="footer">
  <div class="column">
      <p>
         <h2>UltraTidy</h2>
          We work with a passion of taking challenges and creating new ones in advertising sector.
      </p>
      <p>Open Hours:</p>
          

      <p>Sun– Fri: 9 am – 8 pm,</p>
      <p>Saturday:CLOSED</p>
      <div class="social-icons">
          <a href="#"><i class="fa fa-facebook"></i></a>
          <a href="#"><i class="fa fa-twitter"></i></a>
          <a href="#"><i class="fa fa-instagram"></i></a>
          <a href="#"><i class="fa fa-youtube"></i></a>
      </div>
  </div>
  <div class="column nav-links">
      <h2>Navigation</h2>
      <ul>
          <li><a href="#">Home</a></li>
          <li><a href="#">About Us</a></li>
          <li><a href="#">Services</a></li>
          <li><a href="#">Contact Us</a></li>
      </ul>
  </div>
  <div class="column quick-links">
      <h2>Quick Links</h2>
      <ul>
          <li><a href="#">PrivacyPolicy</a></li>
          <li><a href="#">Terms Of Service</a></li>
          <li><a href="#">FAQs</a></li>
          <li><a href="#">Blog</a></li>
      </ul>
  </div>
  <div class="column contact-info">
      <h2>Contact Info</h2>
      <p>
          <i class="fa fa-phone"></i> +1-123-456-7890<br>
          <i class="fa fa-envelope"></i> info@example.com<br>
          <i class="fa fa-map-marker"></i> 123 Main St, City, Country
      </p>
  </div>
</footer>
<div class="copyright-box">
  <p>&copy; 2023 created by Zeina_Batoul_Mariam_Zeina</p>
</div>


    <!-- script tags -->
    <script src="https://unpkg.com/scrollreveal"></script>
    <script src="blogPage.js"></script>
    
  </body>
</html>