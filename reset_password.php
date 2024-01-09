<?php
session_start();

if (isset($_POST['reset_password'])) {
    $token = $_GET['token'];
    $new_password = $_POST['new_password'];

    // Assuming you have a database connection established
    $pdo = new PDO('mysql:host=localhost;dbname=project1', 'root', '');

    // Check if the token is present in the forgot_password_tokens table
    $check_token_query = "SELECT * FROM forgot_password_tokens WHERE token = ?";
    $check_token_stmt = $pdo->prepare($check_token_query);
    $check_token_stmt->execute([$token]);
    $token_data = $check_token_stmt->fetch(PDO::FETCH_ASSOC);

    if ($token_data && $token_data['expiry_timestamp'] > date('Y-m-d H:i:s')) {
        // Token is valid, update the user's password
        $user_id = $token_data['user_id'];
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

        $update_query = "UPDATE users SET password = ? WHERE user_id = ?";
        $update_stmt = $pdo->prepare($update_query);
        $update_stmt->execute([$hashed_password, $user_id]);

        // Delete the used token
        $delete_query = "DELETE FROM forgot_password_tokens WHERE token = ?";
        $delete_stmt = $pdo->prepare($delete_query);
        $delete_stmt->execute([$token]);

        // Password reset successful, redirect to the login page
        header("Location: login.php");
        exit();
    } else {
        echo "Invalid or expired token.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
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
            margin-bottom: 10px;
            position: absolute;
            bottom: -30px; /* Adjust the value as needed for the desired gap */
            left: 50%;
            transform: translateX(-50%);
        }

    </style>
</head>
<body>
<nav>
        <a href="#" class="logo">UltraTidy</a>
        <div>
            <a href="register.php" >Sign Up</a>
            <a href="login.php" >Log In</a>
        </div>
    </nav>
    <div class="container">
    <h2>Reset Password</h2>
    <form method="post" action="">
        <label for="new_password">New Password:</label>
        <input type="password" name="new_password" required>
        <button type="submit" name="reset_password" >Reset Password</button>
    </form>
</body>
</html>
