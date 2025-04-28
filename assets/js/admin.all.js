import { confirmAlert } from "./helpers/sweetAlert2.js";
const admin_logout = document.getElementById('admin_logout');

admin_logout.addEventListener('click', (e) => {
    e.preventDefault();

    const form = document.createElement('form');
    form.method = 'POST';
    form.action = '../logic/logout.php';

    document.body.appendChild(form);
    const question = "Are you sure you want to logout?";
    confirmAlert(question, () => form.submit(), true);
});