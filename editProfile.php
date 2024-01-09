<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link rel="stylesheet" href="editProfile.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
   
    <div class="container">
        <a href="homePage.html" class="home-icon">
            <i class="fas fa-home"></i>
        </a>

        <button class="icon mode-toggle" onclick="toggleMode()">
            <i class="fas fa-sun"></i>
            <i class="fas fa-moon"></i>
        </button>
        
        <a href="login.html" class="icon sign-out-icon">
            <i class="fas fa-sign-out-alt"></i>
        </a>
        <!-- Image Upload Section -->
        <div class="image-upload">
            <input type="file" id="profileImage" accept="image/*">
            <label for="profileImage">
                <i class="fa fa-pencil"></i> Edit
            </label>
            <img src="profile1.jpg" alt="Profile Image" id="previewImage">
        </div>

        <!-- Edit Profile Form -->
        <h1>Edit Profile</h1>
        <!-- Change the form tag to include method, action, and enctype attributes -->
        <form method="post" action="updateProfile.php" enctype="multipart/form-data">
            <label for="fullName">Full Name</label>
            <input type="text" id="fullName" name="fullName" placeholder="Jane Jims Miss" required>

            <label for="age">Age</label>
            <input type="number" id="age" name="age" placeholder="35" required>

            <label for="occupation">Occupation</label>
            <input type="text" id="occupation" name="occupation" placeholder="Administrator" required>
            
            <label for="work-input">Work:</label>
            <input type="text" id="work-input" placeholder="Enter Work">
        
            <label for="gender">Gender:</label>
            <select id="gender" name="gender">
                <option value="">__Select__</option>
                <option value="male">Male</option>
                <option value="female">Female</option>
            </select>

            <label for="country">Country:</label>
            <input type="text" id="country" name="country" placeholder="Lebanon">

           <!-- Editable Contact Section -->
           <div class="contact-editable">
              <label for="contact-input">Contact:</label>
              <input type="text" id="contact-input" name="contact" placeholder="example@gmail.com">
            </div>

            <div class="edit-icon" onclick="showEditForm()">
                <i class="fas fa-edit"></i>
            </div>
            
            <!-- Social Links Edit Form -->
            <div class="social-edit-form" style="display: none;">
                <label for="facebook-link">Facebook:</label>
                <input type="text" id="facebook-link" name="facebookLink" placeholder="Enter Facebook URL">
            
                <label for="google-link">Google:</label>
                <input type="text" id="google-link" name="googleLink" placeholder="Enter Google URL">
            
                <label for="linkedin-link">LinkedIn:</label>
                <input type="text" id="linkedin-link" name="linkedinLink" placeholder="Enter LinkedIn URL">
            </div>
            <button type="submit">Save Changes</button>
        </form>
    </div>

    <script src="editProfile.js"></script>
</body>
</html>
