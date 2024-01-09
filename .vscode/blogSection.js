// JavaScript to handle the "Read More" button click
document.querySelectorAll('.blog-card').forEach(function(card) {
    const readMoreButton = card.querySelector('.read-more-button');
    const authorInfo = card.querySelector('.author-info');

    readMoreButton.addEventListener('click', function() {
        if (authorInfo.style.display === 'none' || authorInfo.style.display === '') {
            authorInfo.style.display = 'block';
        } else {
            authorInfo.style.display = 'none';
        }
    });
});