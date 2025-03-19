document.addEventListener("DOMContentLoaded", function () {
    const rowsPerPage = 5; // Set the number of rows per page
    let currentPage = 1;
    const table = document.getElementById("medicineTable");
    const rows = table.getElementsByTagName("tr");
    const totalRows = rows.length - 2; // Subtract header rows
    const totalPages = Math.ceil(totalRows / rowsPerPage);

    const prevPageButton = document.getElementById("prevPage");
    const nextPageButton = document.getElementById("nextPage");
    const pageNumbers = document.getElementById("pageNumbers");

    function showPage(page) {
        currentPage = page;
        let start = (currentPage - 1) * rowsPerPage + 2; // Skip header rows
        let end = start + rowsPerPage;

        for (let i = 2; i < rows.length; i++) { // Start from index 2 to avoid table headers
            rows[i].style.display = i >= start && i < end ? "" : "none";
        }

        prevPageButton.disabled = currentPage === 1;
        nextPageButton.disabled = currentPage === totalPages;
        updatePageNumbers();
    }

    function updatePageNumbers() {
        pageNumbers.innerHTML = `Page ${currentPage} of ${totalPages}`;
    }

    prevPageButton.addEventListener("click", function () {
        if (currentPage > 1) {
            showPage(currentPage - 1);
        }
    });

    nextPageButton.addEventListener("click", function () {
        if (currentPage < totalPages) {
            showPage(currentPage + 1);
        }
    });

    if (totalPages > 0) {
        showPage(1); // Initialize first page
    }
});
