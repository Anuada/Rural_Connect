import { confirmAlert } from "./helpers/sweetAlert2.js";
const admin_logout = document.getElementById('admin_logout');

const handleLogout = () => {
    location.href = "../logic/logout.php";
}

admin_logout.addEventListener('click', () => { 
    const question = "Are you sure you want to logout?";
    confirmAlert(question, handleLogout);
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
