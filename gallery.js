function toggleMenu() {
    const menu = document.querySelector('.navbar-two ul');
    menu.classList.toggle('show');
}
document.addEventListener('DOMContentLoaded', function () {
    const menuBtn = document.querySelector('.menu-btn');
    const links = document.querySelector('.links');

    menuBtn.addEventListener('click', function () {
        links.classList.toggle('active');
    });

    // Close the menu when a link is clicked
    links.addEventListener('click', function () {
        links.classList.remove('active');
    });
});
document.addEventListener("DOMContentLoaded", function () {
    const slides = document.querySelectorAll(".slide");
    const content = document.querySelector(".slider-content");
    const navIcons = document.querySelectorAll(".nav-icon");
    let currentSlide = 0;

    function showSlide(index) {
        slides.forEach((slide) => (slide.style.display = "none"));
        slides[index].style.display = "block";
        updateContent(index);
    }

    function updateContent(index) {
        const contentText = [
            "Your trusted partner in professional cleaning services.",
            "Experience unparalleled cleanliness and hygiene with our dedicated team of cleaning experts.",
            "Elevate your living or working space with our top-notch cleaning services, delivering excellence in every detail.",
        ];

        content.querySelector("h2").textContent = "UltraTidy Cleaning Service Company";
        content.querySelector("p").textContent = contentText[index];
    }

    function nextSlide() {
        currentSlide = (currentSlide + 1) % slides.length;
        showSlide(currentSlide);
    }

    function prevSlide() {
        currentSlide = (currentSlide - 1 + slides.length) % slides.length;
        showSlide(currentSlide);
    }

    navIcons.forEach((icon, index) => {
        icon.addEventListener("click", () => showSlide(index));
    });

    showSlide(currentSlide);

    // Add auto-advance functionality
    const autoAdvanceInterval = 5000; // Adjust interval as needed (in milliseconds)
    setInterval(nextSlide, autoAdvanceInterval);
});