// Function Untuk Password hide dan show 
document.addEventListener('DOMContentLoaded', function() {
    initializePasswordToggle();
    initializeCounters();
    initializeAboutReveal();
    initializeGlobalReveal();
    initializeSearch();
});

// Search functionality
function initializeSearch() {
    const searchInput = document.getElementById('searchInput');
    const searchResults = document.getElementById('searchResults');
    
    if (!searchInput || !searchResults) return;
    
    // Donation data - this would typically come from a database
    const donationData = [
        {
            id: 1,
            title: "Temani Perjuangan Mereka Hingga Sembuh: Donasi untuk Anak dengan Kanker",
            image: "image/gambar_anak7.jpg",
            category: "Kesehatan",
            progress: 37,
            amount: "Rp 32.000.000",
            donors: "846 Donatur"
        },
        {
            id: 2,
            title: "Leukemia Menguras Tenaganya, Dukungan Kita Mengisi Semangatnya",
            image: "image/leukimia-anak.jpg",
            category: "Kesehatan",
            progress: 45,
            amount: "Rp 46.000.000",
            donors: "601 Donatur"
        },
        {
            id: 3,
            title: "Kepala Kecil Ini Menanggung Beban Berat: Bantu Ia Lawan Hidrosefalus",
            image: "image/gambar_anak9.jpg",
            category: "Kesehatan",
            progress: 75,
            amount: "Rp 75.000.000",
            donors: "1,245 Donatur"
        },
        {
            id: 4,
            title: "Bantu Adik Ini Sembuh: Tumor di Wajahnya Butuh Uluran Tangan Kita",
            image: "image/gambar_anak6.webp",
            category: "Kesehatan",
            progress: 75,
            amount: "Rp 75.000.000",
            donors: "1,245 Donatur"
        },
        {
            id: 5,
            title: "Semangat Tak Berdinding: Bantu Mereka Belajar di Ruang yang Layak",
            image: "image/gambar_anak8.jpg",
            category: "Pendidikan",
            progress: 20,
            amount: "Rp 3.123.000",
            donors: "34 Donatur"
        },
        {
            id: 6,
            title: "Satu Donasi, Satu Nyawa: Lawan Krisis Gizi Buruk Sekarang",
            image: "image/anak_kurang_gizi.jpg",
            category: "Pangan",
            progress: 90,
            amount: "Rp 90.000.000",
            donors: "2,156 Donatur"
        }
    ];
    
    let searchTimeout;
    
    searchInput.addEventListener('input', function() {
        clearTimeout(searchTimeout);
        const query = this.value.trim();
        
        if (query.length < 2) {
            searchResults.classList.remove('show');
            return;
        }
        
        searchTimeout = setTimeout(() => {
            performSearch(query, donationData, searchResults);
        }, 300);
    });
    
    // Handle Enter key
    searchInput.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            const query = this.value.trim();
            const isDonationPage = window.location.pathname.includes('donasi.html');

            if (isDonationPage) {
                // On donation page: do not navigate, just ensure filtering occurs
                e.preventDefault();
                const event = new Event('input', { bubbles: true });
                this.dispatchEvent(event);
                return;
            }

            // On other pages: always navigate to donation page with query (even if no local results)
            e.preventDefault();
            const target = `donasi.html${query ? `?search=${encodeURIComponent(query)}` : ''}`;
            window.location.href = target;
        }
    });
    
    // Hide search results when clicking outside
    document.addEventListener('click', function(e) {
        if (!searchInput.contains(e.target) && !searchResults.contains(e.target)) {
            searchResults.classList.remove('show');
        }
    });
}

function performSearch(query, donationData, searchResults) {
    const filteredResults = donationData.filter(donation => 
        donation.title.toLowerCase().includes(query.toLowerCase()) ||
        donation.category.toLowerCase().includes(query.toLowerCase())
    );
    
    displaySearchResults(filteredResults, searchResults, query);
}

function displaySearchResults(results, container, query) {
    if (results.length === 0) {
        container.innerHTML = `
            <div class="search-no-results">
                Tidak ada donasi yang ditemukan untuk "${query}"
            </div>
        `;
    } else {
        container.innerHTML = results.map(donation => `
            <div class="search-result-item" onclick="selectDonation(${donation.id})">
                <img src="${donation.image}" alt="${donation.title}" class="search-result-image">
                <div class="search-result-content">
                    <div class="search-result-badge">${donation.category}</div>
                    <div class="search-result-title">${donation.title}</div>
                    <div class="search-result-progress">${donation.progress}% • ${donation.amount} • ${donation.donors}</div>
                </div>
            </div>
        `).join('');
    }
    
    container.classList.add('show');
}

function selectDonation(donationId) {
    // Navigate to donation page and scroll to specific donation
    window.location.href = `donasi.html?donation=${donationId}`;
}

// Handle URL parameters for donation page
function handleDonationPageParams() {
    const urlParams = new URLSearchParams(window.location.search);
    const donationId = urlParams.get('donation');
    const searchQuery = urlParams.get('search');
    
    if (donationId) {
        // Scroll to specific donation and highlight it
        const donationElement = document.getElementById(`donation-${donationId}`);
        if (donationElement) {
            donationElement.scrollIntoView({ behavior: 'smooth', block: 'center' });
            donationElement.style.border = '3px solid #0ea594';
            donationElement.style.borderRadius = '12px';
            donationElement.style.boxShadow = '0 8px 25px rgba(14, 165, 148, 0.3)';
            
            // Remove highlight after 5 seconds
            setTimeout(() => {
                donationElement.style.border = '';
                donationElement.style.borderRadius = '';
                donationElement.style.boxShadow = '';
            }, 5000);
        }
    }
    
    if (searchQuery) {
        // Pre-fill search input and show results
        const searchInput = document.getElementById('searchInput');
        if (searchInput) {
            searchInput.value = searchQuery;
            searchInput.focus();
            // Trigger search
            const event = new Event('input', { bubbles: true });
            searchInput.dispatchEvent(event);
        }
    }
}

// Initialize donation page functionality
document.addEventListener('DOMContentLoaded', function() {
    if (window.location.pathname.includes('donasi.html')) {
        handleDonationPageParams();
    }
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
    }, { threshold: 0.2, rootMargin: '0px 0px -8% 0px' });
    targets.forEach(function(el){ io.observe(el); });
}

// Global reveal initializer for all pages except login/register
function initializeGlobalReveal(){
    var path = window.location.pathname;
    if (path.includes('login.html') || path.includes('daftar.html')) return;

    // Add .reveal to common sections if not already present
    try {
        var candidates = [
            '.hero', '.hero-section', '.news-hero', '.donasi-hero',
            '.container.main-section', '.cards', '.news-container',
            '.news-card', '.donasi-container', '.faq-section', '.cta-section'
        ];
        candidates.forEach(function(sel){
            document.querySelectorAll(sel).forEach(function(el){
                if (!el.classList.contains('reveal')) el.classList.add('reveal');
            });
        });
    } catch(e) { /* no-op */ }

    initializeAboutReveal();
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