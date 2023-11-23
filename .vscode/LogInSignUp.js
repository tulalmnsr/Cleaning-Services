function myMenuFunction() {
    var i = document.getElementById("navMenu");
    if (i.className === "nav-menu") {
        i.className += " responsive";
    } else {
        i.className = "nav-menu";
    }
}

var a = document.getElementById("loginBtn");
var b = document.getElementById("registerBtn");
var x = document.getElementById("login");
var y = document.getElementById("register");
var z = document.getElementById("forgotPassword");  // Adding forgotPassword element

function login() {
    x.style.left = "4px";
    y.style.right = "-520px";
    a.className += " white-btn";
    b.className = "btn";
    x.style.opacity = 1;
    y.style.opacity = 0;
    z.style.opacity = 0;  // Hide forgot password form on login
}

function register() {
    x.style.left = "-510px";
    y.style.right = "5px";
    a.className = "btn";
    b.className += " white-btn";
    x.style.opacity = 0;
    y.style.opacity = 1;
    z.style.opacity = 0;  // Hide forgot password form on registration
}


function validateForgotPassword() {
    var userEmail = document.getElementById("forgotEmail").value;

    if (userEmail.trim() === '') {
        alert('Please enter your email address.');
        return false;
    }

    // You can add more specific validation checks for the email format

    return true;
}

function sendVerificationCode() {
    // Add code to send a verification code via email
    // You can use AJAX to communicate with your server for this functionality
    var userEmail = document.getElementById("forgotEmail").value;

    // Add code to send an email with a verification code to the user's email address
    // This can be done using a server-side script (e.g., Node.js, PHP) to send emails

    alert("Verification code sent to " + userEmail);
}
function loginSubmit() {
    if (validateLogin()) {
        // Your existing login code here
        x.style.left = "4px";
        y.style.right = "-520px";
        a.className += " white-btn";
        b.className = "btn";
        x.style.opacity = 1;
        y.style.opacity = 0;
    }

    // Prevent the default form submission
    return false;
}

function registerSubmit() {
    if (validateRegister()) {
        // Your existing registration code here
        x.style.left = "-510px";
        y.style.right = "5px";
        a.className = "btn";
        b.className += " white-btn";
        x.style.opacity = 0;
        y.style.opacity = 1;
    }

    // Prevent the default form submission
    return false;
}
function validateEmail(email) {
    // Use a regular expression for basic email validation
    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
}

function validatePassword(password) {
    // Validate password (at least 8 characters, at least one uppercase letter, one lowercase letter, and one number)
    var passwordRegex = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$/;
    if (!passwordRegex.test(password)) {
        alert('Password must be at least 8 characters long and include at least one uppercase letter, one lowercase letter, and one number.');
        return false;
    }
    return true;
}


function validateFirstName(firstName) {
    // Add your first name validation logic here
    // For example, you might require a minimum length or specific characters
    return firstName.trim() !== '';
}

function validateLastName(lastName) {
    // Add your last name validation logic here
    // For example, you might require a minimum length or specific characters
    return lastName.trim() !== '';
}

function validateLogin() {
    var username = document.getElementById("loginUsername").value;
    var password = document.getElementById("loginPassword").value;

    if (username.trim() === '' || password.trim() === '') {
        alert('Please enter both username/email and password.');
        return false;
    }

    // Additional validation for email and password
    if (!validateEmail(username)) {
        alert('Please enter a valid email address.');
        return false;
    }

    if (!validatePassword(password)) {
        alert('Please enter a password with at least 6 characters.');
        return false;
    }

    return true;
}

function validateRegister() {
    var firstname = document.getElementById("registerFirstname").value;
    var lastname = document.getElementById("registerLastname").value;
    var email = document.getElementById("registerEmail").value;
    var password = document.getElementById("registerPassword").value;

    // Check if any field is empty
    if (firstname.trim() === '' || lastname.trim() === '' || email.trim() === '' || password.trim() === '') {
        alert('Please fill in all the fields.');
        return false;
    }

    // Validate email format
    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email)) {
        alert('Please enter a valid email address.');
        return false;
    }

    // Validate password (at least 8 characters, at least one uppercase letter, one lowercase letter, and one number)
    var passwordRegex = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$/;
    if (!passwordRegex.test(password)) {
        alert('Password must be at least 8 characters long and include at least one uppercase letter, one lowercase letter, and one number.');
        return false;
    }

    // Validate first name and last name (only letters and spaces allowed)
    var nameRegex = /^[A-Za-z\s]+$/;
    if (!nameRegex.test(firstname) || !nameRegex.test(lastname)) {
        alert('First name and last name should contain only letters and spaces.');
        return false;
    }

    return true;
    
}
