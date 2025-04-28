import { confirmAlert } from "./helpers/sweetAlert2.js";

const logout = document.getElementById('logout');

logout.addEventListener('submit', (e) => {
    e.preventDefault();
    const question = "Are you sure you want to logout?";
    confirmAlert(question, () => logout.submit());
});