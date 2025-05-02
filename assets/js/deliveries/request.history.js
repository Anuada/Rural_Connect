import fetch from "../utilities/fetchClient.js";
import renderPagination from "../utilities/table.pagination.js";
import tableDisplay from "./_table.display.js";

let currentPage = 1;
const limit = 4;

const medRequestTableDataEl = document.getElementById('med-request-table-data');
const medRequestPaginationEl = document.getElementById('med-request-pagination');

const fetchData = (page = 1) => {
    fetch.get(`../api/deliveries.medicine.requests.history.php?page=${page}&limit=${limit}`)
        .then(response => {
            const { data, pagination } = response.data.data;
            tableDisplay(data, medRequestTableDataEl);
            renderPagination(pagination, medRequestPaginationEl, fetchData);
        })
        .catch(error => {
            console.error(error);
        });
};

document.addEventListener('DOMContentLoaded', () => {
    fetchData(currentPage);
});