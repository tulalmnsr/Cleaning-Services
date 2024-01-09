const allSideMenu = document.querySelectorAll('#sidebar .side-menu.top li a');
const sidebar = document.getElementById('sidebar');

allSideMenu.forEach((item) => {
  const li = item.parentElement;

  item.addEventListener('click', function () {
    // Close the sidebar if the clicked item is already active
    if (li.classList.contains('active')) {
      sidebar.classList.remove('active');
      li.classList.remove('active');
    } else {
      // Close all other active items and open the clicked one
      allSideMenu.forEach((i) => {
        i.parentElement.classList.remove('active');
      });
      li.classList.add('active');
    }
  });
});

document.addEventListener('DOMContentLoaded', function () {
  const sidebarToggle = document.getElementById('sidebarToggle');

  sidebarToggle.addEventListener('click', function () {
    sidebar.classList.toggle('active');
  });
});

//Date Set up

const date = (document.getElementById('date').innerHTML =
  new Date().getFullYear())

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

const switchMode = document.getElementById('switch-mode')

switchMode.addEventListener('change', function () {
  if (this.checked) {
    document.body.classList.add('dark')
  } else {
    document.body.classList.remove('dark')
  }
})
$(document).ready(function() {
  // Count numbers in the page
  function countNumbers() {
    var numbers = document.body.innerText.match(/\d+/g);
    return numbers ? numbers.length : 0;
  }

  // Update the count in the page
  function updateCount() {
    var count = countNumbers();
    $('#numbers-count').text(count);
  }

 // Download the page as PDF
 function downloadPDF() {
  var element = document.body; // Capture the entire document


  var options = {
    margin: 10,
    filename: 'dashboard.pdf',
    image: { type: 'jpeg', quality: 0.98 },
    html2canvas: { scale: 2 },
    jsPDF: { unit: 'mm', format: 'a4', orientation: 'portrait' }
  };

  html2pdf(element, options).then(function () {
    alert('PDF Downloaded successfully');
  }).catch(function (error) {
    console.error('Error generating PDF:', error);
  });
}  function highlightSearch(text) {
  var bodyText = document.body.innerHTML;
  var highlightedText = bodyText.replace(new RegExp(text, 'gi'), '<span class="highlight">' + text + '</span>');

  // Create a wrapper element
  var wrapper = document.createElement('div');
  wrapper.innerHTML = highlightedText;

  // Replace the body content with the wrapper content
  document.body.innerHTML = wrapper.innerHTML;
}

// Handle search form submission
document.getElementById('search-form').addEventListener('submit', function(event) {
  event.preventDefault();
  var searchText = document.getElementById('search-input').value;
  highlightSearch(searchText);
});

document.getElementById('search-btn').addEventListener('click', function() {
  var searchText = document.getElementById('search-input').value;
  highlightSearch(searchText);
});
  // Initial count update
  updateCount();

  // Attach events to buttons
  $('#download-btn').click(downloadPDF);
 
});
function highlightSearch(text) {
  var bodyText = document.getElementById('order-table').innerHTML;
  var highlightedText = bodyText.replace(new RegExp(text, 'gi'), '<span class="highlight">' + text + '</span>');
  document.getElementById('order-table').innerHTML = highlightedText;
}

// Handle search icon click
document.getElementById('search-icon').addEventListener('click', function() {
  var searchText = prompt('Enter text to search:');
  if (searchText !== null) {
    highlightSearch(searchText);
  }
});

$(document).ready(function () {
  // Handle filter icon click
  $('#filter-icon').click(function () {
    // Display a dropdown or modal for selecting the status
    // For simplicity, I'll use an alert as an example
    var selectedStatus = prompt('Enter status to filter (completed, pending, process):').toLowerCase();

    // Filter the rows based on the selected status
    if (selectedStatus === 'completed' || selectedStatus === 'pending' || selectedStatus === 'process') {
      // Show all rows initially
      $('#order-table tbody tr').show();

      // Hide rows that don't match the selected status
      $('#order-table tbody tr').filter(function () {
        return $(this).find('.status').text().toLowerCase() !== selectedStatus;
      }).hide();
    } else {
      alert('Invalid status. Please enter completed, pending, or process.');
    }
  });
});
document.addEventListener('DOMContentLoaded', function () {
  // Function to add a new todo
  function addTodo() {
    // Prompt for user input
    var todoText = prompt('Enter the todo text:');
    var priority = prompt('Enter the priority (completed or not-completed):');

    // Validate priority
    if (priority !== 'completed' && priority !== 'not-completed') {
      alert('Invalid priority. Please enter "completed" or "not-completed".');
      return;
    }

    var todoList = document.querySelector('.todo-list');
    var newTodo = document.createElement('li');

    // Set text content and class based on priority
    newTodo.innerHTML = '<p>' + todoText + '</p><i class="bx bx-dots-vertical-rounded"></i>';
    newTodo.classList.add(priority);

    todoList.appendChild(newTodo);
  }

  // Event listener for the plus icon (add new todo)
  document.querySelector('.bx-plus').addEventListener('click', addTodo);
 
  
  });

document.addEventListener('DOMContentLoaded', function () {
  // ... (your existing code)

  // Event listener for the dots icon
  document.querySelectorAll('.bx-dots-vertical-rounded').forEach(function (dotsIcon) {
      dotsIcon.addEventListener('click', function (event) {
          // Prevent the default behavior of the dots icon (e.g., navigating to a link)
          event.preventDefault();

          // Show a menu with options (Edit, Delete, Mark as Complete, Mark as Not Completed)
          var selectedOption = prompt('Choose an option:\n1. Edit\n2. Delete\n3. Mark as Complete\n4. Mark as Not Completed');

          // Process the selected option
          if (selectedOption) {
              switch (selectedOption.trim()) {
                  case '1':
                      // Edit selected
                      var newText = prompt('Enter the new text for the todo:');
                      if (newText !== null) {
                          var todoItem = dotsIcon.closest('li');
                          todoItem.querySelector('p').textContent = newText;
                      }
                      break;
                  case '2':
                      // Delete selected
                      var confirmation = confirm('Are you sure you want to delete this todo?');
                      if (confirmation) {
                          var todoItem = dotsIcon.closest('li');
                          todoItem.remove();
                      }
                      break;
                  case '3':
                      // Mark as Complete selected
                      var todoItem = dotsIcon.closest('li');
                      todoItem.classList.add('completed');
                      break;
                  case '4':
                      // Mark as Not Completed selected
                      var todoItem = dotsIcon.closest('li');
                      todoItem.classList.remove('completed');
                      break;
                  default:
                      alert('Invalid option');
                      break;
              }
          }
      });
  });
});


  $(document).ready(function () {
    // Fetch and display notifications when the page loads
    fetchNotifications();

    $(".notification").click(function () {
      $("#notificationMenu").toggleClass("show");
      // Fetch and display notifications when the bell icon is clicked
      fetchNotifications();
    });

    // Close notification menu if clicked outside
    $(document).on("click", function (event) {
      if (!$(event.target).closest(".notification").length) {
        $("#notificationMenu").removeClass("show");
      }
    });

    // Function to fetch notifications from the server
    function fetchNotifications() {
      $.ajax({
        url: "get_notifications.php",
        method: "GET",
        success: function (data) {
          $("#notificationMenu").html(data); // Update the notification menu with received data
        },
        error: function (error) {
          console.log(error);
        }
      });
    }
  });

=======
document.addEventListener('DOMContentLoaded', function () {
  var notificationCount = 0;

  // Function to update the notification count
  function updateNotificationCount() {
    var notificationBadge = document.querySelector('.notification .num');
    notificationBadge.textContent = notificationCount;

    // Show/hide the badge based on the count
    if (notificationCount > 0) {
      notificationBadge.style.display = 'block';
    } else {
      notificationBadge.style.display = 'none';
    }
  }

  // Function to add a new notification
  function addNotification(message) {
    var notificationMenu = document.getElementById('notificationMenu');

    // Create a new notification element
    var notificationElement = document.createElement('p');
    notificationElement.textContent = message;

    // Add the notification to the menu
    notificationMenu.appendChild(notificationElement);

    // Increment the notification count
    notificationCount++;

    // Update the notification count in the UI
    updateNotificationCount();
  }

  // Function to toggle the notification menu visibility
  function toggleNotificationMenu() {
    var notificationMenu = document.getElementById('notificationMenu');
    notificationMenu.style.display = notificationMenu.style.display === 'block' ? 'none' : 'block';
  }

  // Clear all notifications
  function clearNotifications() {
    var notificationMenu = document.getElementById('notificationMenu');
    notificationMenu.innerHTML = ''; // Clear the content
    notificationCount = 0; // Reset the count
    updateNotificationCount(); // Update the count in the UI
  }

  // Event listener for the notification icon click
  document.querySelector('.notification i').addEventListener('click', function () {
    toggleNotificationMenu();
  });

  // Simulate receiving a new notification
  setTimeout(function () {
    addNotification('New user registered.');
  }, 2000);

  // Simulate receiving another notification
  setTimeout(function () {
    addNotification('New appointment scheduled.');
  }, 4000);

  // Simulate receiving another notification
  setTimeout(function () {
    addNotification('New message received.');
  }, 6000);

  // Event listener for clearing notifications
  document.getElementById('clearNotifications').addEventListener('click', function () {
    clearNotifications();
  });
});

