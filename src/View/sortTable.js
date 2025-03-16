let sortDirection = false;

function sortBy(columnIndex, isNumeric) {
    const table = document.getElementById("sortable");
    const tbody = table.tBodies[0];
    const rows = Array.from(tbody.rows);

    sortDirection = !sortDirection;

    rows.sort((rowA, rowB) => {
        const cellA = rowA.cells[columnIndex].innerText;
        const cellB = rowB.cells[columnIndex].innerText;

        let valueA, valueB;
        if (isNumeric) {
            valueA = parseFloat(cellA);
            valueB = parseFloat(cellB);
        } else {
            valueA = cellA.toLowerCase();
            valueB = cellB.toLowerCase();
        }

        if (valueA < valueB) {
            return sortDirection ? -1 : 1;
        }
        if (valueA > valueB) {
            return sortDirection ? 1 : -1;
        }
        return 0;
    });

    rows.forEach(row => tbody.appendChild(row));

    const sortIcon = document.querySelector("th i.fa-sort");
    if (sortDirection) {
        sortIcon.classList.remove("fa-sort-down");
        sortIcon.classList.add("fa-sort-up");
    } else {
        sortIcon.classList.remove("fa-sort-up");
        sortIcon.classList.add("fa-sort-down");
    }
}