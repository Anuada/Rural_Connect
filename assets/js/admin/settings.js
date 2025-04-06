import serializeForm from "../helpers/serializeForm.js";
import { errorAlert, successAlert } from "../helpers/sweetAlert2.js";
import fetch from "../utilities/fetchClient.js";
import { change_password_form, update_profile_form } from "../utilities/forms.js";

// Div container
const form_container = document.getElementById("form_container");

// Event Listener
document.addEventListener("click", (e) => {
    const button_id = e.target.id;
    if (button_id == "changePassword") {
        form_container.innerHTML = change_password_form;
    } else if (button_id == "updateProfile") {
        fetchData();
        form_container.innerHTML = update_profile_form;
    }
})

const fetchData = async () => {
    try {
        const response = await fetch.get("../api/admin.get.profile.php");
        const data = response.data.data;
        const [fname, lname, address, DOB, contactNo] = ['fname', 'lname', 'address', 'DOB', 'contactNo'].map(el => document.getElementById(el));
        fname.value = data.fname;
        lname.value = data.lname;
        address.value = data.address;
        DOB.value = data.DOB;
        contactNo.value = data.contactNo;
    } catch (error) {
        console.error(error);
    }
}

document.addEventListener("submit", async (e) => {
    e.preventDefault();
    const id = e.target.id;
    if (id == "updateProfileForm") {
        const payload = serializeForm(e.target);

        try {
            const response = await fetch.put('../api/admin.update.profile.php', payload);
            successAlert(response.data.message);
            fetchData();
        } catch (error) {
            const errors = error.data.data;
            const [fnameError, lnameError, addressError, contactNoError, dobError] = ['fnameError', 'lnameError', 'addressError', 'contactNoError', 'dobError'].map(el => document.getElementById(el))
            fnameError.innerHTML = errors.fname ?? "";
            lnameError.innerHTML = errors.lname ?? "";
            addressError.innerHTML = errors.address ?? "";
            contactNoError.innerHTML = errors.contactNo ?? "";
            dobError.innerHTML = errors.DOB ?? "";
            fetchData();
        }
    } else if (id == "changePasswordForm") {
        const payload = serializeForm(e.target);
        try {
            const response = await fetch.put("../api/admin.change.password.php", payload);
            successAlert(response.data.message);
        } catch (error) {
            const errors = error.data.data;
            const [current_passwordError, new_passwordError, repeat_passwordError] = ['current_passwordError', 'new_passwordError', 'repeat_passwordError'].map(el => document.getElementById(el));
            current_passwordError.innerHTML = errors.current_password ?? "";
            new_passwordError.innerHTML = errors.new_password ?? "";
            repeat_passwordError.innerHTML = errors.repeat_password ?? "";
            if (errors == null) {
                errorAlert(error.data.message);
            }
        }
    }
})

document.addEventListener('DOMContentLoaded', () => {
    form_container.innerHTML = update_profile_form;
    fetchData();

});