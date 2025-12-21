// menu burger
document.addEventListener('DOMContentLoaded', function () {
    const burgerMenu = document.getElementById('burgerMenu');
    const mobileMenu = document.getElementById('mobileMenu');
    const mobileMenuClose = document.getElementById('mobileMenuClose');
    const mobileNavLinks = document.querySelectorAll('.mobile-nav-link');

    if (burgerMenu) {
        burgerMenu.addEventListener('click', function () {
            mobileMenu.classList.toggle('active');
            burgerMenu.classList.toggle('active');
        });
    }

    if (mobileMenuClose) {
        mobileMenuClose.addEventListener('click', function () {
            mobileMenu.classList.remove('active');
            burgerMenu.classList.remove('active');
        });
    }

    // tutup menu saat di klik 
    mobileNavLinks.forEach(link => {
        link.addEventListener('click', function () {
            mobileMenu.classList.remove('active');
            if (burgerMenu) {
                burgerMenu.classList.remove('active');
            }
        });
    });

    // menutup menu
    document.addEventListener('click', function (event) {
        if (mobileMenu && mobileMenu.classList.contains('active')) {
            if (!mobileMenu.contains(event.target) && !burgerMenu.contains(event.target)) {
                mobileMenu.classList.remove('active');
                if (burgerMenu) {
                    burgerMenu.classList.remove('active');
                }
            }
        }
    });

    // SEARCH BAR FUNCTIONALITY 
    const setupSearch = (inputId, resultsId) => {
        const searchInput = document.getElementById(inputId);
        const searchResults = document.getElementById(resultsId);

        if (!searchInput || !searchResults) return;

        let debounceTimer;

        searchInput.addEventListener('input', function () {
            clearTimeout(debounceTimer);
            const query = this.value.trim();

            if (query.length < 2) {
                searchResults.classList.remove('show');
                return;
            }

            debounceTimer = setTimeout(() => {
                fetch(`/search/donations?query=${encodeURIComponent(query)}`)
                    .then(response => response.json())
                    .then(data => {
                        searchResults.innerHTML = '';
                        if (data.length > 0) {
                            data.forEach(item => {
                                const div = document.createElement('div');
                                div.className = 'search-result-item';

                                div.onclick = () => window.location.href = `/donasi#campaign-${item.CampaignID}`;

                                const categoryName = item.category ? item.category.NamaKategoriCampaign : 'Umum';

                                const imageUrl = `/image/${item.ImageURL}`;

                                div.innerHTML = `
                                    <img src="${imageUrl}" alt="${item.Judul}" class="search-result-image" onerror="this.onerror=null;this.src='/image/default.jpg';"> 
                                    <div class="search-result-content">
                                        <div class="search-result-title">${item.Judul}</div>
                                        <span class="search-result-badge">${categoryName}</span>
                                    </div>
                                `;
                                searchResults.appendChild(div);
                            });
                            searchResults.classList.add('show');
                        } else {
                            searchResults.innerHTML = '<div class="search-no-results">Tidak ada hasil donasi ditemukan</div>';
                            searchResults.classList.add('show');
                        }
                    })
                    .catch(err => {
                        console.error('Error searching:', err);
                        searchResults.innerHTML = '<div class="search-no-results">Terjadi kesalahan. Coba lagi.</div>';
                        searchResults.classList.add('show');
                    });
            }, 60);
        });


        document.addEventListener('click', function (e) {
            if (!searchInput.contains(e.target) && !searchResults.contains(e.target)) {
                searchResults.classList.remove('show');
            }
        });


        searchInput.addEventListener('focus', function () {
            if (this.value.trim().length >= 2 && searchResults.children.length > 0) {
                searchResults.classList.add('show');
            }
        });
    };

    setupSearch('searchInput', 'searchResults');
    setupSearch('searchInputMobile', 'searchResultsMobile');
});
