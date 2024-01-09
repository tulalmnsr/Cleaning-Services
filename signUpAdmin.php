<?php
// XAMPP default database connection settings
$servername = "localhost";
$username = "root";
$password = "";
$database = "project1";

// Create connection
$your_connection = mysqli_connect($servername, $username, $password, $database);

// Check connection
if (!$your_connection) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Extract form data
    $username = $_POST["username"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT); // Hash the password
    $full_name = $_POST["full_name"];
    $age = $_POST["age"];
    $occupation = $_POST["occupation"];
    $work = $_POST["work"];
    $gender = $_POST["gender"];
    $country = $_POST["country"];
    $contact_email = $_POST["contact_email"];
    $facebook_url = $_POST["facebook_url"];
    $google_url = $_POST["google_url"];
    $linkedin_url = $_POST["linkedin_url"];
    $two_factor_authentication = isset($_POST["two_factor_authentication"]) ? 1 : 0;
    $sms_number = $_POST["sms_number"];

   
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["profile_image"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    echo "Target File: " . $target_file . "<br>";
    echo "File Type: " . $imageFileType . "<br>";

    $check = getimagesize($_FILES["profile_image"]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        echo "Error: File is not an image.<br>";
        $uploadOk = 0;
    }

    if ($_FILES["profile_image"]["error"] == UPLOAD_ERR_OK) {
        echo "File exists: " . $_FILES["profile_image"]["tmp_name"] . "<br>";

        if (move_uploaded_file($_FILES["profile_image"]["tmp_name"], $target_file)) {
            $profile_image_path = basename($_FILES["profile_image"]["name"]);
            echo "The file " . $profile_image_path . " has been uploaded.<br>";
        } else {
            echo "Sorry, there was an error uploading your file.<br>";
            $profile_image_path = null;
        }
    } else {
        echo "Error: " . $_FILES["profile_image"]["error"] . "<br>";
        $profile_image_path = null;
    }

    // Insert user data into the database
    $sql = "INSERT INTO admin (username, password, full_name, age, occupation, work, gender, country, contact_email, facebook_url, google_url, linkedin_url, two_factor_authentication, sms_number, profile_image_path) 
            VALUES ('$username', '$password', '$full_name', $age, '$occupation', '$work', '$gender', '$country', '$contact_email', '$facebook_url', '$google_url', '$linkedin_url', $two_factor_authentication, '$sms_number', '$profile_image_path')";

    // Handle duplicate entry error
    try {
        $result = mysqli_query($your_connection, "SELECT * FROM admin WHERE contact_email='$contact_email'");
        
        if (mysqli_num_rows($result) > 0) {
            echo "Error: This email is already registered.<br>";
        } else {
            if (mysqli_query($your_connection, $sql)) {
                echo "Registration successful!<br>";
                // Redirect to the login page
                header("Location: loginAdmin.php");
                exit();
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($your_connection);
            }
        }
    } catch (mysqli_sql_exception $e) {
        echo "Error: " . $e->getMessage() . "<br>";
    }

    // Close the database connection
    mysqli_close($your_connection);
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
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

        input,
        select,
        button {
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
    </style>
</head>
<body>
    <nav>
        <a href="#" class="logo">UltraTidy</a>
        <div>
            <a href="signUpAdmin.php" class="active">Sign Up</a>
            <a href="loginAdmin.php">Log In</a>
        </div>
    </nav>

    <div class="container">
        <h2>Sign Up</h2>
        <form action="signUpAdmin.php" method="post" enctype="multipart/form-data">
            <!-- Your form fields go here -->
            <input type="text" name="username" placeholder="Username" required><br>
            <input type="password" name="password" placeholder="Password" required><br>
            <input type="text" name="full_name" placeholder="Full Name" required><br>
            <input type="number" name="age" placeholder="Age" required><br>
            <input type="text" name="occupation" placeholder="Occupation" required><br>
            <input type="text" name="work" placeholder="Work" required><br>
            <input type="text" name="gender" placeholder="Gender" required><br>
            <input type="text" name="country" placeholder="Country" required><br>
            <input type="email" name="contact_email" placeholder="Email" required><br>
            <input type="text" name="facebook_url" placeholder="Facebook URL" required><br>
            <input type="text" name="google_url" placeholder="Google URL" required><br>
            <input type="text" name="linkedin_url" placeholder="LinkedIn URL" required><br>
            <label for="two_factor_authentication">Two-Factor Authentication:</label>
            <input type="checkbox" name="two_factor_authentication"><br>
            <input type="text" name="sms_number" placeholder="SMS Number" required><br>
            <label for="profile_image">Profile Image:</label>
            <input type="file" name="profile_image" accept="image/*" required><br>
            <button type="submit">Sign Up</button>
        </form>
        <p>Already have an account? <a href="loginAdmin.php">Log In</a></p>
    </div>
</body>
</html>

