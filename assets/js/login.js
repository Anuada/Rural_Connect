const togglePasswordEl = document.getElementById('togglePassword');
const passwordEl = document.getElementById('password');

togglePasswordEl.addEventListener('click', () => {
    if (passwordEl.getAttribute('type') == 'password') {
        passwordEl.setAttribute('type', 'text');
        togglePasswordEl.className = 'fas fa-eye-slash';
    } else {
        passwordEl.setAttribute('type', 'password');
        togglePasswordEl.className = 'fas fa-eye';
    }
});