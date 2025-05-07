import fetch from "../utilities/fetchClient.js";
import { capitalizeFirstLetter } from "../utilities/formatter.js";
import { errorAlert } from "../helpers/sweetAlert2.js";
import { isEmptyTrimmed } from "../utilities/misc.js";

// Field Input Elements
const generic_name = document.querySelector('[name="generic_name"]');
const med_description = document.querySelector('[name="med_description"]');
const category = document.querySelector('[name="category"]');

const medicinal_product_other_details = document.getElementById('medicinal_product_other_details');

generic_name.addEventListener('change', () => {
    fetchMedicineDescription(generic_name.value);
});

const fetchMedicineDescription = (generic_name) => {
    const name = capitalizeFirstLetter(generic_name);
    const encoded = encodeURIComponent(name);

    fetch.get(`https://en.wikipedia.org/api/rest_v1/page/summary/${encoded}`)
        .then(response => {
            const { extract } = response?.data;
            if (extract != undefined) {
                med_description.value = extract;
            }
        })
        .catch(error => {
            const { status } = error?.response;
            if (status == 404) {
                if (!isEmptyTrimmed(generic_name)) {
                    errorAlert(`No description found for '${generic_name}'`);
                    med_description.value = ''
                }
                med_description.value = ''
            } else {
                console.error(status);
            }
        });
};

category.addEventListener('input', () => {
    if (category.value == 'medicinal product') {
        medicinal_product_other_details.innerHTML = `
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="dosage_strength">Dosage Strength</label>
                    <input class="form-control" type="text" id="dosage_strength" name="dosage_strength" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="expiration_date">Expiration Date</label>
                    <input class="form-control" type="date" id="expiration_date" name="expiration_date" required>
                </div>
            </div>
        `;
    } else { 
        medicinal_product_other_details.innerHTML = '';
    }
});

document.addEventListener('DOMContentLoaded', () => {
    let tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    tooltipTriggerList.map((tooltipTriggerEl) => {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    })
});