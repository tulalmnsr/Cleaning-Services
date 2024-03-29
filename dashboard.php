
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://rawgit.com/eKoopmans/html2pdf/master/dist/html2pdf.bundle.js"></script>

    <!-- Boxicons -->
    <link
      href="https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css"
      rel="stylesheet"/>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
      
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
    <!-- My CSS -->
    <link rel="stylesheet" href="dashboard.css" />

    <title>UltraTidy Admin</title>
    <link rel="shortcut icon" type="image/png" href="./img/favicon.ico" />
  </head>
  <body>
    <!-- SIDEBAR -->
     <!-- SIDEBAR -->
<section id="sidebar">
  <a href="#" class="brand">
    <i class="fas fa-broom"></i>
    <span class="text">UltraTidy Admin </span>
  </a>
  <ul class="side-menu top">
    <li class="active">
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
      <a href="analytic.html">
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
        
      </ul>
    </li>
  </ul>
  <ul class="side-menu">
    <li>
      <a href="settings.php">
        <i class="bx bxs-cog"></i>
        <span class="text">Settings</span>
      </a>
    </li>
    <li>
  <a href="logout.php" class="logout">
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
        <i class="bx bx-menu"></i>
        <a href="services.html" class="nav-link">Categories</a>
        <form id="search-form">
          <div class="form-input">
            <input type="search" id="search-input" placeholder="Search..." />
            <button type="submit" id="search-btn" class="search-btn">
              <i class="bx bx-search"></i>
            </button>
          </div>
        </form>
        <input type="checkbox" id="switch-mode" hidden />
        <label for="switch-mode" class="switch-mode"></label>
        <div class="notification-icon">
          <a href="#" class="notification">
            <i class="bx bxs-bell"></i>
          </a>
          <!-- Notification menu -->
          <div class="notification-menu" id="notificationMenu">
            <!-- Content of the notification menu goes here -->
          </div></div>
        <a href="profileInfo.php" class="profile">
          <img src="profile1.jpg" />
        </a>
      </nav>
      <!-- NAVBAR -->

      <!-- MAIN -->
      <main>
        <div class="head-title">
          <div class="left">
            <h1>Dashboard</h1>
            <ul class="breadcrumb">
              <li>
                <a href="#">Dashboard</a>
              </li>
              <li><i class="bx bx-chevron-right"></i></li>
              <li>
                <a class="active" href="dashboard.php">Home</a>
              </li>
            </ul>
          </div>
        
         <a href="#" class="btn-download" onclick="downloadPDF()">
          <i class="bx bxs-cloud-download"></i>
          <span class="text" id="download-btn">Download PDF</span>
        </a>
      </div>
        <ul class="box-info">
          <li>
            <i class="bx bxs-calendar-check"></i>
            <span class="text">
              <h3 id="numbers-count">0</h3>
              <p>New Order</p>
            </span>
          </li>
          <li>
            <i class="bx bxs-group"></i>
            <span class="text">
              <h3 id="numbers-count">0</h3>
              <p>Visitors</p>
            </span>
          </li>
          <li>
            <i class="bx bxs-dollar-circle"></i>
            <span class="text">
              <h3 id="numbers-count">$0</h3>
              <p>Total Sales</p>
            </span>
          </li>
        </ul>
            <div class="table-data">
              <div class="order">
                <div class="head">
                  <h3>Recent Orders</h3>
                  <div class="actions">
                    <i class="bx bx-search" id="search-icon"></i>
                    <i class="bx bx-filter" id="filter-icon"></i>
                  </div>
                </div>
             <table id="order-table">
              <thead>
                <tr>
                  <th>User</th>
                  <th>Date Order</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>
                    <img src="profile2.jpg" />
                    <p>John Peters</p>
                  </td>
                  <td>15-11-2023</td>
                  <td><span class="status completed">Completed</span></td>
                </tr>
                <tr>
                  <td>
                    <img src="profile3.jpg" />
                    <p>Jennifer Agile</p>
                  </td>
                  <td>15-11-2018</td>
                  <td><span class="status pending">Pending</span></td>
                </tr>
                <tr>
                  <td>
                    <img src="profile4.jpg" />
                    <p>Precious Smith</p>
                  </td>
                  <td>15-11-2023</td>
                  <td><span class="status process">Process</span></td>
                </tr>
                <tr>
                  <td>
                    <img src="profile2.jpg" />
                    <p>Zoe Smith</p>
                  </td>
                  <td>15-11-2023</td>
                  <td><span class="status pending">Pending</span></td>
                </tr>
                <tr>
                  <td>
                    <img src="profile2.jpg" />
                    <p>Rob Obama</p>
                  </td>
                  <td>15-11-2023</td>
                  <td><span class="status completed">Completed</span></td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="todo">
            <div class="head">
              <h3>Todos</h3>
              <i class="bx bx-plus"></i>
            </div>
            <ul class="todo-list">
              <li class="completed">
                <p>Todo List</p>
                <i class="bx bx-dots-vertical-rounded"></i>
              </li>
              <li class="completed">
                <p>Todo List</p>
                <i class="bx bx-dots-vertical-rounded"></i>
              </li>
              <li class="not-completed">
                <p>Todo List</p>
                <i class="bx bx-dots-vertical-rounded"></i>
              </li>
              <li class="completed">
                <p>Todo List</p>
                <i class="bx bx-dots-vertical-rounded"></i>
              </li>
              <li class="not-completed">
                <p>Todo List</p>
                <i class="bx bx-dots-vertical-rounded"></i>
              </li>
            </ul>
          </div>
        </div>
      </main>
      <!-- MAIN -->
    </section>
    <!-- CONTENT -->

    <!-- footer -->
    <div class="footer">
      <p>Made with Love by <a href="#">Zeina_Batoul_Mariam_Zeina </a> <span id="date"></span></p>
    </div>
    <!-- End of footer -->

    <script src="dashboard.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  </body>
</html>