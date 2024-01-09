<?php
session_start();

if (!isset($_SESSION["user_id"])) {
    // Redirect to login page if not logged in
    header("Location: loginAdmin.php");
    exit();
}

$servername = "localhost";
$username = "root";
$password = "";
$database = "project1";

$your_connection = mysqli_connect($servername, $username, $password, $database);

if (!$your_connection) {
    die("Connection failed: " . mysqli_connect_error());
}

$user_id = $_SESSION["user_id"];

$result = mysqli_query($your_connection, "SELECT * FROM admin WHERE admin_id=$user_id");
$row = mysqli_fetch_assoc($result);

mysqli_close($your_connection);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="profileInfo.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <div class="container">
        <div class="box">
            <a href="homePage.html" class="home-link">
                <i class="fa fa-home"></i>
            </a>
            <img src="uploads/<?php echo $row['profile_image_path']; ?>" alt="Profile Image">
            <ul>
                <li><?php echo $row['full_name']; ?></li>
                <li><?php echo $row['age']; ?> years</li>
                <li><?php echo $row['occupation']; ?></li>
                <li>
                    <i style="font-size:24px" class="fa"></i>
                    <i style="font-size:24px" class="fa"></i>
                    <i style="font-size:24px" class="fa"></i>
                </li>
                <li>
                    <a href="editProfile.php">Edit Profile</a>
                    <div class="mode-toggle" onclick="toggleMode()">
                        <i class="fas fa-moon"></i> <!-- Dark mode icon -->
                        <i class="fas fa-sun"></i>  <!-- Light mode icon -->
                    </div>
                </li>
            </ul>
        </div>
        <div class="About">
            <ul>
                <h1>About</h1>
            </ul>
            <ul>
                <h3>Work:</h3>
                <li><?php echo $row['work']; ?></li>
            </ul>
            <ul>
                <h3>Gender:</h3>
                <li><?php echo $row['gender']; ?></li>
            </ul>
            <ul>
                <h3>Country:</h3>
                <li><?php echo $row['country']; ?></li>
            </ul>
            <ul>
                <h3>Contact:</h3>
                <li><?php echo $row['contact_email']; ?></li>
            </ul>
        </div>
        <a href="logoutPage.html" class="sign-out-link">
            <i class="fa fa-sign-out"></i> Sign Out
        </a>
    </div>
    
    <script src="profileInfo.js"></script>
</body>
</html>
