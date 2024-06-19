document.addEventListener("DOMContentLoaded", function () {
    let currentDate = new Date();
    document.getElementById("date").textContent = currentDate.getDate() + "/" + (currentDate.getMonth() + 1) + "/" + currentDate.getFullYear();
});
