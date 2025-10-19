document.addEventListener('DOMContentLoaded', function() {
    // Get all FAQ questions
    const faqQuestions = document.querySelectorAll('.faq-question');
    
    // Add click event listener to each question
    faqQuestions.forEach(function(question) {
        question.addEventListener('click', function() {
            // Toggle active class on the clicked question
            this.classList.toggle('active');
            
            // Get the answer element (next sibling)
            const answer = this.nextElementSibling;
            
            // Check if the question is active
            if (this.classList.contains('active')) {
                // Set maxHeight to scrollHeight for smooth animation
                answer.style.maxHeight = answer.scrollHeight + 'px';
                answer.classList.add('active');
            } else {
                // Set maxHeight to 0 to close
                answer.style.maxHeight = '0px';
                answer.classList.remove('active');
            }
        });
    });

    // Search functionality
    const searchInput = document.getElementById('searchInput');
    const faqItems = document.querySelectorAll('.faq-item');
    
    searchInput.addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase();
        
        faqItems.forEach(function(item) {
            const questionText = item.querySelector('.faq-question span:first-child').textContent.toLowerCase();
            const answerText = item.querySelector('.faq-answer p').textContent.toLowerCase();
            
            if (questionText.includes(searchTerm) || answerText.includes(searchTerm)) {
                item.style.display = 'block';
            } else {
                item.style.display = 'none';
            }
        });
    });
});
