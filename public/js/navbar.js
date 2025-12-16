// menu burger
document.addEventListener('DOMContentLoaded', function() {
    const burgerMenu = document.getElementById('burgerMenu');
    const mobileMenu = document.getElementById('mobileMenu');
    const mobileMenuClose = document.getElementById('mobileMenuClose');
    const mobileNavLinks = document.querySelectorAll('.mobile-nav-link');
    
    if (burgerMenu) {
        burgerMenu.addEventListener('click', function() {
            mobileMenu.classList.toggle('active');
            burgerMenu.classList.toggle('active');
        });
    }
    
    if (mobileMenuClose) {
        mobileMenuClose.addEventListener('click', function() {
            mobileMenu.classList.remove('active');
            burgerMenu.classList.remove('active');
        });
    }
    
    // tutup menu saat di klik 
    mobileNavLinks.forEach(link => {
        link.addEventListener('click', function() {
            mobileMenu.classList.remove('active');
            if (burgerMenu) {
                burgerMenu.classList.remove('active');
            }
        });
    });
    
    // menutup menu
    document.addEventListener('click', function(event) {
        if (mobileMenu && mobileMenu.classList.contains('active')) {
            if (!mobileMenu.contains(event.target) && !burgerMenu.contains(event.target)) {
                mobileMenu.classList.remove('active');
                if (burgerMenu) {
                    burgerMenu.classList.remove('active');
                }
            }
        }
    });
});
