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
    const url = `Profil.php?name=${workerName}`;

    window.location.href = url;
}

const dataRows = document.getElementsByClassName('data-row');
for (let i = 0; i < dataRows.length; i++) {
    dataRows[i].addEventListener('click', handleRowClick);
    dataRows[i].style.cursor = 'pointer';
}

const daysInMonth = (month, year) => new Date(year, month, 0).getDate();
const months = ["Januari", "Februari", "Mac", "April", "Mei", "Jun",
    "Julai", "Ogos", "September", "Oktober", "November", "Disember"
];
let currentDate = new Date();
let currentDay = currentDate.getDate();
let currentMonthIndex = currentDate.getMonth();
let currentYear = currentDate.getFullYear();

const selector = document.getElementById("selector-dropdown");
const day = document.getElementById("day-segment-value");
const month = document.getElementById("month-segment-value");

function updateCalendar() {
    day.textContent = currentDay;
    month.textContent = months[currentMonthIndex];
    document.getElementById("year-segment-value").textContent = currentYear;
}

function moveCalendar(direction) {
    const selector = document.getElementById("selector-dropdown").value;
    if (selector === "day") {
        currentDay += direction;
    } else if (selector === "month") {
        currentMonthIndex += direction;
        if (currentMonthIndex < 0) {
            currentMonthIndex = 11; // December
            currentYear--;
        } else if (currentMonthIndex > 11) {
            currentMonthIndex = 0; // January
            currentYear++;
        }
    } else if (selector === "year") {
        currentYear += direction;
    }

    const daysInCurrentMonth = daysInMonth(currentMonthIndex + 1, currentYear);
    if (currentDay < 1) {
        currentDay = daysInMonth(currentMonthIndex, currentYear);
    } else if (currentDay > daysInCurrentMonth) {
        currentDay = 1;
    }
    updateCalendar();
}

updateCalendar(); // Initial update


selector.addEventListener("change", function () {
    const dateSeg = document.getElementById("date-segment")
    if (selector.value === "day") {
        dateSeg.style.width = "248px";
        day.style.display = "inline";
        month.style.display = "inline";
    }
    else if (selector.value === "month") {
        dateSeg.style.width = "230px";
        day.style.display = "none";
        month.style.display = "inline";
    }
    else if (selector.value === "year") {
        dateSeg.style.width = "100px";
        day.style.display = "none";
        month.style.display = "none";
    }
});

