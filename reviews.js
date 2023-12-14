document.addEventListener('DOMContentLoaded', function () {
    // Dummy data for demonstration
    const ratingsData = [
      { stars: 5, percentage: 84 },
      { stars: 4, percentage: 9 },
      { stars: 3, percentage: 4 },
      { stars: 2, percentage: 2 },
      { stars: 1, percentage: 1 },
    ];
  
    // Function to generate breakdown content
    function generateBreakdownContent() {
      const breakdownContainer = document.getElementById('reviews-breakdown');
      breakdownContainer.innerHTML = '';
  
      ratingsData.forEach((item) => {
        const starDiv = document.createElement('div');
        starDiv.classList.add('reviews__single-star-average');
  
        const amountDiv = document.createElement('div');
        amountDiv.classList.add('single-star-average__amount');
        amountDiv.textContent = `${item.stars} star`;
  
        const progressBarDiv = document.createElement('div');
        progressBarDiv.classList.add('single-star-average__progress-bar');
  
        const progressBar = document.createElement('progress');
        progressBar.classList.add('progress-bar__data');
        progressBar.max = 100;
        progressBar.value = item.percentage;
  
        const percentageDiv = document.createElement('div');
        percentageDiv.classList.add('single-star-average__percentage');
        percentageDiv.textContent = `${item.percentage}%`;
  
        progressBarDiv.appendChild(progressBar);
  
        starDiv.appendChild(amountDiv);
        starDiv.appendChild(progressBarDiv);
        starDiv.appendChild(percentageDiv);
  
        breakdownContainer.appendChild(starDiv);
      });
    }
  
    // Call the function to generate initial breakdown content
    generateBreakdownContent();
  });
  const switchMode = document.getElementById('switch-mode');

  switchMode.addEventListener('change', function () {
    if (this.checked) {
      document.body.classList.add('dark');
    } else {
      document.body.classList.remove('dark');
    }
  });
  // Function to delete a testimonial with confirmation alert
function deleteTestimonial(deleteIcon) {
  // Show a confirmation dialog
  var isConfirmed = confirm("Are you sure you want to delete this testimonial?");

  // Check if the user confirmed
  if (isConfirmed) {
    // Get the parent box of the testimonial
    var testimonialBox = deleteIcon.closest('.box');

    // Remove the testimonial box from the DOM
    testimonialBox.remove();
  }
}
// Function to navigate to testimonial page
function navigateToTestimonialPage(icon) {
  // Show a confirmation dialog
  var isConfirmed = confirm("Are you sure you want to navigate to the testimonial page?");

  // Check if the user confirmed
  if (isConfirmed) {
    // Implement the logic to navigate to the testimonial page here
    alert("Navigating to testimonial page...");
  }
}
function searchReviews() {
  // Get the search input value
  var searchTerm = document.getElementById("searchInput").value.toLowerCase();

  // Get all text content on the page
  var pageText = document.body.textContent.toLowerCase();

  // Check if the search term exists in the page text
  if (pageText.includes(searchTerm)) {
    // If the search term exists, highlight the matches with a yellow background
    var regex = new RegExp(searchTerm, "gi");
    document.body.innerHTML = document.body.innerHTML.replace(
      regex,
      (match) => `<span style="background-color: yellow">${match}</span>`
    );
  } else {
    // If the search term doesn't exist, show an alert
    alert("Word not found on the page!");
  }
}
document.addEventListener('DOMContentLoaded', function () {
  const sidebarToggle = document.getElementById('sidebarToggle');
  const sidebar = document.getElementById('sidebar');

  sidebarToggle.addEventListener('click', function () {
    sidebar.classList.toggle('active');
  });
});
// TOGGLE SIDEBAR
const menuBar = document.querySelector('#content nav .bx.bx-menu')
// ...
const otherSidebar = document.getElementById('sidebar');
// ...


menuBar.addEventListener('click', function () {
  sidebar.classList.toggle('hide')
})

const searchButton = document.querySelector(
  '#content nav form .form-input button'
)
const searchButtonIcon = document.querySelector(
  '#content nav form .form-input button .bx'
)
const searchForm = document.querySelector('#content nav form')

searchButton.addEventListener('click', function (e) {
  if (window.innerWidth < 576) {
    e.preventDefault()
    searchForm.classList.toggle('show')
    if (searchForm.classList.contains('show')) {
      searchButtonIcon.classList.replace('bx-search', 'bx-x')
    } else {
      searchButtonIcon.classList.replace('bx-x', 'bx-search')
    }
  }
})

if (window.innerWidth < 768) {
  sidebar.classList.add('hide')
} else if (window.innerWidth > 576) {
  searchButtonIcon.classList.replace('bx-x', 'bx-search')
  searchForm.classList.remove('show')
}

window.addEventListener('resize', function () {
  if (this.innerWidth > 576) {
    searchButtonIcon.classList.replace('bx-x', 'bx-search')
    searchForm.classList.remove('show')
  }
})

  


















