import { confirmAlert } from "../helpers/sweetAlert2.js";

const submitCustomRequestEl = document.getElementById('submit-custom-request');
const dosageStrengthEl = document.getElementById('dosage-strength-el');
const categoryEl = document.getElementById('category');

categoryEl.addEventListener('input', () => {
    if (categoryEl.value == 'medicinal product') {
        dosageStrengthEl.classList.remove('d-none');
        dosageStrengthEl.innerHTML = `
            <label for="dosage_strength">Dosage Strength</label>
            <input type="text" class="form-control" id="dosage_strength" name="dosage_strength" required>
            <div style="height: 15px" class="form-text" id="dosage_strengthError"></div>
        `;
    } else {
        dosageStrengthEl.classList.add('d-none');
        dosageStrengthEl.innerHTML = '';
    }
})

submitCustomRequestEl.addEventListener('submit', (e) => {
    e.preventDefault();
    const form = e.target;

    const submitForm = () => {
        form.submit();
    }
    const question = "Do you confirm that all the information you entered is correct?";
    confirmAlert(question, submitForm, false);
});