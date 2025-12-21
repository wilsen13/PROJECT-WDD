// Function Untuk Password hide dan show 
document.addEventListener('DOMContentLoaded', function () {
    initializePasswordToggle();
    initializeCounters();
    initializeAboutReveal();
    initializeGlobalReveal();
    initializeSearch();
});


function initializeSearch() {
    const searchInput = document.getElementById('searchInput');
    const searchResults = document.getElementById('searchResults');

    if (!searchInput || !searchResults) return;


    if (searchInput.parentElement) {
        searchInput.parentElement.style.position = 'relative';
    }


    Object.assign(searchResults.style, {
        position: 'absolute',
        top: '100%',
        left: '0',
        width: '100%',
        zIndex: '9999',
        backgroundColor: '#ffffff',
        boxShadow: '0 10px 25px rgba(0,0,0,0.1)',
        borderRadius: '0 0 10px 10px',
        maxHeight: '350px',
        overflowY: 'auto',
        border: '1px solid #eee',
        display: 'none'
    });

    let searchTimeout;

    searchInput.addEventListener('input', function () {
        clearTimeout(searchTimeout);
        const query = this.value.trim();

        if (query.length < 2) {
            searchResults.style.display = 'none';

            return;
        }


        searchTimeout = setTimeout(() => {
            fetchDonations(query, searchResults);
        }, 300);
    });


    searchInput.addEventListener('keypress', function (e) {
        if (e.key === 'Enter') {
            const query = this.value.trim();
            e.preventDefault();
            if (query.length > 0) {
                window.location.href = `/donasi?search=${encodeURIComponent(query)}`;
            }
        }
    });


    document.addEventListener('click', function (e) {
        if (!searchInput.contains(e.target) && !searchResults.contains(e.target)) {
            searchResults.style.display = 'none';
        }
    });
}


function fetchDonations(query, container) {

    fetch(`/search/donations?query=${encodeURIComponent(query)}`)
        .then(response => {
            if (!response.ok) throw new Error('Network response');
            return response.json();
        })
        .then(data => {
            displaySearchResults(data, container, query);
        })
        .catch(error => {
            console.error('Error:', error);
            container.style.display = 'none';
        });
}


function displaySearchResults(results, container, query) {
    if (results.length === 0) {
        container.innerHTML = `
            <div class="search-no-results" style="padding: 15px; text-align: center; color: #666; font-size: 14px;">
                Tidak ada donasi yang ditemukan untuk "<strong>${query}</strong>"
            </div>
        `;
    } else {

        container.innerHTML = results.map(donation => {

            const imageUrl = donation.ImageURL ? `/image/${donation.ImageURL}` : '/images/default.jpg';
            const detailUrl = `/donasi?donation=${donation.CampaignID}`;


            const terkumpul = Number(donation.DanaTerkumpul) || 0;
            const target = Number(donation.TargetDana) || 1;
            const percentage = Math.min(100, Math.round((terkumpul / target) * 100));

            const formatRupiah = new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                maximumFractionDigits: 0
            }).format(terkumpul);

            return `
            <div class="search-result-item" onclick="window.location.href='${detailUrl}'" 
                 style="cursor: pointer; display: flex; align-items: center; padding: 12px; border-bottom: 1px solid #f0f0f0; background: white; transition: background 0.2s;">
                
                <!-- Gambar Donasi -->
                <img src="${imageUrl}" alt="${donation.Judul}" 
                     style="width: 50px; height: 50px; object-fit: cover; border-radius: 8px; margin-right: 15px; flex-shrink: 0;">
                
                <!-- Konten Teks -->
                <div style="flex: 1; min-width: 0;">
                    <div style="font-size: 14px; font-weight: bold; color: #333; margin-bottom: 4px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                        ${donation.Judul}
                    </div>
                    
                    <!-- Kategori (Opsional) -->
                    <div style="font-size: 11px; color: #00a989; font-weight: 600; margin-bottom: 4px; text-transform: uppercase;">
                        ${donation.category ? donation.category.NamaKategoriCampaign : 'Donasi'}
                    </div>

                    <!-- Progress Bar Kecil -->
                    <div style="display: flex; align-items: center; justify-content: space-between; font-size: 11px; color: #666;">
                        <div style="flex: 1; background: #eee; height: 4px; border-radius: 2px; margin-right: 8px; overflow: hidden;">
                            <div style="width: ${percentage}%; background: #00a989; height: 100%;"></div>
                        </div>
                        <span style="font-weight: 500;">${formatRupiah}</span>
                    </div>
                </div>
            </div>
            `;
        }).join('');


        const items = container.querySelectorAll('.search-result-item');
        items.forEach(item => {
            item.addEventListener('mouseenter', () => item.style.background = '#f9f9f9');
            item.addEventListener('mouseleave', () => item.style.background = 'white');
        });
    }


    container.style.display = 'block';
}


function handleDonationPageParams() {
    const urlParams = new URLSearchParams(window.location.search);
    const donationId = urlParams.get('donation');
    const searchQuery = urlParams.get('search');

    if (donationId) {
        const donationElement = document.getElementById(`campaign-${donationId}`);
        if (donationElement) {
            donationElement.scrollIntoView({ behavior: 'smooth', block: 'center' });
            donationElement.style.border = '3px solid #0ea594';
            donationElement.style.borderRadius = '12px';
            setTimeout(() => {
                donationElement.style.border = '';
                donationElement.style.borderRadius = '';
            }, 5000);
        }
    }

    if (searchQuery) {
        const searchInput = document.getElementById('searchInput');
        if (searchInput) {
            searchInput.value = searchQuery;
            searchInput.focus();
        }
    }
}

document.addEventListener('DOMContentLoaded', function () {
    if (window.location.pathname.includes('donasi')) {
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
        toggleBtn.addEventListener('click', function () {
            togglePassword(input, toggleBtn);
        });
    });
}

function initializeAboutReveal() {
    var targets = document.querySelectorAll('.reveal');
    if (targets.length === 0) return;
    if (!('IntersectionObserver' in window)) {
        targets.forEach(function (el) { el.classList.add('is-visible'); });
        return;
    }
    var io = new IntersectionObserver(function (entries, obs) {
        entries.forEach(function (entry) {
            if (entry.isIntersecting) {
                entry.target.classList.add('is-visible');
                obs.unobserve(entry.target);
            }
        });
    }, { threshold: 0.2, rootMargin: '0px 0px -8% 0px' });
    targets.forEach(function (el) { io.observe(el); });
}

function initializeGlobalReveal() {
    var path = window.location.pathname;
    if (path.includes('login') || path.includes('daftar')) return; // Adjusted check

    try {
        var candidates = [
            '.hero', '.hero-section', '.news-hero', '.donasi-hero',
            '.container.main-section', '.cards', '.news-container',
            '.news-card', '.donasi-container', '.faq-section', '.cta-section'
        ];
        candidates.forEach(function (sel) {
            document.querySelectorAll(sel).forEach(function (el) {
                if (!el.classList.contains('reveal')) el.classList.add('reveal');
            });
        });
    } catch (e) { /* no-op */ }

    initializeAboutReveal();
}

function initializeCounters() {
    var counters = document.querySelectorAll('.counter');
    if (counters.length === 0) return;

    var formatNumber = function (num) {
        return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',');
    };

    var animate = function (el) {
        var target = parseInt(el.getAttribute('data-target') || '0', 10);
        var duration = 1600;
        var start = 0;
        var startTime = null;

        var step = function (timestamp) {
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
        var observer = new IntersectionObserver(function (entries, obs) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    animate(entry.target);
                    obs.unobserve(entry.target);
                }
            });
        }, { threshold: 0.2 });

        counters.forEach(function (el) { observer.observe(el); });
    } else {
        counters.forEach(function (el) { animate(el); });
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

function openDonationModal(category) {
    const modal = document.getElementById('donationModal');
    const modalTitle = document.getElementById('donationModalTitle');

    const titles = {
        'pendidikan': 'Donasi untuk Pendidikan',
        'kesehatan': 'Donasi untuk Kesehatan',
        'pangan': 'Donasi untuk Pangan'
    };

    modalTitle.textContent = titles[category] || 'Donasi untuk Pendidikan';
    modal.style.display = 'block';
    document.body.style.overflow = 'hidden';
}

function closeDonationModal() {
    const modal = document.getElementById('donationModal');
    modal.style.display = 'none';
    document.body.style.overflow = 'auto';
}

document.addEventListener('click', function (event) {
    const modal = document.getElementById('donationModal');
    if (event.target === modal) {
        closeDonationModal();
    }
});

document.addEventListener('keydown', function (event) {
    if (event.key === 'Escape') {
        closeDonationModal();
    }
});


document.addEventListener('DOMContentLoaded', function () {
    const customAmountRadio = document.querySelector('input[value="custom"]');
    const customAmountInput = document.getElementById('customAmountInput');

    if (customAmountRadio && customAmountInput) {
        customAmountRadio.addEventListener('change', function () {
            if (this.checked) {
                customAmountInput.style.display = 'block';
            } else {
                customAmountInput.style.display = 'none';
            }
        });
    }

    const donationForm = document.getElementById('donationForm');
    if (donationForm) {
        donationForm.addEventListener('submit', function (event) {
        });
    }
});