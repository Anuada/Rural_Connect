import { confirmAlert } from "../helpers/sweetAlert2.js";

const delivery_status = document.getElementById('delivery_status');

delivery_status.addEventListener('change', (e) => {
    const form = e.target.closest('form');
    const value = e.target.value;

    const changeStatus = () => {
        form.submit();
    };

    const question = `Are you sure you want to change delivery status to '${value}'?`;
    confirmAlert(question, changeStatus);
});