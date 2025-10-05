
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