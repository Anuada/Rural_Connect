document.addEventListener("DOMContentLoaded", () => {
    const rowsPerPage = 3;
    let currentPage = 1;

    const table = document.getElementById("medicineTable");
    const rows = Array.from(table.getElementsByTagName("tr")).slice(1); // Exclude header
    const totalPages = Math.ceil(rows.length / rowsPerPage);

    const prevBtn = document.getElementById("prevPage");
    const nextBtn = document.getElementById("nextPage");
    const pageNumbers = document.getElementById("pageNumbers");

    const displayPage = (page) => {
        rows.forEach((row, index) => {
            row.style.display = (index >= (page - 1) * rowsPerPage && index < page * rowsPerPage) ? "" : "none";
        });

        prevBtn.disabled = page === 1;
        nextBtn.disabled = page === totalPages;

        pageNumbers.innerText = `Page ${page} of ${totalPages}`;
    }

    prevBtn.addEventListener("click", () => {
        if (currentPage > 1) {
            currentPage--;
            displayPage(currentPage);
        }
    });

    nextBtn.addEventListener("click", () => {
        if (currentPage < totalPages) {
            currentPage++;
            displayPage(currentPage);
        }
    });

    displayPage(currentPage);
});
