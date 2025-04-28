import Swal from 'https://cdn.skypack.dev/sweetalert2';

/**
 * Displays a success alert with a custom message.
 * @param {*} message The message to display in the success alert.
 * @param {boolean} darkmode Whether to apply dark mode styling.
 */
export const successAlert = (message, darkmode = false) => {
    Swal.fire({
        icon: "success",
        title: message,
        confirmButtonColor: "#007bff",
        timer: 2000,
        timerProgressBar: true,
        background: darkmode ? "#333" : "#fff",
        color: darkmode ? "#f1f1f1" : undefined,
        iconColor: darkmode ? "#10b981" : undefined,
        customClass: {
            popup: darkmode ? "dark-swal" : "",
        }
    });
};

/**
 * Displays an error alert with a custom message.
 * @param {*} message The message to display in the error alert.
 * @param {boolean} darkmode Whether to apply dark mode styling.
 */
export const errorAlert = (message, darkmode = false) => {
    Swal.fire({
        icon: "error",
        title: message,
        confirmButtonColor: "#d33",
        timer: 2000,
        timerProgressBar: true,
        background: darkmode ? "#333" : "#fff",
        color: darkmode ? "#f1f1f1" : undefined,
        iconColor: darkmode ? "#ef4444" : undefined,
        customClass: {
            popup: darkmode ? "dark-swal" : "",
        }
    });
};

/**
 * Shows a confirmation dialog with a question, and executes a provided action if confirmed.
 * @param {*} question The question to ask in the confirmation dialog.
 * @param {*} action The function to execute if the user confirms.
 * @param {boolean} darkmode Whether to apply dark mode styling.
 * @param  {...any} actionArgs Arguments to pass to the `action` function.
 */
export const confirmAlert = (question, action, darkmode = false, ...actionArgs) => {
    Swal.fire({
        title: question,
        showDenyButton: true,
        confirmButtonText: "Yes",
        denyButtonText: "No",
        confirmButtonColor: "#007bff",
        background: darkmode ? "#333" : "#fff",
        color: darkmode ? "#f1f1f1" : undefined,
        iconColor: darkmode ? "#fbbf24" : undefined,
        customClass: {
            popup: darkmode ? "dark-swal" : "",
        }
    }).then((result) => {
        if (result.isConfirmed) {
            action(...actionArgs);
        }
    });
};

export const choicesAlert = (title, choice_1, choice_2, action_v1, action_v2, darkmode = false, actionV1Args = [], actionV2Args = []) => {
    Swal.fire({
        title: title,
        showDenyButton: true,
        confirmButtonText: choice_1,
        denyButtonText: choice_2,
        confirmButtonColor: "#007bff",
        background: darkmode ? "#333" : "#fff",
        color: darkmode ? "#f1f1f1" : undefined,
        iconColor: darkmode ? "#fbbf24" : undefined,
        customClass: {
            popup: darkmode ? "dark-swal" : "",
        }
    }).then((result) => {
        if (result.isConfirmed) {
            action_v1(...actionV1Args);
        } else if (result.isDenied) {
            action_v2(...actionV2Args);
        }
    });
};
