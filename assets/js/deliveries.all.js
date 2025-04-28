import { confirmAlert } from "./helpers/sweetAlert2.js";
const admin_logout = document.getElementById('admin_logout');

admin_logout.addEventListener('click', (e) => {
    e.preventDefault();

    const form = document.createElement('form');
    form.method = 'POST';
    form.action = '../logic/logout.php';

    document.body.appendChild(form);
    const question = "Are you sure you want to logout?";
    confirmAlert(question, () => form.submit());
});

// Mobile menu toggle
const sidenav = document.querySelector(".sidenav");
const mobileToggle = document.getElementById("mobileNavToggle");

mobileToggle?.addEventListener("click", () => {
    sidenav.classList.toggle("active");
});

// Optional: Close sidenav when clicking outside (mobile)
document.addEventListener('click', function (e) {
    if (
        !sidenav.contains(e.target) &&
        !mobileToggle.contains(e.target) &&
        sidenav.classList.contains("active")
    ) {
        sidenav.classList.remove("active");
    }
});
