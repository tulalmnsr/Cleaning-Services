<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="homePage.css">
    <link rel="icon" href="favicon.ico" type="image/x-icon">

    <title>Document</title>
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
        <li><a class="item" href="#home">HOME</a></li>
        <li><a class="item" href="#services">SERVICES</a></li>
        <li><a class="item" href="#about">ABOUT US</a></li>
        <li><a class="item" href="#blog">BLOG</a></li>
        <li><a class="item" href="#contact">CONTACT</a></li>
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
                    <a href="login.php">User Login</a>
                    <a href="loginAdmin.php">Admin Login</a>
                </div>
            </li>
            <li class="dropdown">
                <a href="#" class="button">Sign Up <i class="fas fa-caret-down"></i></a>
                <div class="dropdown-content">
                    <a href="register.php">User Sign up</a>
                    <a href="signUpAdmin.php">Admin Sign up</a>
                </div>
            </li>';
    }
    ?>
</nav>
    </ul>
  </nav>
  
<Section class ="banner" id="home">
    <div class="banner">
        <div class="container">
          <h1 class="banner-title">
            <span>UltraTidy</span>Cleaning Services 
          </h1>
          <p>Your trusted partner in professional cleaning services.</p>
          <div class="book-appointment-btn">
            <a href="appointment.html" class="button">Book an Appointment</a>
        </div>
        </div>

      </div>
      <div class="header-image">
        <img src="slider1.jpg" alt="Header Image">
      </div>
</Section>
<!--ABOUT START-->
<section class="about" id="about">
    <div class="container">
        <h2>why choose us</h2>
        <div class="about-container">
            <div class="box">
                <i class="fas fa-shield-alt"></i>
                <h3>premium services</h3>
                <p>Lorem ipsum dolor consectetur adipisicing elit sedit dout.</p>
            </div>
            <div class="box">
                <i class="fas fa-dollar-sign"></i>
                <h3>cost</h3>
                <p>Lorem ipsum dolor consectetur adipisicing elit sedit dout.</p>
            </div>
            <div class="box">
                <i class="fas fa-hand-holding"></i>
                <h3>eco friendly</h3>
                <p>Lorem ipsum dolor consectetur adipisicing elit sedit dout.</p>
            </div>
            <div class="box">
                <i class="fab fa-bitbucket"></i>
                <h3>special equipment</h3>
                <p>Lorem ipsum dolor consectetur adipisicing elit sedit dout.</p>
            </div>
        </div> 
        
    </div><br><br><br><br><br><br>
    <div>
        <a href="galleryPage.html" class="button">learn more</a>
    </div>
</section>

<!--ABOUT END-->
<!--Service Start-->
<section class="services" id="services"><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
    <h2><br>WHAT WE OFFER SERVICES?<br><br><br></h2>
    <ul>

        <li>
            <a href="carpetCleaning.html">
                <img src="carpet-icon.png" alt="Carpet Cleaning">
                <h3>Carpet Cleaning</h3>
            </a>
        </li>
        <li>
            <a href="mattressCleaning.html">
                <img src="bed-icon.png" alt="Mattress Cleaning">
                <h3>Mattress Cleaning</h3>
            </a>
        </li>
        <li>
            <a href="tilesAndGroutCleaning.html">
                <img src="tilesAndGroutCleaning.png" alt="Tiles & Grout Cleaning">
                <h3>Tiles & Grout Cleaning</h3>
            </a>
        </li>
        <li>
            <a href="upholsteryCleaning.html">
                <img src="upholstery-icon2.png" alt="Upholstery Cleaning">
                <h3>Upholstery Cleaning</h3>
            </a>
        </li>
        <li>
            <a href="LeatherSofaCleaning.html">
                <img src="LeatherSofaCleaning.png" alt="Leather Sofa Cleaning">
                <h3>Leather Sofa Cleaning</h3>
            </a>
        </li>
        <li>
            <a href="rugCleaning.html">
                <img src="rugCleaning.png" alt="Rug Cleaning">
                <h3>Rug Cleaning</h3>
            </a>
        </li>

    </ul>
</section>
<!--Service End-->
<!--Prices Start-->
<section class="pricing" id="pricing">
    <div class="container">
        <h2>
            choose your pricing plan
        </h2>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
            dolore magna aliqua ut enim ad minim veniam.</p>
        <div class="pricing-container">
            <div class="price-box">
                <h3>start plan</h3>
                <div class="price">
                    <span>$</span>
                    19
                    <span>95</span>
                    <p>per hour</p>
                </div>
                <p>Experienced & Trained Cleaner
                    <span>Maintenance</span> Cleaning
                    Insured Liability & Damage
                    Planned <span>Holiday</span> Cover
                    You Choose Cleaning Day</p>
                <a href="#" class="btn">order now</a>
            </div>
            <div class="price-box">
                <h3>standard plan</h3>
                <div class="price">
                    <span>$</span>
                    29
                    <span>95</span>
                    <p>per hour</p>
                </div>
                <p>Experienced & Trained Cleaner
                    <span>Maintenance</span> Cleaning
                    Insured Liability & Damage
                    Planned <span>Holiday</span> Cover
                    You Choose Cleaning Day</p>
                <a href="#" class="btn">order now</a>
            </div>
            <div class="price-box">
                <h3>premium plan</h3>
                <div class="price">
                    <span>$</span>
                    59
                    <span>95</span>
                    <p>per hour</p>
                </div>
                <p>Experienced & Trained Cleaner
                    <span>Maintenance</span> Cleaning
                    Insured Liability & Damage
                    Planned <span>Holiday</span> Cover
                    You Choose Cleaning Day</p>
                <a href="#" class="btn">order now</a>
            </div>
        </div>
    </div>
</section>
 <!-- Team Member Section -->
 <section class="team-section" id="team">
 <div class="page-container">
    <h1 class="team-title">OUR EXPERT TEAM MEMBERS</h1>
    <div class="team-section">
        <div class="team-card">
            <img src="profile1.jpg" alt="Team Member 1">
            <h2>Jane Doe</h2>
            <p>Cleaning Specialist</p>
        </div>

        <div class="team-card">
            <img src="profile3.jpg" alt="Team Member 2">
            <h2>Jane Smith</h2>
            <p>Head Cleaner</p>
        </div>

        <div class="team-card">
            <img src="profile2.jpg" alt="Team Member 3">
            <h2>Bob Johns</h2>
            <p>Senior Cleaner</p>
        </div>

        <div class="team-card">
            <img src="profile4.jpg" alt="Team Member 4">
            <h2>Mark Doe</h2>
            <p>Assistant Cleaner</p>
        </div>

</div>
</section>
<!-- Team Member End -->
<!--APPLY SECTION START-->
<section class="applypage" id="apply">
    <div>
        <p>Are You Ready To Work With Us Now?</p> <br><br>
        <p style="font-size:1.2em">What do you think after seeing the good response from our previous customers.</p> 
        <p style="font-size:1.2em">
            Embark on a transformative journey by joining our family today! Apply now and become an integral part of our dynamic community.</p>
            <br><br><br><br> <div><a href="applynow.html" class="button">Apply Now</a></div>
    </div>
</section>
<!--APPLY SECTION END-->
<section class="reviews" id="reviews">
    <div class="container">
        <h2>what customer say</h2><br><br><br>
        <div class="review-content" id="review-content">
            <div class="review-box active">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut
                    labore
                    et
                    dolore magna aliqua ut enim ad minim veniam.
                    Quis nostrud exercitation ullamco laboris nisi ut</p>
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="far fa-star"></i>
                      </div>
                <img src="author1.jpg" alt="">
                <div class="profile-desc">
                    <h5>mary smith</h5>
                    <span>saida, Lebanon</span>
                </div>
            </div>
            <div class="review-box">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut
                    labore
                    et
                    dolore magna aliqua ut enim ad minim veniam.
                    Quis nostrud exercitation ullamco laboris nisi ut</p>
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="far fa-star"></i>
                      </div>
                <img src="client2.png" alt="">
                <div class="profile-desc">
                    <h5>amonde willam</h5>
                    <span>nabatieh, Lebanon</span>
                </div>
            </div>
            <div class="review-box">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut
                    labore
                    et
                    dolore magna aliqua ut enim ad minim veniam.
                    Quis nostrud exercitation ullamco laboris nisi ut</p>
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                      </div>
                <img src="author2.jpg" alt="">
                <div class="profile-desc">
                    <h5>ahmad mrad</h5>
                    <span>saida, Lebanon</span>
                </div>
            </div>
            <div class="review-box">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut
                    labore
                    et
                    dolore magna aliqua ut enim ad minim veniam.
                    Quis nostrud exercitation ullamco laboris nisi ut</p>
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                      </div>
                <img src="author3.jpg" alt="">
                <div class="profile-desc">
                    <h5>amonde willam</h5>
                    <span>nabatieh, Lebanon</span>
                </div>
            </div>
            <div class="review-box">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut
                    labore
                    et
                    dolore magna aliqua ut enim ad minim veniam.
                    Quis nostrud exercitation ullamco laboris nisi ut</p>
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                      </div>
                <img src="author4.jpg" alt="">
                <div class="profile-desc">
                    <h5>amonde willam</h5>
                    <span>saida, Lebanon</span>
                </div>
            </div>
        </div>
    </div>
    <span id="right-arrow" class="arrow right fa fa-chevron-right"></span>
    <span id="left-arrow" class="arrow left fa fa-chevron-left"></span>
    <ul class="dots" id="review-dots">
        <li class="dot active"></li>
        <li class="dot"></li>
        <li class="dot"></li>
        <li class="dot"></li>
        <li class="dot"></li>
    </ul>
</section>
<br><br><br>
<div class="review">
    <a href="testimonialsPage.php" class="button">Show All</a>
</div> <br><br><br>
<!--Testimonial End-->

<!--Latest News Start -->
<section class="blog-section" id="blog">
    <div class="section-header">
        <div class="centered-text">
            <h2>Latest News</h2>
        </div>
        <div class="centered-text">
            <h2>Read Our New Blogs</h2>
        </div>
    </div>
    <div class="blog-cards">
        <div class="blog-card">
            <img src="blog1.jpg" alt="Blog Image 1">
            <div class="info-box">
                <span class="date">October 15, 2023</span>
                <div class="author">
                    <img src="author1.jpg" alt="Author 1">
                    <p class="name">John Doe</p>
                    <p class="position">"Cleaning Expert"</p>
                </div>
                <p class="news">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc vestibulum eros in urna tincidunt.</p>
            </div>
        </div>
        <div class="blog-card">
            <img src="blog2.jpg" alt="Blog Image 2">
            <div class="info-box">
                <span class="date">September 28, 2023</span>
                <div class="author">
                    <img src="author2.jpg" alt="Author 2">
                    <p class="name">Jane Smith</p>
                    <p class="position">"Household Tips"</p>
                </div>
                <p class="news">Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.</p>
            </div>
        </div>
        <div class="blog-card">
            <img src="blog3.jpg" alt="Blog Image 3">
            <div class="info-box">
                <span class="date">August 12, 2023</span>
                <div class="author">
                    <img src="author3.jpg" alt="Author 3">
                    <p class="name">Alice Johnson</p>
                    <p class="position">"Cleaning Tips"</p>
                </div>
                <p class="news">Sed sagittis bibendum dolor, non interdum mi hendrerit vel. Fusce vel viverra urna.</p>
            </div>
        </div>
        <div class="blog-card">
            <img src="blog4.jpg" alt="Blog Image 4">
            <div class="info-box">
                <span class="date">July 3, 2023</span>
                <div class="author">
                    <img src="author4.jpg" alt="Author 4">
                    <p class="name">David Wilson</p>
                    <p class="position">"Cleaning Hacks"</p>
                </div> 
                <p class="news">Nulla facilisi. Vivamus in odio ut justo auctor commodo. Sed a libero in massa.</p>
            </div>
        </div>
    </div>
    <br><br><br>
<div>
    <a href="blogPage.php" class="button">See All</a>
</div> <br><br><br>
</section>
<!--Latest News End -->
<!-- FAQs Start -->
<section class="FAQs" id="faqs">
    <div class="column1">
        <h5>FREQUENTLY ASKED QUESTION</h5>
        <p><h1>GET ANSWERS TO COMMON</h1></p>
        <p><h1>QUESTIONS ABOUT OUR APP</h1></p>
        <div id="question">
            What do you not clean?
         </div>
         <br>
         <div id="question">
            Do I need to be home for every cleaning service?
         </div>
         <br>
         <div id="question">
            How will our relationship work?
         </div>
         <br>
         <div id="question">
            What time does your team arrive?
         </div>
         <br>
         <div >
            <a href="faqsPage.html" class="button">View All FAQs</a>
        </div>
    </div>
    
    <div class="column1">
        <br><br><br>
        <div class="parent">
            <img class="image1" src="image01.jpg" />
            <img class="image2" src="image02.jpg" />
          </div>
</div>
</section>
<section class="contact" id="contact">
        <div class="container"><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
            <h2>contact our team</h2>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Hic, provident.</p>

                <div class="contact-right">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3311.819089123944!2d35.50171853544536!3d33.89431279999999!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x151f16e142563ebb%3A0xad8fa77b2ab4eb91!2sRegus%20-%20Beirut%20Azariyah!5e0!3m2!1sen!2slb!4v1657562790790!5m2!1sen!2slb"
                        width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
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
                <li><a href="#about">About Us</a></li>
                <li><a href="#services">Services</a></li>
                <li><a href="#contact">Contact Us</a></li>
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
      

<!--Footer End -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="homePage.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/4.1.2/socket.io.js"></script>
<script>
  // Initialize Socket.IO
  const socket = io();

  // Function to send a message
  function sendMessage() {
    const message = $("textarea").val();

    // Emit a 'sendMessage' event to the server
    socket.emit('sendMessage', { message });

    // Clear the input field
    $("textarea").val("");
  }

  // ... (you may add additional functionality as needed) ...
</script>
</body>

</html>