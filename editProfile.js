
document.addEventListener("DOMContentLoaded", function () {
  var form = document.getElementById("editProfileForm");

  form.addEventListener("submit", function (e) {
      e.preventDefault();

      var xhr = new XMLHttpRequest();
      xhr.open("POST", "editProfile.php", true);
      xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

      xhr.onreadystatechange = function () {
          if (xhr.readyState == 4 && xhr.status == 200) {
              // Handle the response
              console.log(xhr.responseText);

              // Redirect to profileInfo.php after successful update
              window.location.href = 'profileInfo.php';
          }
      };

      // Get form data
      var formData = new FormData(form);

      // Send the request with the form data
      xhr.send(formData);
  });
});

// Image preview
document.getElementById('profileImage').addEventListener('change', function (e) {
  const preview = document.getElementById('previewImage');
  const file = e.target.files[0];

  if (file) {
      const reader = new FileReader();
      reader.onload = function (e) {
          preview.src = e.target.result;
      };
      reader.readAsDataURL(file);
  }
});

function showEditForm() {
  var form = document.querySelector('.social-edit-form');
  form.style.display = 'block';
}

document.addEventListener("DOMContentLoaded", function () {
  // Check for dark mode preference in local storage
  const prefersDarkMode = localStorage.getItem("dark-mode") === "true";
  if (prefersDarkMode) {
    container.classList.add("dark-mode");
  }


});

        // Image preview
        document.getElementById('profileImage').addEventListener('change', function (e) {
            const preview = document.getElementById('previewImage');
            const file = e.target.files[0];

            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    preview.src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });
        function showEditForm() {
            var form = document.querySelector('.social-edit-form');
            form.style.display = 'block';
        }
    
        // Function to save the edited social links
        function submit() {
            var moreInfo = document.getElementById('more-info-input').value;
            document.getElementById('more-info').textContent = moreInfo;
    
            // Contact
            var contactEmail = document.getElementById('contact-input').value;
            document.getElementById('contact-email').textContent = contactEmail;
            var facebookLink = document.getElementById('facebook-link').value;
            var googleLink = document.getElementById('google-link').value;
            var linkedinLink = document.getElementById('linkedin-link').value;
    
            // Update the href attribute of social icons
            document.getElementById('facebook-icon').href = facebookLink;
            document.getElementById('google-icon').href = googleLink;
            document.getElementById('linkedin-icon').href = linkedinLink;
    
            // Hide the edit form after saving
            document.querySelector('.social-edit-form').style.display = 'none';
               }
 
               document.addEventListener("DOMContentLoaded", function () {
                const modeToggle = document.querySelector(".mode-toggle");
                const container = document.querySelector(".container");
              
                modeToggle.addEventListener("click", function () {
                  container.classList.toggle("dark-mode");
                  const isDarkMode = container.classList.contains("dark-mode");
                  localStorage.setItem("dark-mode", isDarkMode);
              
                  // Toggle icon visibility based on mode
                  const moonIcon = document.querySelector(".fa-moon");
                  const sunIcon = document.querySelector(".fa-sun");
                  moonIcon.style.display = isDarkMode ? "inline-block" : "none";
                  sunIcon.style.display = isDarkMode ? "none" : "inline-block";
                });
              
                // Check for dark mode preference in local storage
                const prefersDarkMode = localStorage.getItem("dark-mode") === "true";
                if (prefersDarkMode) {
                  container.classList.add("dark-mode");
                }
              });

