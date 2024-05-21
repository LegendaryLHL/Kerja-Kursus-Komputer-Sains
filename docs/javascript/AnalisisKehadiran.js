function searchTable() {
    const input = document.getElementById("search-input").value.toUpperCase();
    const table = document.getElementById("attendanceTable");
    const tr = table.getElementsByTagName("tr");

    for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[1]; // index 1 corresponds to the 'Name' column
        if (td) {
            if (td.innerText.toUpperCase().indexOf(input) > -1) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
        }
    }
}

function handleRowClick(event) {
    const rowData = event.currentTarget.getElementsByTagName('td');
    const workerId = rowData[1].querySelector('.worker-id').innerText;
    const url = `Profil.php?selected=pekerja&id=${workerId}`;

    window.location.href = url;
}

const dataRows = document.getElementsByClassName('data-row');
for (let i = 0; i < dataRows.length; i++) {
    dataRows[i].addEventListener('click', handleRowClick);
    dataRows[i].style.cursor = 'pointer';
}



// First load
const selector = document.getElementById("selector-dropdown");
const day = document.getElementById("day-segment-value");
const month = document.getElementById("month-segment-value");
const year = document.getElementById("year-segment-value");

let currentDate = new Date();
const urlParams = new URLSearchParams(window.location.search);
const startDate = urlParams.get('start_date');
const selectedUrl = urlParams.get('selected');
if (startDate && selectedUrl) {
    currentDate = new Date(startDate);

    for (var i = 0; i < selector.options.length; i++) {
        if (selector.options[i].value === selectedUrl) {
            selector.options[i].selected = true;
            break;
        }
    }
}
const monthNames = ["January", "February", "March", "April", "May", "June",
    "July", "August", "September", "October", "November", "December"];

day.textContent = currentDate.getDate();
month.textContent = monthNames[currentDate.getMonth()];
year.textContent = currentDate.getFullYear();

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
    post();
});

const buttons = document.getElementsByClassName("realButton");
for (let i = 0; i < buttons.length; i++) {
    const button = buttons[i];
    button.addEventListener("click", function (event) {
        event.preventDefault();
        moveCalendar(i === 0 ? -1 : 1);
        post();
    });
}

document.addEventListener('DOMContentLoaded', function () {
    const datePicker = flatpickr("#date-picker", {
        defaultDate: currentDate,
        onChange: function (selectedDates, dateStr, instance) {
            const date = new Date(dateStr);
            currentDate = date;
            post();
        }
    });

    const calendarIcon = document.querySelector(".calendar i");

    calendarIcon.addEventListener('mouseenter', function () {
        document.getElementById('date-picker').focus();
    });
});

function post() {
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

    const startString = start_date.toISOString().slice(0, 10);
    const endString = end_date.toISOString().slice(0, 10);
    const url = `./AnalisisKehadiran.php?start_date=${startString}&end_date=${endString}&selected=${selector.value}`;
    window.location.href = url;
}

function lastDayOfMonth(date) {
    return new Date(date.getFullYear(), date.getMonth() + 1, 0).getDate();
}

window.addEventListener('resize', function () {
    this.document.getElementById("date-segment").style.width = "auto";
});

