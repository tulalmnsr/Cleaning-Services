function toggleMenu() {
    const menu = document.querySelector('.navbar-two ul');
    menu.classList.toggle('show');
  }
  const sections = document.querySelectorAll('section');
  
  $(document).ready(function () {
  $('.count').each(function () {
  $(this).prop('Counter', 0).animate({
    Counter: $(this).text()
  }, {
    duration: 1500,
    easing: 'swing',
    step: function (now) {
      $(this).text(Math.ceil(now));
    }
  });
  });
  });
  let review = document.querySelector('#review'),
      //dots = Array.prototype.slice.call(document.getElementById('review-dots').children),
      //reviewContent = Array.prototype.slice.call(document.getElementById('review-content').children),
      dots = document.querySelectorAll('#review-dots li'),
      reviewContent = document.querySelectorAll('#review-content .review-box'),
      leftArrow = document.querySelector('#left-arrow'),
      rightArrow = document.querySelector('#right-arrow'),
      reviewSpeed = 4500,
      currentSlide = 0,
      currentActive = 0,
      reviewTimer;
  
      window.onload = function () {
        function playSlide(slide) {
            for (let i = 0; i < dots.length; i++) {
                reviewContent[i].classList.remove('active');
                reviewContent[i].classList.remove('inactive');
                dots[i].classList.remove('active');
            }
            if (slide < 0) {
                slide = currentSlide = reviewContent.length - 1;
            }
            if (slide > reviewContent.length - 1) {
                slide = currentSlide = 0;
            }
            if (currentActive != currentSlide) {
                reviewContent[currentActive].classList.add("inactive");
            }
            reviewContent[slide].classList.add("active");
            dots[slide].classList.add("active");
            currentActive = currentSlide;
    
            clearTimeout(reviewTimer);
            reviewTimer = setTimeout(function () {
                playSlide(currentSlide += 1);
            }, reviewSpeed)
        }
        leftArrow.addEventListener("click", () => {
            playSlide(currentSlide -= 1);
        })
        rightArrow.addEventListener("click", () => {
            playSlide(currentSlide += 1);
        })
        for (let j = 0; j < dots.length; j++) {
            dots[j].addEventListener("click", () => {
                playSlide(currentSlide = dots.indexOf(this));
            })
        }
        playSlide(currentSlide);
    }
    
    
  const navLi = document.querySelectorAll('nav ul li a');
  const sect = document.querySelectorAll('section');
  
  window.addEventListener('scroll', () => {
      let current = '';
      sections.forEach(section => {
          let sectionTop = section.offsetTop;
          if (scrollY >= sectionTop - 200) {
              current = section.getAttribute('id');
          }
          if (current === 'about') {
              document.querySelector('.like .fa-thumbs-up').classList.add('active');
          } else {
              document.querySelector('.like .fa-thumbs-up').classList.remove('active');
          }
      });
      navLi.forEach(li => {
          li.classList.remove('active');
          document.querySelector('nav ul li a[href*=' + current + ']').classList.add('active');
      });

  });
  $(document).ready(function() {
    // Load initial chat messages
    fetchChatMessages();

    // Submitting the message form
    $("#message-form").submit(function(e) {
        e.preventDefault();
        sendMessage($("#message").val());
    });

    // Function to fetch chat messages
    function fetchChatMessages() {
        $.ajax({
            url: "get_messages.php",
            type: "GET",
            success: function(data) {
                $("#chat-box").html(data);
            }
        });
    }

    // Function to send a message
    function sendMessage(message) {
        $.ajax({
            url: "send_message.php",
            type: "POST",
            data: { message: message },
            success: function() {
                $("#message").val(""); // Clear the input field
                fetchChatMessages(); // Refresh chat messages
            }
        });
    }

    // Refresh chat messages every 3 seconds (adjust as needed)
    setInterval(fetchChatMessages, 3000);
});

