function editProfile() {
    // Redirect to editProfile.html
    window.location.href = 'editProfile.html';
}
function toggleMode() {
    const body = document.body;
    body.classList.toggle('dark-mode');

    // Save the mode preference to localStorage
    const isDarkMode = body.classList.contains('dark-mode');
    localStorage.setItem('darkMode', isDarkMode);
}

// Check for the user's preferred mode from localStorage
const isDarkMode = localStorage.getItem('darkMode') === 'true';
if (isDarkMode) {
    document.body.classList.add('dark-mode');
}