
document.addEventListener('DOMContentLoaded', function() {
    initializePasswordToggle();
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