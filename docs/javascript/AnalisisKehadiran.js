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

    let workerName = rowData[1].innerText;
    const url = `Pekerja.php?name=${workerName}`;

    window.location.href = url;
}

const dataRows = document.getElementsByClassName('data-row');
for (let i = 0; i < dataRows.length; i++) {
    dataRows[i].addEventListener('click', handleRowClick);
    dataRows[i].style.cursor = 'pointer';
}

const months = ["January", "February", "March", "April", "May", "June",
    "July", "August", "September", "October", "November", "December"
];
let currentMonthIndex = 1; // February

function updateCalendar() {
    const monthDiv = document.getElementById("month-value");
    monthDiv.textContent = months[currentMonthIndex];
    // Implement calendar functionality here
}

function moveCalendar(direction) {
    currentMonthIndex += direction;
    if (currentMonthIndex < 0) {
        currentMonthIndex = 11; // December
    } else if (currentMonthIndex > 11) {
        currentMonthIndex = 0; // January
    }
    updateCalendar();
}

updateCalendar(); // Initial update
