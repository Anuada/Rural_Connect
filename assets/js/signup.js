import fetch from "./utilities/fetchClient.js";
import { confirmAlert } from "./helpers/sweetAlert2.js";

const user_type = document.getElementById("user_type");
const barangay_input_field = document.getElementById("barangay_input_field");
const signup_form = document.getElementById("signup-form");

// Toggle Password Elements
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

const barangay_select_field = (data) => {
    barangay_input_field.classList.remove('d-none');
    barangay_input_field.classList.add('mb-3');
    barangay_input_field.classList.add('col-md-4');

    barangay_input_field.innerHTML = `
        <select class="form-control" name="barangay" id="barangay" required>
            <option value="" hidden selected>Select Barangay</option>
            ${data.map(d => `<option value="${d}">${d}</option>`).join('')}
        </select>
    `;
}

const fetch_barangays = () => {
    fetch.get('../api/barangay.php')
        .then(response => {
            barangay_select_field(response.data.data);
        })
        .catch(error => {
            console.error(error);
        });
}

user_type.addEventListener('input', (e) => {
    const value = e.target.value;
    if (value == 'barangay_inc') {
        fetch_barangays();
    } else {
        barangay_input_field.innerHTML = '';
        barangay_input_field.className = '';
        barangay_input_field.classList.add('d-none');
    }
})

if (user_type.value == 'barangay_inc') {
    fetch_barangays();
}

signup_form.addEventListener('submit', (e) => {
    e.preventDefault();
    const form = e.target;

    const question = "You're about to create your account. Do you want to proceed?";
    confirmAlert(question, () => form.submit());
});