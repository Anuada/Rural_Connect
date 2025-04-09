const renderPagination = (pagination, paginationContainer, fetchData) => {
    paginationContainer.innerHTML = '';

    let { currentPage, totalPages } = pagination;

    if (totalPages <= 1) return;

    // Prev
    paginationContainer.innerHTML += `<button class="btn btn-outline-primary page-btn" ${currentPage == 1 ? 'disabled' : ''} data-page="${currentPage - 1}">Prev</button>`;

    paginationContainer.innerHTML += `<div class="d-flex justify-content-center align-items-center mx-2">Page ${currentPage} of ${totalPages}</div>`;

    paginationContainer.innerHTML += `<button class="btn btn-outline-primary page-btn" ${currentPage == totalPages ? 'disabled' : ''} data-page="${currentPage + 1}">Next</button>`;

    // Add event listeners
    const buttons = document.querySelectorAll('.page-btn');
    buttons.forEach(btn => {
        btn.addEventListener('click', () => {
            currentPage = parseInt(btn.getAttribute('data-page'));
            fetchData(currentPage);
        });
    });
};

export default renderPagination;