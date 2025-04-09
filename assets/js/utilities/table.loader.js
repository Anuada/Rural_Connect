import fetch from "./fetchClient.js";

const tableLoader = (row_num, col_num, table_container) => {
    let column = [];
    let row = [];
    for (let i = 0; i < col_num; i++) {
        column.push(`<td class="td"><div class="table-loader"></div></td>`);
    }

    for (let i = 0; i < row_num; i++) {
        row.push(`<tr class="tr">${column.join("")}</tr>`);
    }

    table_container.innerHTML = row.join("");
}

export const subscriptionLoader = (table_container) => {
    fetch.get('../api/admin.table.row.count.php?table=subscription')
        .then(response => {
            const total = parseInt(response.data.data);
            const row_num = total > 5 ? 5 : total;
            tableLoader(row_num, 5, table_container);
        })
        .catch(error => {
            console.error(error);
        })
}