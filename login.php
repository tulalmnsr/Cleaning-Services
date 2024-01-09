<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "project1";

$your_connection = mysqli_connect($servername, $username, $password, $database);

if (!$your_connection) {
    die("Connection failed: " . mysqli_connect_error());
}

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $result = mysqli_query($your_connection, "SELECT * FROM users WHERE email='$email'");
    $row = mysqli_fetch_assoc($result);

    if ($row && password_verify($password, $row["password"])) {
        $_SESSION['user_id'] = $row['user_id'];
        echo "Login successful!<br>";
        header("Location: homePage.php");
        exit();
    } else {
        echo "Invalid email or password";
    }
}

mysqli_close($your_connection);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <style>
 body {
    margin: 0;
    padding: 0;
    background-image: url('background.jpg');
    background-size: cover;
    background-position: center;
    font-family: 'Arial', sans-serif;
    color: #000;
}

nav {
    background: linear-gradient(to right, #11bafc, #054863);
    color: #fff;
    padding: 10px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.logo {
    text-decoration: none;
    color: #fff;
    font-size: 1.5em;
    font-weight: bold;
    margin-left: 10px;
}

nav a {
    color: #fff;
    text-decoration: none;
    padding: 10px 15px;
    margin: 0 10px;
    border-radius: 5px;
    transition: background-color 0.3s ease;
}

nav a:hover,
nav a.active {
    background-color: #11bafc;
}

.container {
    max-width: 600px;
    margin: 50px auto;
    padding: 20px;
    background-color: rgba(255, 255, 255, 0.8);
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
    color: #054863;
    transition: transform 0.3s ease;
}

.container:hover {
    transform: translateY(-5px);
}

input,
button {
    width: 100%;
    margin-bottom: 10px;
    padding: 10px;
    box-sizing: border-box;
    transition: transform 0.3s ease;
}

input:hover,
button:hover {
    transform: translateY(-10px);
}

button {
    background: linear-gradient(to right, #11bafc, #054863);
    color: #fff;
    cursor: pointer;
}
.error-message {
            color: red;
            margin-top: 50px;
            text-align: center;
        }
    </style>
</head>
<body>
<nav>
        <a href="#" class="logo">UltraTidy</a>
        <div>
            <a href="register.php" >Sign Up</a>
            <a href="login.php" class="active" >Log In</a>
        </div>
    </nav>
    <div class="container">
    <h2>Login</h2>
    <form action="login.php" method="post">
        <!-- Your login form fields go here -->
        <input type="email" name="email" placeholder="Email" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <button type="submit" name="login">Log In</button>
    </form>
    <?php if (isset($login_error)): ?>
            <p class="error-message"><?php echo $login_error; ?></p>
        <?php endif; ?>
    <p>Don't have an account? <a href="register.php">Sign Up</a></p>
    <p><a href="forgotPassword.php">Forgot Password</a></p>
    </div>
</body>
</html>
