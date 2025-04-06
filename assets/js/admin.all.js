const admin_logout = document.getElementById('admin_logout');

admin_logout.addEventListener('click', () => {
    Swal.fire({
        title: "Do you want to logout?",
        showDenyButton: true,
        confirmButtonColor: "#007bff",
        confirmButtonText: "Yes",
        denyButtonText: `No`,
    }).then((result) => {
        if (result.isConfirmed) {
            location.href = "../logic/logout.php";
        }
    });
})