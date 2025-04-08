import fetch from "./utilities/fetchClient.js";

const user_type = document.getElementById("user_type");
const barangay_input_field = document.getElementById("barangay_input_field");

const barangay_select_field = (data) => {
    barangay_input_field.classList.add('mb-3');
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
    }
})

if (user_type.value == 'barangay_inc') { 
    fetch_barangays();
}