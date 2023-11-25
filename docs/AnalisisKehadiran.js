function searchTable() {
    let input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("searchInput");
    filter = input.value.toUpperCase();
    table = document.getElementById("attendanceTable");
    tr = table.getElementsByTagName("tr");

    for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[1]; // index 1 corresponds to the 'Name' column
        if (td) {
            txtValue = td.textContent || td.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
        }
    }
}

function handleRowClick(event) {
    const rowData = event.currentTarget.getElementsByTagName('td');
    let content = '';
    for (let i = 0; i < rowData.length; i++) {
        content += rowData[i].innerText + ' | ';
    }

    alert('Clicked row content: ' + content);
}

const dataRows = document.getElementsByClassName('data-row');
for (let i = 0; i < dataRows.length; i++) {
    dataRows[i].addEventListener('click', handleRowClick);
    dataRows[i].style.cursor = 'pointer';
}