// Function Untuk Password hide dan show 
document.addEventListener('DOMContentLoaded', function() {
    initializePasswordToggle();
    initializeCounters();
    initializeAboutReveal();
});


function initializePasswordToggle() {

    const passwordInputs = document.querySelectorAll('input[type="password"]');
    
    passwordInputs.forEach(input => {
 
        const container = document.createElement('div');
        container.className = 'password-toggle-container';
        
   
        input.parentNode.insertBefore(container, input);
        container.appendChild(input);
        

        const toggleBtn = document.createElement('button');
        toggleBtn.type = 'button';
        toggleBtn.className = 'password-toggle-btn';
        toggleBtn.innerHTML = 'Show';
        toggleBtn.title = 'Tampilkan Password';
        

        container.appendChild(toggleBtn);
        

        toggleBtn.addEventListener('click', function() {
            togglePassword(input, toggleBtn);
        });
    });
}

function initializeAboutReveal(){
    var targets = document.querySelectorAll('.reveal');
    if(targets.length === 0) return;
    if(!('IntersectionObserver' in window)){
        targets.forEach(function(el){ el.classList.add('is-visible'); });
        return;
    }
    var io = new IntersectionObserver(function(entries, obs){
        entries.forEach(function(entry){
            if(entry.isIntersecting){
                entry.target.classList.add('is-visible');
                obs.unobserve(entry.target);
            }
        });
    }, { threshold: 0.15, rootMargin: '0px 0px -10% 0px' });
    targets.forEach(function(el){ io.observe(el); });
}

function initializeCounters() {
    var counters = document.querySelectorAll('.counter');
    if (counters.length === 0) return;

    var formatNumber = function(num) {
        return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',');
    };

    var animate = function(el) {
        var target = parseInt(el.getAttribute('data-target') || '0', 10);
        var duration = 1600; 
        var start = 0;
        var startTime = null;

        var step = function(timestamp) {
            if (!startTime) startTime = timestamp;
            var progress = Math.min((timestamp - startTime) / duration, 1);
            var current = Math.floor(progress * (target - start) + start);
            el.textContent = formatNumber(current);
            if (progress < 1) {
                window.requestAnimationFrame(step);
            }
        };
        window.requestAnimationFrame(step);
    };

    if ('IntersectionObserver' in window) {
        var observer = new IntersectionObserver(function(entries, obs) {
            entries.forEach(function(entry) {
                if (entry.isIntersecting) {
                    animate(entry.target);
                    obs.unobserve(entry.target);
                }
            });
        }, { threshold: 0.2 });

        counters.forEach(function(el) { observer.observe(el); });
    } else {
        counters.forEach(function(el) { animate(el); });
    }
}

function togglePassword(input, button) {
    if (input.type === 'password') {

        input.type = 'text';
        button.innerHTML = 'Hide';
        button.title = 'Sembunyikan Password';
    } else {

        input.type = 'password';
        button.innerHTML = 'Show';
        button.title = 'Tampilkan Password';
    }
}

// Donation Modal Functions
function openDonationModal(category) {
    const modal = document.getElementById('donationModal');
    const modalTitle = document.getElementById('donationModalTitle');
    
    // Set title based on category
    const titles = {
        'pendidikan': 'Donasi untuk Pendidikan',
        'kesehatan': 'Donasi untuk Kesehatan',
        'pangan': 'Donasi untuk Pangan'
    };
    
    modalTitle.textContent = titles[category] || 'Donasi untuk Pendidikan';
    modal.style.display = 'block';
    document.body.style.overflow = 'hidden'; // Prevent background scrolling
}

function closeDonationModal() {
    const modal = document.getElementById('donationModal');
    modal.style.display = 'none';
    document.body.style.overflow = 'auto'; // Restore scrolling
}

// Close modal when clicking outside
document.addEventListener('click', function(event) {
    const modal = document.getElementById('donationModal');
    if (event.target === modal) {
        closeDonationModal();
    }
});

// Close modal with Escape key
document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape') {
        closeDonationModal();
    }
});

// Handle custom amount input
document.addEventListener('DOMContentLoaded', function() {
    const customAmountRadio = document.querySelector('input[value="custom"]');
    const customAmountInput = document.getElementById('customAmountInput');
    
    if (customAmountRadio && customAmountInput) {
        customAmountRadio.addEventListener('change', function() {
            if (this.checked) {
                customAmountInput.style.display = 'block';
            } else {
                customAmountInput.style.display = 'none';
            }
        });
    }
    
    // Handle form submission
    const donationForm = document.getElementById('donationForm');
    if (donationForm) {
        donationForm.addEventListener('submit', function(event) {
            event.preventDefault();
            
            // Get form data
            const formData = new FormData(this);
            const amount = formData.get('amount');
            const customAmount = formData.get('customAmount');
            const paymentMethod = formData.get('paymentMethod');
            const donorName = formData.get('donorName');
            const donorEmail = formData.get('donorEmail');
            
            // Validate form
            if (!amount || !paymentMethod || !donorName || !donorEmail) {
                alert('Mohon lengkapi semua field yang diperlukan.');
                return;
            }
            
            if (amount === 'custom' && (!customAmount || customAmount < 10000)) {
                alert('Nominal donasi minimal Rp 10.000.');
                return;
            }
            
            // Here you would typically send the data to your server
            console.log('Donation Data:', {
                amount: amount === 'custom' ? customAmount : amount,
                paymentMethod: paymentMethod,
                donorName: donorName,
                donorEmail: donorEmail
            });
            
            // For now, just show a success message
            alert('Terima kasih! Data donasi Anda telah berhasil dikirim.');
            closeDonationModal();
            this.reset();
        });
    }
});