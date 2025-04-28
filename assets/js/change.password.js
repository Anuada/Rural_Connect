const togglePassword = document.querySelectorAll('[data-action="togglePassword"]');

togglePassword.forEach(toggle => {
    toggle.addEventListener('click', () => {
        const passwordEl = toggle.closest('div').querySelector('.passwordEl');
        if (passwordEl.getAttribute('type') == 'password') {
            passwordEl.setAttribute('type', 'text');
            toggle.className = 'fas fa-eye-slash';
        } else {
            passwordEl.setAttribute('type', 'password');
            toggle.className = 'fas fa-eye';
        }
    });
});