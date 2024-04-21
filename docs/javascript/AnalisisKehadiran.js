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
let currentDate = new Date();
let firstLoad = true;

// read server to client
const isDefault = document.getElementById("isDefault").textContent.trim() === "true"
const selector = document.getElementById("selector-dropdown");
const day = document.getElementById("day-segment-value");
const month = document.getElementById("month-segment-value");
const year = document.getElementById("year-segment-value");

let monthNames = ["January", "February", "March", "April", "May", "June",
    "July", "August", "September", "October", "November", "December"];
if (!isDefault) {
    currentDate = new Date(document.getElementById("startDate").textContent.trim());

    for (var i = 0; i < selector.options.length; i++) {
        if (selector.options[i].value === document.getElementById('selected').textContent.trim()) {
            selector.options[i].selected = true;
            break;
        }
    }
    selectorState();
}

updateCalendar(); // Initial update

function updateCalendar() {
    day.textContent = currentDate.getDate();
    month.textContent = monthNames[currentDate.getMonth()];
    year.textContent = currentDate.getFullYear();

    let start_date = new Date(currentDate);
    let end_date = new Date(currentDate);
    if (selector.value == "month") {
        start_date.setDate(1);
        end_date.setDate(lastDayOfMonth(start_date));
    }
    else if (selector.value == "year") {
        start_date.setMonth(0); // Month is 0th based
        end_date.setMonth(11);
        start_date.setDate(1);
        end_date.setDate(lastDayOfMonth(end_date));
    }

    if (!firstLoad) {
        // client to server
        if (isDefault) {
            moveCalendar(1); // Fix weird bug
        }
        document.getElementById("startDateInput").value = start_date.toISOString().slice(0, 10);
        document.getElementById("endDateInput").value = end_date.toISOString().slice(0, 10);
        document.getElementById("selectedInput").value = selector.value;
        document.getElementById("form").submit();
    }
    firstLoad = false;
}

function lastDayOfMonth(date) {
    return new Date(date.getFullYear(), date.getMonth() + 1, 0).getDate();
}

function moveCalendar(direction) {
    if (selector.value === "day") {
        currentDate.setDate(currentDate.getDate() + direction);
    } else if (selector.value === "month") {
        currentDate.setMonth(currentDate.getMonth() + direction);
    } else if (selector.value === "year") {
        currentDate.setFullYear(currentDate.getFullYear() + direction);
    }
}


selector.addEventListener("change", function () {
    selectorState();
    updateCalendar();
});

function selectorState() {
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
}
const buttons = document.getElementsByClassName("realButton");
for (let i = 0; i < buttons.length; i++) {
    const button = buttons[i];
    button.addEventListener("click", function (event) {
        event.preventDefault();
        moveCalendar(i === 0 ? -1 : 1);
        updateCalendar();
    });
}

