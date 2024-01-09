<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "project1";

$your_connection = mysqli_connect($servername, $username, $password, $database);

if (!$your_connection) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['register'])) {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $age = $_POST['age'];
    $position = $_POST['position'];
    $address = $_POST['address'];
    $phone_number = $_POST['phone_number'];
    $gender = $_POST['gender'];

    $target_dir = "uploads/";
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0755, true);
    }

    $target_file = $target_dir . basename($_FILES["profile_image"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    $check = getimagesize($_FILES["profile_image"]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        echo "Error: File is not an image.<br>";
        $uploadOk = 0;
    }

    if ($_FILES["profile_image"]["error"] == UPLOAD_ERR_OK && $uploadOk) {
        if (move_uploaded_file($_FILES["profile_image"]["tmp_name"], $target_file)) {
            $profile_image_path = basename($_FILES["profile_image"]["name"]);
        } else {
            echo "Sorry, there was an error uploading your file.<br>";
            $profile_image_path = null;
        }
    } else {
        echo "Error: " . $_FILES["profile_image"]["error"] . "<br>";
        $profile_image_path = null;
    }

    $query = "INSERT INTO users (first_name, last_name, email, password, age, position, address, phone_number, gender, profile_image_path) 
              VALUES ('$first_name', '$last_name', '$email', '$password', '$age', '$position', '$address', '$phone_number', '$gender', '$profile_image_path')";

    try {
        $result = mysqli_query($your_connection, "SELECT * FROM users WHERE email='$email'");
        
        if (mysqli_num_rows($result) > 0) {
            echo "Error: This email is already registered.<br>";
        } else {
            if (mysqli_query($your_connection, $query)) {
                echo "Registration successful!<br>";
                // Redirect to the login page
                header("Location: login.php");
                exit();
            } else {
                echo "Error: " . $query . "<br>" . mysqli_error($your_connection);
            }
        }
    } catch (mysqli_sql_exception $e) {
        echo "Error: " . $e->getMessage() . "<br>";
    }
 // After successfully registering the user, insert a new notification
 $result = mysqli_query($your_connection, "SELECT * FROM users WHERE email='$email'");
    
 if (mysqli_num_rows($result) > 0) {
     echo "Error: This email is already registered.<br>";
 } else {
     if (mysqli_query($your_connection, $query)) {
         echo "Registration successful!<br>";

         // Get the user_id of the newly registered user
         $result = mysqli_query($your_connection, "SELECT user_id FROM users WHERE email='$email'");
         $row = mysqli_fetch_assoc($result);
         $user_id = $row['user_id'];

         // Insert a new notification
         $message = "New user registered.";
         $notification_type = "new_user";

         $notification_sql = "INSERT INTO notifications (user_id, message, notification_type) VALUES ($user_id, '$message', '$notification_type')";
         mysqli_query($your_connection, $notification_sql);

         // Redirect to the login page
         header("Location: login.php");
         exit();
     } else {
         echo "Error: " . $query . "<br>" . mysqli_error($your_connection);
     }
 }
 
 mysqli_close($your_connection);
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
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
            <a href="register.php" class="active">Sign Up</a>
            <a href="login.php" >Log In</a>
        </div>
    </nav>
    <div class="container">
    <h2>Sign Up</h2>
    <form action="register.php" method="post" enctype="multipart/form-data">
            <input type="text" name="first_name" placeholder="First Name" required><br>
            <input type="text" name="last_name" placeholder="Last Name" required><br>
            <input type="email" name="email" placeholder="Email" required><br>
            <input type="password" name="password" placeholder="Password" required><br>
            <input type="number" name="age" placeholder="Age" required><br>
            <input type="text" name="position" placeholder="Position" required><br>
            <input type="text" name="address" placeholder="Address" required><br>
            <input type="tel" name="phone_number" placeholder="Phone Number" required><br>
            <label for="gender">Gender:</label>
            <select name="gender">
                <option value="male">Male</option>
                <option value="female">Female</option>
            </select><br>
        <label for="profile_image">Profile Image:</label>
        <input type="file" name="profile_image" accept="image/*" required><br>
        <button type="submit" name="register">Sign Up</button>
    </form>
        <p>Already have an account? <a href="login.php">Log In</a></p>
    </div>
</body>
</html>
