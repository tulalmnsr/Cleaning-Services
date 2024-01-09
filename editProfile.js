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
