document.addEventListener('DOMContentLoaded', function() {
    // Toggle Q/A items
    const faqQuestions = document.querySelectorAll('.faq-question');
    const faqItems = document.querySelectorAll('.faq-item');

    faqQuestions.forEach(function(question) {
        question.addEventListener('click', function() {
            this.classList.toggle('active');
            const answer = this.nextElementSibling;
            const iconEl = this.querySelector('.icon');

            if (this.classList.contains('active')) {
                answer.style.maxHeight = answer.scrollHeight + 'px';
                answer.classList.add('active');
                if (iconEl) iconEl.textContent = '\u2212'; // minus
            } else {
                answer.style.maxHeight = '0px';
                answer.classList.remove('active');
                if (iconEl) iconEl.textContent = '+';
            }
        });
    });

    // Search functionality (supports both navbar and hero inputs if present)
    const navbarSearchInput = document.getElementById('searchInput');
    const heroSearchInput = document.getElementById('searchHeroInput');

    function filterFaq(searchTerm) {
        const term = (searchTerm || '').toLowerCase().trim();

        faqItems.forEach(function(item) {
            const questionText = item.querySelector('.faq-question span:first-child').textContent.toLowerCase();
            const answerText = item.querySelector('.faq-answer p').textContent.toLowerCase();
            const match = term === '' || questionText.includes(term) || answerText.includes(term);
            item.style.display = match ? 'block' : 'none';

            // Collapse when filtering to keep layout tidy
            if (!match) {
                const q = item.querySelector('.faq-question');
                const a = item.querySelector('.faq-answer');
                const icon = item.querySelector('.faq-question .icon');
                if (q && q.classList.contains('active')) q.classList.remove('active');
                if (a) a.style.maxHeight = '0px';
                if (a) a.classList.remove('active');
                if (icon) icon.textContent = '+';
            }
        });
    }

    if (heroSearchInput) {
        heroSearchInput.addEventListener('input', function() {
            filterFaq(this.value);
        });
    }

    if (navbarSearchInput && navbarSearchInput.closest('.faq-page-only')) {
        // If you ever scope a dedicated navbar input for FAQ, wire it too
        navbarSearchInput.addEventListener('input', function() {
            filterFaq(this.value);
        });
    }

    // Contact modal handlers
    const openBtn = document.getElementById('openContact');
    const closeBtn = document.getElementById('closeContact');
    const modal = document.getElementById('contactModal');
    if (openBtn && modal) {
        openBtn.addEventListener('click', function(e){ e.preventDefault(); modal.style.display = 'block'; document.body.style.overflow='hidden'; });
    }
    if (closeBtn && modal) {
        closeBtn.addEventListener('click', function(){ modal.style.display='none'; document.body.style.overflow='auto'; });
    }
    document.addEventListener('click', function(e){
        if (modal && e.target === modal.querySelector('.contact-modal-overlay')) { modal.style.display='none'; document.body.style.overflow='auto'; }
    });
    document.addEventListener('keydown', function(e){ if (e.key === 'Escape' && modal && modal.style.display==='block') { modal.style.display='none'; document.body.style.overflow='auto'; }});

    const popupForm = document.getElementById('contactPopupForm');
    if (popupForm) {
        popupForm.addEventListener('submit', function(e){
            e.preventDefault();
            const name = document.getElementById('mName').value.trim();
            const email = document.getElementById('mEmail').value.trim();
            const subject = document.getElementById('mSubject').value.trim();
            const message = document.getElementById('mMessage').value.trim();
            if (!name || !email || !subject || !message) { alert('Mohon lengkapi semua field.'); return; }
            const mailto = 'mailto:info@satuhati.org?subject=' + encodeURIComponent(subject) + '&body=' + encodeURIComponent('Nama: ' + name + '\nEmail: ' + email + '\n\n' + message);
            window.location.href = mailto;
            modal.style.display='none';
            document.body.style.overflow='auto';
        });
    }
});

