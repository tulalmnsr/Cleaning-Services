<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$database = "project1";

$your_connection = mysqli_connect($servername, $username, $password, $database);

if (!$your_connection) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM admin WHERE username='$username'";
    $result = mysqli_query($your_connection, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        if (password_verify($password, $row["password"])) {
            $_SESSION["user_id"] = $row["admin_id"];
            header("Location: dashboard.php");
            exit();
        } else {
            $login_error = "Invalid username or password";
        }
    } else {
        $login_error = "User not found";
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
            background-image: url('background-image.jpg'); /* Update the path */
            background-size: cover;
            background-position: center;
            font-family: 'Arial', sans-serif;
            color: #000;
        }

        nav {
            background-color: #333;
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
        }

        nav a:hover,
        nav a.active {
            background-color: #555;
        }

        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.8); /* Semi-transparent white background */
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        }

        input, button {
            width: 100%;
            margin-bottom: 10px;
            padding: 10px;
            box-sizing: border-box;
        }

        button {
            background-color: #333;
            color: #fff;
            cursor: pointer;
        }

        .error-message {
            color: red;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
<nav>
        <a href="#" class="logo">UltraTidy</a>
        <div>
            <a href="signUpAdmin.php">Sign Up</a>
            <a href="loginAdmin.php" class="active">Log In</a>
        </div>
    </nav>
    <div class="container">
        <h2>Login</h2>
        <form action="loginAdmin.php" method="post">
            <!-- Your login form fields go here -->
            <input type="text" name="username" placeholder="Username" required><br>
            <input type="password" name="password" placeholder="Password" required><br>
            <button type="submit">Log In</button>
        </form>
        <?php if (isset($login_error)): ?>
            <p class="error-message"><?php echo $login_error; ?></p>
        <?php endif; ?>
        <p>Don't have an account? <a href="signUpAdmin.php">Sign Up</a></p>
    </div>
</body>
</html>