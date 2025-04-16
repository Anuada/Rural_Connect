import { confirmAlert } from "./helpers/sweetAlert2.js";
const admin_logout = document.getElementById('admin_logout');

const handleLogout = () => {
    location.href = "../logic/logout.php";
}

admin_logout.addEventListener('click', () => { 
    const question = "Are you sure you want to logout?";
    confirmAlert(question, handleLogout);
});