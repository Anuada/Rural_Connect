import { confirmAlert } from "../helpers/sweetAlert2.js";

const submitRequestEl = document.getElementById('submit-request');

submitRequestEl.addEventListener('submit', (e) => { 
    e.preventDefault();
    const form = e.target;

    const submitForm = () => {
        form.submit();
    }
    const question = "Do you confirm that all the information you entered is correct?";
    confirmAlert(question, submitForm, false);
});