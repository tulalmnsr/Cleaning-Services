

<?php
session_start();

if (isset($_POST['forgot_password'])) {
    $email = $_POST['email'];

    // Assuming you have a database connection established
    $pdo = new PDO('mysql:host=localhost;dbname=project1', 'root', '');

    // Check if the email exists in the users table
    $check_email_query = "SELECT * FROM users WHERE email = ?";
    $check_email_stmt = $pdo->prepare($check_email_query);
    $check_email_stmt->execute([$email]);
    $user_data = $check_email_stmt->fetch(PDO::FETCH_ASSOC);

    if ($user_data) {
        // Generate a unique token
        $token = bin2hex(random_bytes(32));

        // Set an expiry timestamp (e.g., 1 hour from now)
        $expiry_timestamp = date('Y-m-d H:i:s', strtotime('+1 hour'));

        // Store the token in the forgot_password_tokens table
        $insert_token_query = "INSERT INTO forgot_password_tokens (user_id, token, expiry_timestamp) VALUES (?, ?, ?)";
        $insert_token_stmt = $pdo->prepare($insert_token_query);
        $insert_token_stmt->execute([$user_data['user_id'], $token, $expiry_timestamp]);

        // Redirect the user to the password reset form with the token
        header("Location: reset_password.php?token=$token");
        exit();
    } else {
        echo "Email not found in the system.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
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
            <a href="login.php"  >Log In</a>
        </div>
    </nav>
    <div class="container">
    <h2>Forgot Password</h2>
    <form method="post" action="">
        <label for="email">Email:</label>
        <input type="email" name="email" required>
        <button type="submit" name="forgot_password">Reset Password</button>
    </form>
</body>
</html>
