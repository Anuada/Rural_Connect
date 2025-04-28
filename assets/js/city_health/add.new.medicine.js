import fetch from "../utilities/fetchClient.js";
import { capitalizeFirstLetter } from "../utilities/formatter.js";
import { errorAlert } from "../helpers/sweetAlert2.js";
import { isEmptyTrimmed } from "../utilities/misc.js";

// Field Input Elements
const generic_name = document.querySelector('[name="med_name"]');
const med_description = document.querySelector('[name="med_description"]');

generic_name.addEventListener('change', () => {
    fetchMedicineDescription(generic_name.value);
});

const fetchMedicineDescription = (med_name) => {
    const name = capitalizeFirstLetter(med_name);
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
                if (!isEmptyTrimmed(med_name)) {
                    errorAlert(`No description found for '${med_name}'`);
                    med_description.value = ''
                }
                med_description.value = ''
            } else {
                console.error(status);
            }
        });
};

document.addEventListener('DOMContentLoaded', () => {
    let tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    tooltipTriggerList.map((tooltipTriggerEl) => {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    })
});