document.addEventListener('DOMContentLoaded', function () {
    const switchMode = document.getElementById('switch-mode');
    const searchButton = document.querySelector('#content nav form .form-input button');
    const searchButtonIcon = document.querySelector('#content nav form .form-input button .bx');
    const searchForm = document.querySelector('#content nav form');
    const menuBar = document.querySelector('#content nav .bx.bx-menu');
    const sidebar = document.getElementById('sidebar');
  
    switchMode.addEventListener('change', function () {
      if (this.checked) {
        document.body.classList.add('dark');
      } else {
        document.body.classList.remove('dark');
      }
    });
  
    searchButton.addEventListener('click', function (e) {
      e.preventDefault();
  
      if (window.innerWidth < 576) {
        searchForm.classList.toggle('show');
  
        if (searchForm.classList.contains('show')) {
          searchButtonIcon.classList.replace('bx-search', 'bx-x');
        } else {
          searchButtonIcon.classList.replace('bx-x', 'bx-search');
        }
      }
    });
  
    menuBar.addEventListener('click', function () {
      sidebar.classList.toggle('hide');
    });
  });
  document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('search-input');
    const searchBtn = document.getElementById('search-btn');
    const contentContainer = document.getElementById('content');
  
    searchBtn.addEventListener('click', function (e) {
      e.preventDefault();
      const searchTerm = searchInput.value.trim().toLowerCase();
  
      if (searchTerm === '') {
        return;
      }
  
      const elementsToHighlight = contentContainer.querySelectorAll('*');
  
      elementsToHighlight.forEach((element) => {
        const textContent = element.textContent.toLowerCase();
        if (textContent.includes(searchTerm)) {
          element.classList.add('highlight');
        } else {
          element.classList.remove('highlight');
        }
      });
  
      const highlightedElements = contentContainer.querySelectorAll('.highlight');
  
      if (highlightedElements.length === 0) {
        alert('No matching results found.');
      }
    });
  });
    // Initialize Socket.IO
const socket = io();

// Function to send a message
function sendMessage() {
  const message = $("#messageInput").val();

  // Emit a 'sendMessage' event to the server
  socket.emit('sendMessage', { message, sender: 'admin' });

  // Clear the input field
  $("#messageInput").val("");
}

// Function to display incoming messages
function displayIncomingMessage(data) {
  // Append the received message to the chat box
  $("#chatBox").append(`<p><strong>${data.sender}</strong>: ${data.message}</p>`);
}

// Listen for 'receiveMessage' event from the server
socket.on('receiveMessage', (data) => {
  // Display the incoming message
  displayIncomingMessage(data);
});

// Listen for 'notification' event from the server
socket.on('notification', (data) => {
  if (data.event === 'receiveMessage') {
    // Display the incoming message
    displayIncomingMessage(data.data);
  }
});
