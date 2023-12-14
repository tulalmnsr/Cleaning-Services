const socket = io(); // You need a running Socket.IO server

function appendMessage(message, sender) {
    const chatBox = document.getElementById('chatBox');
    const messageDiv = document.createElement('div');
    messageDiv.innerHTML = `<strong>${sender || 'You'}:</strong> ${message}`;
    chatBox.appendChild(messageDiv);
    chatBox.scrollTop = chatBox.scrollHeight;
}

function sendMessage() {
    const messageInput = document.getElementById('messageInput');
    const message = messageInput.value.trim();

    if (message !== '') {
        appendMessage(message, 'You');
        socket.emit('chat message', message);
        messageInput.value = '';
    }
}

socket.on('chat message', (msg) => {
    appendMessage(msg, 'User');
});

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

// ...

// ...


menuBar.addEventListener('click', function () {
  sidebar.classList.toggle('hide')
})


const switchMode = document.getElementById('switch-mode');

switchMode.addEventListener('change', function () {
  if (this.checked) {
    document.body.classList.add('dark');
  } else {
    document.body.classList.remove('dark');
  }
});
const searchButton = document.querySelector('#content nav form .form-input button');
const searchButtonIcon = document.querySelector('#content nav form .form-input button .bx');
const searchForm = document.querySelector('#content nav form');

searchButton.addEventListener('click', function (e) {
  e.preventDefault(); // Prevent the default form submission behavior

  if (window.innerWidth < 576) {
    searchForm.classList.toggle('show');

    if (searchForm.classList.contains('show')) {
      searchButtonIcon.classList.replace('bx-search', 'bx-x');
    } else {
      searchButtonIcon.classList.replace('bx-x', 'bx-search');
    }
  }
});

const menuBar = document.querySelector('#content nav .bx.bx-menu');
const otherSidebar = document.getElementById('sidebar');

menuBar.addEventListener('click', function () {
  sidebar.classList.toggle('hide');
});
