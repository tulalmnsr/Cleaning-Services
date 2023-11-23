function toggleMenu() {
  const menu = document.querySelector('.navbar-two ul');
  menu.classList.toggle('show');
}

const sr = ScrollReveal({
  distance: '60px',
  duration: 2500,
  delay: 400,
  reset: true
})

sr.reveal('.banner-content, .newsletter, .blog-header', {delay: 200, origin: 'left'})
sr.reveal('.featured-left, .featured-right, .blog-card', {delay: 200, origin: 'top'})